<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'plan_title' => 'PEEQ Network - 12 Months Free',
            'plan_description' => 'Connect with leaders, attend all live events hosted by expert leadership coaches and access exclusive EQ and leadership development content.',
            'plan_type' => 'yearly',
            'plan_amount' => 0,
            'plan_duration' => '365',
            'currency_id' => 5,
            'status' => 'active',
        ]);
    }
}
