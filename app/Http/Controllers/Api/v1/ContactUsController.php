<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Services\ContactUsService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsEmailNotification;
use App\Http\Resources\ContactUsResource;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactUsController extends Controller
{
    /**
     * Add ContactUs API
     * @group ContactUs
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'company_name' => 'nullable',
            'country_id' => 'required',
            'email' => 'required|email',
            'description' => 'required',
        ],
        [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'country_id.required' => 'Please select the country name',
            'email.required' => 'Please enter the email',
            'email.email' => 'You have entered invalid email format',
            'description.required' => 'Please enter the description',

        ]);
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors()),
                ],422
            );       
        }
        $contactUs = ContactUsService::createUpdate(new ContactUs, $request);
        // Send email to admin
        try {
            $adminEmail = env('MARKETING_EMAIL');
            Mail::to($adminEmail)->send(new ContactUsEmailNotification($contactUs));
        } catch (TransportExceptionInterface $e) {
            $this->handleEmailError($e, $contactUs);
            $this->retrySendingEmail($contactUs);
        } catch (Exception $e) {
            $this->handleEmailError($e, $contactUs);
        }

        $contactUs = new ContactUsResource($contactUs);
        $message = 'Contact Us added successfully.';
        return sendResponse($contactUs, $message);
    }

    private function retrySendingEmail(ContactUs $contactUs)
    {
        $maxRetries = 2;
        $retryCount = 0;
        $sleepTime = 2;

        while ($retryCount < $maxRetries) {
            try {
                Mail::to($adminEmail)->send(new ContactUsEmailNotification($contactUs));
                break;
            } catch (TransportExceptionInterface $e) {
                $this->handleEmailError($e, $contactUs);
                $retryCount++;
                sleep($sleepTime);
            } catch (Exception $e) {
                $this->handleEmailError($e, $contactUs);
                $retryCount++;
                sleep($sleepTime);
            }
        }
    }

    private function handleEmailError($e, $contactUs)
    {
        Log::error('Error sending Course Purchased email to ' . $contactUs->email);
        Log::error('Error message: ' . $e->getMessage());
    }
}
