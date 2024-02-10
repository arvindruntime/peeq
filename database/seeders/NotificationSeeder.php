<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'title' => 'Email Update Notifications',
            'description' => 'Choose which email notifications you want enabled',
            'icon' => env('APP_URL') . '/assets/images/email-icon.png',
            'design_type' => 1,
        ]);
        Notification::create([
            'title' => 'Mobile Push Notifications',
            'description' => 'Choose which mobile push notifications you want enabled',
            'icon' => env('APP_URL') . '/assets/images/mobile-icon.png',
            'design_type' => 2,
        ]);
    }
}
