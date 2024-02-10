<?php

namespace Database\Seeders;

use App\Models\VersionControl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VersionControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VersionControl::create([
            'android_version' => '1',
            'android_is_force_update' => 1,
            'android_message' => 'You have a new update on Play Store',
            'ios_version' => '1.0',
            'ios_is_force_update' => 1,
            'ios_message' => 'You have a new update on App Store',
        ]);
    }
}
