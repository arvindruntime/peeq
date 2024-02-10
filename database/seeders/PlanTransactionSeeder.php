<?php

namespace Database\Seeders;

use App\Models\PlanTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanTransaction::create([
            'user_id' => 1,
            'plan_id' => 1,
            'final_amount' => 0,
            'payment_status' => 1,
        ]);
        PlanTransaction::create([
            'user_id' => 2,
            'plan_id' => 1,
            'final_amount' => 0,
            'payment_status' => 1,
        ]);
        PlanTransaction::create([
            'user_id' => 3,
            'plan_id' => 1,
            'final_amount' => 0,
            'payment_status' => 1,
        ]);
    }
}
