<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Peeq',
            'last_name' => 'Admin',
            'job_title' => 'Director',
            'company_name' => 'PEEQ',
            'email' => 'admin@peeq.com',
            'password' => bcrypt('Admin@123'),
            'mobile_no' => '9876543210',
            'location_id' => 374,
            'timezone_id' => 370,
            'is_admin' => 1,
            'is_plan_activated' => 1,
            'user_type' => 'Host',
            'step_verification' => '1,3,2,4,5'
        ]);
        User::factory()->create([
            'first_name' => 'Guest',
            'last_name' => 'User',
            'job_title' => '-',
            'company_name' => '-',
            'email' => 'guestuser@peeq.com',
            'password' => bcrypt('Guestuser@123'),
            'mobile_no' => '9876543211',
            'location_id' => 33,
            'timezone_id' => 35,
            'status' => 'inactive',
            'is_plan_activated' => 1,
            'user_type' => 'Member',
        ]);
        User::factory()->create([
            'first_name' => 'Sean',
            'last_name' => 'Martin',
            'job_title' => 'CEO',
            'company_name' => 'PEEQ',
            'email' => 'seanmartin@gmail.com',
            'password' => bcrypt('Sean@123'),
            'mobile_no' => '9876543212',
            'location_id' => 33,
            'timezone_id' => 35,
            'is_plan_activated' => 1,
            'user_type' => 'Coach',
        ]);
    }
}
