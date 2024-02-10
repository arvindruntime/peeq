<?php

namespace Database\Seeders;

use App\Models\WelcomePopup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomePopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WelcomePopup::create([
            'title' => 'Welcome to PEEQ',
            'video_url' => env('APP_URL') . '/assets/video/Welcome-Inside-PEEQ.mp4',
            'description' => 'Thank you for signing up to PEEQ, we are thrilled to have you here. In this quick opening video, PEEQ founder and CEO, Zoe Williams welcomes you to the network and explains how she created PEEQ, how best to use the platform and her vision for the future of this incredible network of leaders.',
            'status' => 'active',
        ]);
    }
}
