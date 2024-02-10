<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SessionPriceTransaction;

class SessionPriceTransactionController extends Controller
{
    public function sessionDurationList(Request $request, $session_id)
    {
        $session = Session::find($session_id);
        if (!$session) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'message' => 'Session not found.',
            ], 404);
        }
        $perPage = $request->input('per_page', 10);
        $sessionDurationListData = SessionPriceTransaction::where('session_id', $session_id)->paginate($perPage);

        $sessionDurationListData->getCollection()->transform(function ($transaction) use ($request) {
            return [
                'id' => $transaction->id,
                'session_id' => $transaction->session_id,
                'session_duration' => $transaction->session_duration,
                'session_price' => $transaction->session_price,
                'currency' => $transaction->currency ? $transaction->currency->code : 'AUD',
                'calendly_description' => $transaction->calendly_description,
            ];
        });
        $message = 'Session duration details fetched successfully.';
        return sendResponse($sessionDurationListData, $message);
    }
}
