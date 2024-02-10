<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Session;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sessionCoaches = SessionCoachTransaction::where('session_id', $this->id)
                                                    ->pluck('coach_id')
                                                    ->toArray();

        $coaches = User::whereIn('id', $sessionCoaches)
                        ->orderBy('created_at', 'asc')
                        ->take(3)
                        ->get();
                        
        $sessionPriceTransactions = SessionPriceTransaction::where('session_id', $this->id)->get();
        $sessionDurations = $sessionPriceTransactions->pluck('session_duration')->toArray();
        $sessionPrices = $sessionPriceTransactions->pluck('session_price')->toArray();
        $sessionPrices = $sessionPriceTransactions->pluck('calendly_description')->toArray();

        $sessionDurationData = [];

        foreach ($sessionPriceTransactions as $key => $transaction) {
            $currencyCode = $transaction->currency ? $transaction->currency->code : 'AUD';
            $sessionDurationData[] = [
                'session_duration_id' => $transaction->id,
                'session_duration' => $transaction->session_duration . ' Minutes',
                'session_price' => number_format($transaction->session_price, 2),
                'currency' => $currencyCode,
                'calendly_description' => $transaction->calendly_description,
            ];
        }
        // Check if the user is authenticated before accessing purchase session details
        $user = $request->user();
        $purchaseSession = null;
        if ($user) {
            $purchaseSession = $user->purchaseSession()
                                   ->where('session_id', $this->id)
                                   ->orderBy('created_at', 'desc')
                                   ->first();
        }
        return
            [
                'id' => $this->id,
                'thumbnail_img' => $this->thumbnail_img,
                'thumbnail_video' => $this->thumbnail_video,
                'session_name' => $this->session_name,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'coaches' => UserInfoResource::collection($coaches),
                'status' => $this->status ?? 0,
                'last_updated' => $this->updated_at ? $this->updated_at->format('M j, Y') : null,
                'session_duration_data' => $sessionDurationData,
                'session_purchase_status' => $purchaseSession ? $purchaseSession->payment_status : 0,
            ];
    }
}
