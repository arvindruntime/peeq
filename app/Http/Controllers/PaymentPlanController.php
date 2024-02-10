<?php

namespace App\Http\Controllers;

use to;
use Mail; 
use Stripe;
use App\Models\Plan;
use App\Models\User;
use App\Models\Course;
use App\Models\Country;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Models\PlanTransaction;
use App\Mail\CoursePurchaseMail;
use App\Mail\FirstTimeLoginMail;
use App\Mail\SessionPurchaseMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class PaymentPlanController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    function choosePlan()
    {
        try {
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $userCreatedDate = $user->created_at;
            $oneYearAgo = now()->subYear();
            $planExpire = (int)$userCreatedDate->lessThan($oneYearAgo);
            if($planExpire == 1) {
                $plans = Plan::where('status', 'active')
                            ->where('price_type', 'paid')
                            ->get();
            } else {
                $plans = Plan::where('status', 'active')
                            ->where('price_type', 'free')
                            ->get();
            }
        } catch (\Exception $e) {

            Log::error('Error fetching plans or accessing user: ' . $e->getMessage());

            return view('errors.custom_error_view', ['message' => 'An error occurred. Please try again later.']);
        }
        return view('auth.choosePlan', compact('plans', 'planExpire'));
    }
    
    public function customEncrypt($data)
    {
        return Crypt::encryptString($data);
    }
    public function customDecrypt($encryptedData)
    {
        try {
            return Crypt::decryptString($encryptedData);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption failure (e.g., invalid data or tampering)
            return null;
        }
    }
    
     //// Code started for session payment 
     public function getSessionPlan(Request $request)
     {        
         //Session::put('user_id', Auth::user()->id);
         
         $encryptedUserId = $this->customEncrypt(Auth::user()->id);
         
         $session_price_transaction_id = $request->session_duration;
         $sessionData = SessionPriceTransaction::find($session_price_transaction_id);
         $session_name = $sessionData->session->session_name ?? '';
         $type = 'session';
         $device_type = 'web';
         $session_price_type = 'paid';
         $stripe_subscription_session_id = '';
         $stripe_payment_int_url = '';
         if($sessionData){
             $sessionAmount = $sessionData->session_price;
             $stripe_amount = $sessionAmount*100;
             $stripe_secret = env('stripe_secret');
             
             \Stripe\Stripe::setApiKey($stripe_secret);
             $stripe = new \Stripe\StripeClient($stripe_secret);
                         
             $lineItems = [['quantity' => 1]];
             if (!empty($stripe_subscription_session_id)) {
                 // Get stripe account price
                 $lineItems[0]['price'] = $stripe_subscription_session_id;
                 $allowPromotionCodes = true;
             } else {
                 // Create a new price
                 $newPrice = $stripe->prices->create([
                     'currency' => 'usd',
                     'product_data' => [
                         'name' => $session_name,
                     ],
                     'unit_amount' => $stripe_amount,
                 ]);
         
                 $lineItems[0]['price'] = $newPrice->id;
                 $allowPromotionCodes = true;
             }
             $checkout_session = $stripe->checkout->sessions->create([
                 'line_items' => $lineItems,
                 'mode' => 'payment',
                 'allow_promotion_codes' => $allowPromotionCodes,
                 'success_url' => env('APP_URL') . '/success-session-payment/'.$encryptedUserId,
                 'cancel_url' => env('APP_URL') . '/cancel-session-payment/'.$encryptedUserId,
             ]); 
             header("HTTP/1.1 303 See Other");
             $stripe_payment_int_url = $checkout_session->url;
         }
         
         $planTransaction = new PlanTransaction;
         $planTransaction->user_id = Auth::user()->id;
         $planTransaction->session_id = $sessionData->session_id;
         $planTransaction->type = $type;
         $planTransaction->device_type = $device_type;
         $planTransaction->session_price_type = $session_price_type;
         $planTransaction->final_amount = $sessionAmount;
         $planTransaction->transaction_id = $checkout_session->payment_intent;
         $planTransaction->session_duration = (int)$sessionData->session_duration;
         $planTransaction->session_price = (int)$sessionData->session_price;
         $planTransaction->calendly_description = $sessionData->calendly_description;
         
         $planTransaction->save();
         
         //$planTransactionId = $planTransaction->id;
         
        // $message = 'Payment initialized.';
        // $data['stripe_payment_int_url'] = $stripe_payment_int_url;
        // if ($request->wantsJson()) {
        //     return sendResponse($data, $message);
        // }
        
         return redirect($stripe_payment_int_url);
     }
     
    public function successSessionPayment($user_id = "")
    {
        $decryptedUserId = $this->customDecrypt($user_id);
        try {
            $planTransaction = PlanTransaction::where('user_id', $decryptedUserId)
                                                ->latest()->first();
            $planTransaction->payment_status = 1;
            $planTransaction->session_price_type = 'paid';
            $planTransaction->save();

            // Send the email to the user
            $user = User::find($decryptedUserId);
            if ($user !== null) {
                $userName = $user->first_name;
                $sessionName = $planTransaction->session->session_name;
                $sessionDuration = $planTransaction->session_duration . ' Minutes';
                $calendlyDescription = $planTransaction->calendly_description;
                try {
                    Mail::to($user->email)->send(new SessionPurchaseMail($userName, $sessionName, $sessionDuration, $calendlyDescription));
                } catch (TransportExceptionInterface $e) {
                    $this->handleSessionEmailError($e, $user);
                    $this->retrySessionSendingEmail($user, $userName, $sessionName, $sessionDuration, $calendlyDescription);
                } catch (Exception $e) {
                    $this->handleSessionEmailError($e, $user);
                }
            }
            
            if ($user) {
                Auth::login($user);
            }
            
            $coachesName = '';
            $sessionCoaches = SessionCoachTransaction::where('session_id', $planTransaction->session_id)->get();
            if ($sessionCoaches->isNotEmpty()) {
                $coachesArray = array();
                
                foreach ($sessionCoaches as $key => $sessionCoach) {
                    $user = User::find($sessionCoach->coach_id);
            
                    if ($user) {
                        $coachName = $user->first_name . ' ' . $user->last_name;
                        $coachesArray[] = $coachName; // Add coach name to the array
                    }
                }
                
                $coachesName = implode(', ', $coachesArray);                
            }
            $session_booking_title = 'Your 1:1 coaching session with '.$coachesName.' has been successfully secured';

            
            // return redirect()->route('admin.session.detail', [$planTransaction->session_id, 'calendly_popup' => 1]);
            return redirect()->route('admin.session.list', [$planTransaction->session_id, 'calendly_popup' => 1,'purchased_session_calendly_url' => $calendlyDescription, 'session_booking_title' => $session_booking_title]);
        } catch (Exception $e) {
            Log::error('Error for success' . $e->getMessage());
        }
    }

    private function retrySessionSendingEmail(User $user, $userName, $sessionName, $sessionDuration, $calendlyDescription)
    {
        $maxRetries = 2;
        $retryCount = 0;
        $sleepTime = 2;

        while ($retryCount < $maxRetries) {
            try {
                Mail::to($user->email)->send(new SessionPurchaseMail($userName, $sessionName, $sessionDuration, $calendlyDescription));
                break;
            } catch (TransportExceptionInterface $e) {
                $this->handleSessionEmailError($e, $user);
                $retryCount++;
                sleep($sleepTime);
            } catch (Exception $e) {
                $this->handleSessionEmailError($e, $user);
                $retryCount++;
                sleep($sleepTime);
            }
        }
    }

    private function handleSessionEmailError($e, $user)
    {
        Log::error('Error sending Session Purchased email to ' . $user->email);
        Log::error('Error message: ' . $e->getMessage());
    }
    
    public function cancelSessionPayment($user_id = "")
    {
        $decryptedUserId = $this->customDecrypt($user_id);
        try {
            $planTransaction = PlanTransaction::where('user_id', $decryptedUserId)
                                                ->where('payment_status', 0)
                                                ->latest()->first();
            return redirect()->route('admin.session.detail',$planTransaction->session_id);
        } catch (Exception $e) {
            Log::error('Error for cancel ' . $e->getMessage());
        }
    }
    

    public function goToDashboard()
    {
        /* Welcome checklist Popup */
        $user = Auth::user();
        if ($user) {
            session()->put('first_login', $user->first_time_login);
            if ($user->first_time_login == 0) {
                session()->flash('first_login', true);
                User::where('id', $user->id)->update(['first_time_login' => 1]);
                $loginUrl = URL::route('login');
                try {
                    // Send the email to the user
                    Mail::to($user->email)->send(new FirstTimeLoginMail($user->first_name, $loginUrl));
                } catch (\Exception $e) {
                     // Log the email sending error for debugging purposes
                    Log::error('Error sending first-time login email');
                    Log::error('Error message: ' . $e->getMessage());
                }
            } else {
                session()->flash('first_login', false);
            }
        }
        return redirect()->route('dashboard');
    }
        
    //// Code started for create course payment 
    public function getCoursePlan($id)
    {        
        //Session::put('user_id', Auth::user()->id);
        
        $encryptedUserId = $this->customEncrypt(Auth::user()->id);
        
        $course = Course::with('coaches')->find($id);
        // dd($course->stripe_subscription_course_id);
        $stripe_subscription_course_id = $course->stripe_subscription_course_id ?? '';
        // dd($stripe_subscription_course_id);
        $stripe_payment_int_url = '';
        if($course){
            $planAmount = $course->course_price;
            $stripe_amount = $planAmount*100;
            $stripe_secret = env('stripe_secret');
            
            \Stripe\Stripe::setApiKey($stripe_secret);
            $stripe = new \Stripe\StripeClient($stripe_secret);
                        
            $lineItems = [['quantity' => 1]];
            // Check if $stripe_subscription_course_id is not empty
            if (!empty($stripe_subscription_course_id)) {
                // Get stripe account price
                $lineItems[0]['price'] = $stripe_subscription_course_id;
                $allowPromotionCodes = true;
            } else {
                // Create a new price
                $newPrice = $stripe->prices->create([
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $course->course_name,
                    ],
                    'unit_amount' => $stripe_amount,
                ]);
        
                $lineItems[0]['price'] = $newPrice->id;
                $allowPromotionCodes = true;
            }
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'allow_promotion_codes' => $allowPromotionCodes,
                'success_url' => env('APP_URL') . '/success-course-payment/'.$encryptedUserId,
                'cancel_url' => env('APP_URL') . '/cancel-course-payment/'.$encryptedUserId,
            ]); 
			header("HTTP/1.1 303 See Other");
			$stripe_payment_int_url = $checkout_session->url;
        }
        
        $planTransaction = new PlanTransaction;
        $planTransaction->user_id = Auth::user()->id;
        $planTransaction->course_id = $course->id;
        $planTransaction->type = 'course';
        $planTransaction->device_type = 'web';
        $planTransaction->course_price_type = $course->course_price_type;
        $planTransaction->final_amount = $course->course_price;
        $planTransaction->transaction_id = $checkout_session->payment_intent;
        $planTransaction->save();
        $planTransactionId = $planTransaction->id;
        
        return redirect($stripe_payment_int_url);
    }
    
    public function successCoursePayment($user_id = "")
    {
        $decryptedUserId = $this->customDecrypt($user_id);
        try {
            $planTransaction = PlanTransaction::where('user_id', $decryptedUserId)
                                                ->latest()->first();
            $planTransaction->payment_status = 1;
            $planTransaction->save();

            // Send the email to the user
            $user = User::find($decryptedUserId);
            if ($user !== null) {
                $userName = $user->first_name;
                $courseName = $planTransaction->course->course_name;
                try {
                    Mail::to($user->email)->send(new CoursePurchaseMail($userName, $courseName));
                } catch (TransportExceptionInterface $e) {
                    $this->handleEmailError($e, $user);
                    $this->retrySendingEmail($user, $userName, $courseName);
                } catch (Exception $e) {
                    $this->handleEmailError($e, $user);
                }
            }
            
            if ($user) {
                Auth::login($user);
            }

            return redirect()->route('user.courses.view',$planTransaction->course_id);
        } catch (Exception $e) {
            Log::error('Error for success' . $e->getMessage());
        }
    }

    private function retrySendingEmail(User $user, $userName, $courseName)
    {
        $maxRetries = 2;
        $retryCount = 0;
        $sleepTime = 2;

        while ($retryCount < $maxRetries) {
            try {
                Mail::to($user->email)->send(new CoursePurchaseMail($userName, $courseName));
                break;
            } catch (TransportExceptionInterface $e) {
                $this->handleEmailError($e, $user);
                $retryCount++;
                sleep($sleepTime);
            } catch (Exception $e) {
                $this->handleEmailError($e, $user);
                $retryCount++;
                sleep($sleepTime);
            }
        }
    }

    private function handleEmailError($e, $user)
    {
        Log::error('Error sending Course Purchased email to ' . $user->email);
        Log::error('Error message: ' . $e->getMessage());
    }

    public function cancelCoursePayment($user_id = "")
    {
        $decryptedUserId = $this->customDecrypt($user_id);
        try {
            $planTransaction = PlanTransaction::where('user_id', $decryptedUserId)
                                                ->where('payment_status', 0)
                                                ->latest()->first();
            return redirect()->route('user.courses.view',$planTransaction->course_id);
        } catch (Exception $e) {
            Log::error('Error for cancel ' . $e->getMessage());
        }
    }
    
    //// Code ended of create course payment 
}
