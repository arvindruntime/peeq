<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::create([
            'name' => 'Test',
            'types' => 'image',
            'url' => env('APP_URL') . '/assets/images/g1.jpg',
            'added_by' => 1,
        ]);

        Media::create([
            'name' => 'Demo',
            'types' => 'image',
            'url' => env('APP_URL') . '/assets/images/g2.jpg',
            'added_by' => 1,
        ]);
    }
}
