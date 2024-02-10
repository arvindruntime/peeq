<?php

namespace App\Http\Controllers\Api\v1;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Session;
use Stripe\StripeClient;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\PlanTransaction;
use Illuminate\Validation\Rule;
use App\Services\SessionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\SessionResource;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;
use App\Http\Resources\TimeZoneResource;
use App\Http\Resources\UserInfoResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class SessionController extends Controller
{
    public $service;
    function __construct(SessionService $sessionService)
	{
		$this->service = $sessionService;
	}

    /**
     * Session List API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $isAdmin = Auth::user()->is_admin;
        $user = $request->user();

        $sessionQuery = Session::orderBy('created_at', 'desc');
        if (!$isAdmin) {
            // If not an admin, only show public sessions by default
            $sessionQuery->where('status', 1);
        }

        $type = $request->input('type', 'all');

        if($request->type === null || $request->type == 'all' || $request->type == 'All') {
            $sessions = $sessionQuery->paginate($perPage); 

            $sessions->getCollection()->transform(function ($session) use ($request) {
                $sessionCoaches = SessionCoachTransaction::where('session_id', $session->id)
                    ->pluck('coach_id')
                    ->toArray();
        
                $coaches = User::whereIn('id', $sessionCoaches)
                    ->orderBy('created_at', 'asc')
                    ->take(3)
                    ->get();
        
                $sessionPriceTransactions = SessionPriceTransaction::where('session_id', $session->id)->get();
                $sessionDurations = $sessionPriceTransactions->pluck('session_duration')->toArray();
                $sessionPrices = $sessionPriceTransactions->pluck('session_price')->toArray();
                $sessionPrices = $sessionPriceTransactions->pluck('calendly_description')->toArray();
        
                $sessionDurationData = [];
        
                foreach ($sessionPriceTransactions as $key => $transaction) {
                    $currencyCode = $transaction->currency ? $transaction->currency->code : 'AUD';
                    $planTransaction = PlanTransaction::where('session_id', $session->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->where('session_duration', $transaction->session_duration)
                                                        ->orderBy('created_at', 'desc')
                                                        ->first();

                    $purchasedStatus = $planTransaction ? $planTransaction->payment_status : 0;
                    $sessionDurationData[] = [
                        'session_duration_id' => $transaction->id,
                        'session_duration' => $transaction->session_duration . ' Minutes',
                        'session_price' => number_format($transaction->session_price, 2),
                        'currency' => $currencyCode,
                        'calendly_description' => $transaction->calendly_description,
                        'purchased_status' => $purchasedStatus,
                    ];
                }
        
                // Check if any purchased_status is 1 in sessionDurationData
                $sessionPurchaseStatus = collect($sessionDurationData)->pluck('purchased_status')->contains(1) ? 1 : 0;

                // Check if the user is authenticated before accessing purchase session details
                $user = $request->user();
                $purchaseSession = null;
                if ($user) {
                    $purchaseSession = $user->purchaseSession()
                                        ->where('session_id', $session->id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                }
                return [
                    'id' => $session->id,
                    'thumbnail_img' => $session->thumbnail_img,
                    'thumbnail_video' => $session->thumbnail_video,
                    'session_name' => $session->session_name,
                    'short_description' => $session->short_description,
                    'description' => $session->description,
                    'coaches' => UserInfoResource::collection($coaches),
                    'status' => $session->status ?? 0,
                    'last_updated' => $session->updated_at ? $session->updated_at->format('M j, Y') : null,
                    'session_duration_data' => $sessionDurationData,
                    'session_purchase_status' => $sessionPurchaseStatus,
                ];
            });

        } elseif ($type === 'purchased' && $user) {

            $sessionQuery->whereHas('transactions', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('payment_status', 1);
            })->withTrashed();

            $sessions = $sessionQuery->paginate($perPage);

            $transformedSessions = [];

            $sessions->getCollection()->each(function ($session) use (&$transformedSessions, $request, $user) {
                $sessionCoaches = SessionCoachTransaction::where('session_id', $session->id)
                    ->pluck('coach_id')
                    ->toArray();

                $coaches = User::whereIn('id', $sessionCoaches)
                    ->orderBy('created_at', 'asc')
                    ->take(3)
                    ->get();

                    $planTransactions = PlanTransaction::where('session_id', $session->id)
                        ->where('payment_status', 1)
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

                    foreach($planTransactions as $planTransaction) {
                        $purchasedStatus = $planTransaction ? $planTransaction->payment_status : 0;
                
                        if ($purchasedStatus == 1) {
                            $transformedSessions[] = [
                                'id' => $session->id,
                                'thumbnail_img' => $session->thumbnail_img,
                                'thumbnail_video' => $session->thumbnail_video,
                                'session_name' => $session->session_name,
                                'short_description' => $session->short_description,
                                'description' => $session->description,
                                'coaches' => UserInfoResource::collection($coaches),
                                'status' => $session->status ?? 0,
                                'last_updated' => $session->updated_at ? $session->updated_at->format('M j, Y') : null,
                                // 'session_duration_data' => $sessionDurationData,
                                'session_duration_data' => [],
                                'session_purchase_status' => $purchasedStatus,
                                'session_purchase_duration' => $planTransaction->session_duration . ' Minutes',
                            ];
                        }
                    }
            });

            $sessions = new LengthAwarePaginator(
                $transformedSessions,
                count($transformedSessions),
                $sessions->perPage(),
                $sessions->currentPage(),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        $message = 'Session listed successfully.';
        
        if ($request->wantsJson()) {
            return sendResponse($sessions, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $view = view('admin.session.session-list-xhr',compact('sessions','type'))->render();
                return response()->json(['html'=>$view]);
            }

            return view('admin.session.list', compact('sessions','type'));
        }
    }

    /**
     * Add Session API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'thumbnail_img' => 'required|image|mimes:jpeg,png,jpg',
            'thumbnail_video' => 'nullable',
            'session_name' => 'required',
            'short_description' => 'nullable',
            'description' => 'required',
            'coaches' => 'required',
            'status' => 'nullable|in:0,1',
            'session_duration' => 'required|array', // Ensure it's an array
            'session_duration.*' => 'required', // Validate each element in the array
            'session_price' => 'required|array', // Ensure it's an array
            'session_price.*' => 'required|numeric', // Validate each element in the array as numeric
            'calendly_description' => 'required|array', // Ensure it's an array
            'calendly_description.*' => 'required|string', // Validate each element in the array
        ], [
            'thumbnail_img.required' => 'Please enter the session thumbnail image',
            'thumbnail_img.image' => 'The session thumbnail must be an image',
            'thumbnail_img.mimes' => 'The session thumbnail must be a valid image format (jpeg, png, jpg)',
            'session_name.required' => 'Please enter the session name',
            'description.required' => 'Please enter the description',
            'coaches.required' => 'Please select the coaches',
            'status.required' => 'Please select the status',
            
            'session_duration.required' => 'Session duration is required',
            'session_duration.array' => 'Session duration is required',
            'session_duration.*.required' => 'Session duration is required',
            'session_price.required' => 'Session price is required',
            'session_price.array' => 'Session price is required',
            'session_price.*.required' => 'Session price is required',
            'session_price.*.numeric' => 'Each element in the session price must be numeric',
            'calendly_description.required' => 'Please enter the calendly description',
            'calendly_description.array' => 'Please enter the calendly description',
            'calendly_description.*.required' => 'Please enter the calendly description',
            'calendly_description.*.string' => 'Please enter the calendly description',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
            ], 422);
        }
        
        $session = SessionService::createUpdate(new Session, $request);
        $session = new SessionResource($session);
        $message = 'Session created successfully.';
        return sendResponse($session, $message);
    }

    /**
     * Get Session API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $session = Session::find($id);
        

        if (!empty($session)) {
            $sessionCoaches = SessionCoachTransaction::where('session_id', $session->id)
                ->pluck('coach_id')
                ->toArray();

            $coaches = User::whereIn('id', $sessionCoaches)
                ->orderBy('created_at', 'asc')
                ->take(3)
                ->get();

            //$sessionPriceTransactions = SessionPriceTransaction::where('session_id', $session->id)->get();
            
            $sessionPriceTransactions = SessionPriceTransaction::where('session_id', $session->id)
            ->orderByRaw("CAST(session_duration AS SIGNED) ASC")
            ->get();
            
            $sessionDurations = $sessionPriceTransactions->pluck('session_duration')->toArray();
            $sessionPrices = $sessionPriceTransactions->pluck('session_price')->toArray();
            $sessionPrices = $sessionPriceTransactions->pluck('calendly_description')->toArray();
            
            // dd($sessionPriceTransactions);

            $sessionDurationData = [];

            foreach ($sessionPriceTransactions as $key => $transaction) {
                $currencyCode = $transaction->currency ? $transaction->currency->code : 'AUD';
                $planTransaction = PlanTransaction::where('session_id', $session->id)
                                                    ->where('session_duration', $transaction->session_duration)
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();

                $purchasedStatus = $planTransaction ? $planTransaction->payment_status : 0;

                $sessionDurationData[] = [
                    'session_duration_id' => $transaction->id,
                    'session_duration' => $transaction->session_duration . ' Minutes',
                    'session_price' => number_format($transaction->session_price, 2),
                    'currency' => $currencyCode,
                    'calendly_description' => $transaction->calendly_description,
                    'purchased_status' => $purchasedStatus,
                ];
            }

            // Check if any purchased_status is 1 in sessionDurationData
            $sessionPurchaseStatus = collect($sessionDurationData)->pluck('purchased_status')->contains(1) ? 1 : 0;

            // Check if the user is authenticated before accessing purchase session details
            $user = $request->user();
            $purchaseSession = null;
            if ($user) {
                $purchaseSession = $user->purchaseSession()
                                        ->where('session_id', $session->id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
            }

            $coachesData = [];
            foreach($coaches as $coach) {

                $isFollow = UserActivity::where('following', Auth::user()->id)->where('followers', $coach->id)->count();

                $coachesData[] =  [
                    'id' => $coach->id,
                    'first_name' => $coach->first_name,
                    'last_name' => $coach->last_name,
                    'is_follow' =>  $isFollow >=1 ? 1 : 0,
                    'profile_image' => $coach->profile_image,
                    'cover_image' => $coach->cover_image,
                    'user_type' => $coach->user_type,
                    'timezone' => new TimeZoneResource($coach->timezone),
                    'profile_image_url' => $coach->profile_image_url,
                    'cover_image_url' => $coach->cover_image_url,
                ];
            }

            $response = [
                'id' => $session->id,
                'thumbnail_img' => $session->thumbnail_img,
                'thumbnail_video' => $session->thumbnail_video,
                'session_name' => $session->session_name,
                'short_description' => $session->short_description,
                'description' => $session->description,
                // 'coaches' => UserInfoResource::collection($coaches),
                'coaches' => $coachesData,
                'status' => $session->status ?? 0,
                'last_updated' => $session->updated_at ? $session->updated_at->format('M j, Y') : null,
                'session_duration_data' => $sessionDurationData,
                'session_purchase_status' => $sessionPurchaseStatus,
                'purchased_session_calendly_url' => $transaction->calendly_description,
            ];
            $message = 'Session fetched successfully.';
            
            if ($request->wantsJson()) {
                return sendResponse($response, $message);
            } else {
                if (!auth()->user()->welcome_checklist_complete==1) {
                    return redirect()->route('dashboard');
                }
                if ($request->ajax()) {
                    $view = view('admin.session.details',compact('response'))->render();
                    return response()->json(['html'=>$view]);
                }
    
                return view('admin.session.details', compact('response'));
            }
            
        } else {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Session API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'thumbnail_img' => 'required|image|mimes:jpeg,png,jpg,gif',
            'thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg',
            'thumbnail_video' => 'nullable',
            'session_name' => 'required',
            'short_description' => 'nullable',
            'description' => 'required',
            'coaches' => 'required',
            'status' => 'nullable|in:0,1',
            
            'session_duration' => 'required|array', // Ensure it's an array
            'session_duration.*' => 'required', // Validate each element in the array
            'session_price' => 'required|array', // Ensure it's an array
            'session_price.*' => 'required|numeric', // Validate each element in the array as numeric
            'calendly_description' => 'required|array', // Ensure it's an array
            'calendly_description.*' => 'required|string', // Validate each element in the array
        ], [
            // 'thumbnail_img.required' => 'Please enter the session thumbnail image',
            // 'thumbnail_img.image' => 'The session thumbnail must be an image',
            // 'thumbnail_img.mimes' => 'The session thumbnail must be a valid image format (jpeg, png, jpg)',
            'session_name.required' => 'Please enter the session name',
            'description.required' => 'Please enter the description',
            'coaches.required' => 'Please select the coaches',
            
            'session_duration.required' => 'Session duration is required',
            'session_duration.array' => 'Session duration is required',
            'session_duration.*.required' => 'Session duration is required',
            'session_price.required' => 'Session price is required',
            'session_price.array' => 'Session price is required',
            'session_price.*.required' => 'Session price is required',
            'session_price.*.numeric' => 'Each element in the session price must be numeric',
            'calendly_description.required' => 'Please enter the calendly description',
            'calendly_description.array' => 'Please enter the calendly description',
            'calendly_description.*.required' => 'Please enter the calendly description',
            'calendly_description.*.string' => 'Please enter the calendly description',
        ]);
        
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }

        $session = Session::find($id);
        if(!empty($session)) 
        {
            $session = SessionService::createUpdate($session, $request);
            $session = new SessionResource($session);
            $message = 'Session updated successfully.';
            return sendResponse($session, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Session API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::find($id);
        if(!empty($session))
        {
            $session->delete();
            $session = new SessionResource($session);
            $message = 'Session deleted successfully.';
            return sendResponse($session, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * 1:1 coaching session API
     * @group Sessions
     * @return \Illuminate\Http\Response
     */
    public function oneTwoOneSessionDetails(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $user = Auth::user();
        $sessions = PlanTransaction::where('plan_transactions.user_id', $user->id)
                    ->where('type', 'session')
                    ->leftJoin('sessions', 'plan_transactions.session_id', '=', 'sessions.id')
                    ->leftJoin('session_price_transactions', 'plan_transactions.session_duration', '=', 'session_price_transactions.id')
                    ->select(
                        'plan_transactions.id',
                        'sessions.session_name',
                        \DB::raw('DATE_FORMAT(plan_transactions.created_at, "%d-%m-%Y") as session_date'),
                        \DB::raw('CONCAT(plan_transactions.session_duration, " Minutes") as session_duration'),
                        'plan_transactions.final_amount as session_price',
                        \DB::raw('CASE WHEN plan_transactions.payment_status = 1 THEN "Success" ELSE "Failure" END as payment_status')
                    )
                    ->orderBy('id', 'desc')
                    ->paginate($perPage);             
        $message = 'One to one Session Details fetched successfully.';
        // return sendResponse($sessions, $message);
        
        if ($request->wantsJson()) {
            return sendResponse($sessions, $message);
        } else {
            if ($request->ajax()) {
                $view = view('layouts.admin.base.purchased_session_xml',compact('sessions'))->render();
                return response()->json(['html'=>$view]);
            }

            // return view('admin.session.details', compact('sessions'));
        }
    }

    public function appliedUserList(Request $request, $session_id)
    {
        $perPage = $request->input('per_page', 10);
        $appliedUserList = PlanTransaction::where('plan_transactions.type', 'session')
            ->where('plan_transactions.session_id', $session_id)
            ->where('plan_transactions.payment_status', 1)
            ->leftJoin('users', 'plan_transactions.user_id', '=', 'users.id')
            ->leftJoin('session_price_transactions', 'plan_transactions.session_duration', '=', 'session_price_transactions.id')
            ->select(
                'users.first_name',
                'users.last_name',
                'users.email',
                \DB::raw('CASE WHEN plan_transactions.payment_status = 1 THEN "Success" ELSE "Failure" END as payment_status'),
                \DB::raw('CONCAT(plan_transactions.session_duration, " Minutes") as session_duration'),
                \DB::raw('DATE_FORMAT(plan_transactions.created_at, "%d-%m-%Y") as session_purchased_date'),
                'plan_transactions.final_amount as session_price'
            )
            ->paginate($perPage);
        $message = 'Applied User List Details fetched successfully.';
        
        if ($request->wantsJson()) {
            return sendResponse($appliedUserList, $message);
        } else {
            return view('admin.session.applied_user_list', compact('appliedUserList'));
        }
    }
    
    //// Code started for session payment 
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
     
     public function StripeSessionPaymentInitialize(Request $request, $session_duration_id)
     {        
         //Session::put('user_id', Auth::user()->id);
         $encryptedUserId = $this->customEncrypt(Auth::user()->id);
         
         
         
         $session_price_transaction_id = $session_duration_id;
         $sessionData = SessionPriceTransaction::find($session_price_transaction_id);
         
        // $sessionCoach = SessionCoachTransaction::where('session_id', $sessionData->session_id)->first();
        // $coachName = ''; 
        // if ($sessionCoach) {
        //     $user = User::find($sessionCoach->coach_id);
        //     if ($user) {
        //         $coachName = $user->first_name . ' ' . $user->last_name;
        //     }
        // }
        
            $coachesName = '';
            $sessionCoaches = SessionCoachTransaction::where('session_id', $sessionData->session_id)->get();
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
                
                
         $session_name = $sessionData->session->session_name ?? '';
         $type = 'session';
         $device_type = $request->input('device_type', 'ios');
         $session_price_type = 'initialized';
         $stripe_subscription_session_id = '';
         $stripe_session_payment_url = '';
         if(!empty($sessionData)) {
             $sessionAmount = $sessionData->session_price;
             $stripe_amount = $sessionAmount*100;
             $stripe_secret = env('stripe_secret');
             
             Stripe::setApiKey($stripe_secret);
             $stripe = new StripeClient($stripe_secret);
                         
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
             $stripe_session_payment_url = $checkout_session->url;
             
             // Plan transaction details store for session payment 
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
                            
                $message = 'Payment initialized.';
                $data['stripe_session_payment_url'] = $stripe_session_payment_url;
                $data['popup_message'] = $session_booking_title;
                return sendResponse($data, $message);
         } 
         else
         {
            return sendError('Error Occurred');
         }       
     }
}
