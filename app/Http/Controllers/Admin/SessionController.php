<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;
use App\Http\Resources\UserInfoResource;

class SessionController extends Controller
{
    public function index()
    {
        return view('admin.session.index');
    }

    public function create()
    {
        return view('admin.session.create');
    }
    public function sessionlist()
    {
        return view('admin.session.list');
    }
    public function sessiondetails()
    {
        return view('admin.session.details');
    }
    public function sessionEdit(Request $request, $id)
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

            // $sessionPriceTransactions = SessionPriceTransaction::where('session_id', $session->id)->get();
            // $sessionDurations = $sessionPriceTransactions->pluck('session_duration')->toArray();
            // $sessionPrices = $sessionPriceTransactions->pluck('session_price')->toArray();
            // $sessionPrices = $sessionPriceTransactions->pluck('calendly_description')->toArray();
            // dd($sessionPriceTransactions );
            
                        
            $sessionPriceTransactions = SessionPriceTransaction::where('session_id', $session->id)
            ->orderByRaw("CAST(session_duration AS SIGNED) ASC")
            ->get();    
            $sessionDurations = $sessionPriceTransactions->pluck('session_duration')->toArray();
            $sessionPrices = $sessionPriceTransactions->pluck('session_price')->toArray();
            $calendlyDescriptions = $sessionPriceTransactions->pluck('calendly_description')->toArray();
            
            // dd($sessionPriceTransactions, $sessionDurations, $sessionPrices, $calendlyDescriptions);

            $sessionDurationData = [];

            foreach ($sessionPriceTransactions as $key => $transaction) {
                $currencyCode = $transaction->currency ? $transaction->currency->code : 'AUD';
                $sessionDurationData[] = [
                    'session_duration_id' => $transaction->id,
                    'session_duration' => $transaction->session_duration,
                    'session_price' => $transaction->session_price,
                    'currency' => $currencyCode,
                    'calendly_description' => $transaction->calendly_description,
                ];
            }

            // Check if the user is authenticated before accessing purchase session details
            $user = $request->user();
            $purchaseSession = null;
            if ($user) {
                $purchaseSession = $user->purchaseSession()
                                       ->where('session_id', $session->id)
                                       ->orderBy('created_at', 'desc')
                                       ->first();
            }
            $sessionData = [
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
                'session_purchase_status' => $purchaseSession ? $purchaseSession->payment_status : 0,
            ];
            $message = 'Session fetched successfully.';
            return view('admin.session.edit',  compact('id','sessionData'));
            // return sendResponse($response, $message);
        } else {
            return sendError('Error Occurred');
        }
    }
}
