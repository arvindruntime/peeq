<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            TimeZoneSeeder::class,
            UserSeeder::class,
            WelcomePopupSeeder::class,
            WelcomeChecklistSeeder::class,
            CurrencySeeder::class,
            NotificationSeeder::class,
            NotificationDetailSeeder::class,
            PlanSeeder::class,
            PlanTransactionSeeder::class,
            MediaSeeder::class,
            CmsPageSeeder::class,
            VersionControlSeeder::class,
        ]);
    }
}
