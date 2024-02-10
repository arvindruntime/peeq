<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\PushNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PushNotificationController extends Controller
{
    /**
     * Push Notification List API
     * @group Push Notifications
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        // Calculate the date 21 days ago from the current date
        $sevenDaysAgo = now()->subDays(21);

        // Get notification count
        $notificationCount = PushNotification::where('receiver_id', Auth::user()->id)
            ->where('created_at', '>=', $sevenDaysAgo)
            ->where('notification_viewed', 0)
            ->count();

        // Fetch notifications where the authenticated user is the receiver
        $pushNotifications = PushNotification::with(['sender'])
            ->where('receiver_id', Auth::user()->id)
            ->where('created_at', '>=', $sevenDaysAgo)
            ->whereHas('sender', function ($query) {
                $query->whereNotNull('id'); // Exclude records where sender user is null
            })
            // ->where('notification_viewed', 0) 
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

            $response = [
                'status' => 200,
                'statusState' => 'success',
                'data' => [
                    'current_page' => $pushNotifications->currentPage(),
                    'data' => $pushNotifications->items(),
                    'from' => $pushNotifications->firstItem(),
                    'to' => $pushNotifications->lastItem(),
                    'last_page' => $pushNotifications->lastPage(),
                    'per_page' => $pushNotifications->perPage(),
                    'total' => $pushNotifications->total(),
                ],
                'message' => 'Push notification listed successfully.',
                'notification_count' => $notificationCount,
            ];
        
        return $response;
    }

    /**
     * Push Notification update view count API
     * @group Push Notifications
     * @return \Illuminate\Http\Response
     */
    public function updateViewdNotification(Request $request)
    {
         // Calculate the date 21 days ago from the current date
         $sevenDaysAgo = now()->subDays(21);

        // Notification view count update
        $notificationViewCountUpdate = PushNotification::where('receiver_id', Auth::user()->id)
            ->where('notification_viewed', 0)
            ->get();
        
        foreach($notificationViewCountUpdate as $notificationView) {
            $notificationView->notification_viewed = 1;
            $notificationView->save();
        }

        // Get notification count
        $notificationCount = PushNotification::where('receiver_id', Auth::user()->id)
            ->where('created_at', '>=', $sevenDaysAgo)
            ->where('notification_viewed', 0)
            ->count();

        $message = 'Push notification update successfully.';
        $response = [
            'notification_count' => $notificationCount,
        ];

        return sendResponse($response, $message);
    }
}
