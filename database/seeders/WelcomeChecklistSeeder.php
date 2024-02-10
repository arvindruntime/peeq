<?php

namespace Database\Seeders;

use App\Models\WelcomeChecklist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WelcomeChecklist::create([
            'id' => 1,
            'step_number' => 1,
            'title' => 'Complete Your Profile',
            'description' => 'Complete your profile to edit what others can see about you. Here, you can add a profile image, bio and professional information.',
            'img_url' => env('APP_URL') . '/assets/images/info.png',
            'button_title' => 'Setup Profile',
            'is_mobile' => 1,
            'redirection_tag' => 1,
        ]);

        WelcomeChecklist::create([
            'id' => 2,
            'step_number' => 2,
            'title' => 'Setup Notifications',
            'description' => 'Adjust email and mobile push notifications to control how often you hear from PEEQ. Opt-in/out with just one click.',
            'img_url' => env('APP_URL') . '/assets/images/New.png',
            'button_title' => 'Adjust Notification',
            'is_mobile' => 1,
            'redirection_tag' => 2,
        ]);

        WelcomeChecklist::create([
            'id' => 3,
            'step_number' => 1,
            'title' => 'Complete Your Profile',
            'description' => 'Complete your profile to edit what others can see about you. Here, you can add a profile image, bio and professional information.',
            'img_url' => env('APP_URL') . '/assets/images/info.png',
            'button_title' => 'Setup Profile',
            'is_mobile' => 0,
            'redirection_tag' => 1,
        ]);

        WelcomeChecklist::create([
            'id' => 4,
            'step_number' => 2,
            'title' => 'Setup Notifications',
            'description' => 'Adjust email and mobile push notifications to control how often you hear from PEEQ. Opt-in/out with just one click.',
            'img_url' => env('APP_URL') . '/assets/images/New.png',
            'button_title' => 'Adjust Notification',
            'is_mobile' => 0,
            'redirection_tag' => 2,
        ]);
        
        WelcomeChecklist::create([
            'id' => 5,
            'step_number' => 3,
            'title' => 'Download the App',
            'description' => 'If you’re signing in via the web app, download the mobile app to access PEEQ instantly through your mobile device.',
            'img_url' => env('APP_URL') . '/assets/images/loading-amico.png',
            'button_title' => 'Download',
            'is_mobile' => 0,
            'redirection_tag' => 3,
        ]);
    }
}
