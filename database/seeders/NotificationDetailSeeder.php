<?php

namespace Database\Seeders;

use App\Models\NotificationDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Email Updates */

        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'New Follower',
            'detail_description' => 'Send me a notification when I gain a new follower.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'Likes and Comments',
            'detail_description' => 'Notify me when any of my posts get engagments such as likes and comments.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'Direct Messages',
            'detail_description' => 'Notify me when I receive new direct messages from other users.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'Event Reminders',
            'detail_description' => 'Send me a notification about any upcoming events I am attending.',
            'status' => 1
        ]);
        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'Course Updates',
            'detail_description' => 'If you have a course module, send notifications to students about new course materials, assignments, or upcoming sessions.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 1,
            'title' => 'Account Activity',
            'detail_description' => 'Send me notifications for important account activities such as password changes, email address updates, or suspicious login attempts.',
            'status' => 0
        ]);


        /** Mobile Push */

        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'New Follower',
            'detail_description' => 'Send me a notification when I gain a new follower.',
            'status' => 1
        ]);
        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'Likes and Comments',
            'detail_description' => 'Notify me when any of my posts get engagments such as likes and comments.',
            'status' => 1
        ]);
        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'Direct Messages',
            'detail_description' => 'Notify me when I receive new direct messages from other users.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'Event Reminders',
            'detail_description' => 'Send me a notification about any upcoming events I am attending.',
            'status' => 1
        ]);
        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'Course Updates',
            'detail_description' => 'If you have a course module, send notifications to students about new course materials, assignments, or upcoming sessions.',
            'status' => 0
        ]);
        NotificationDetail::create([
            'notification_id' => 2,
            'title' => 'Account Activity',
            'detail_description' => 'Send me notifications for important account activities such as password changes, email address updates, or suspicious login attempts.',
            'status' => 0
        ]);
    }
}
