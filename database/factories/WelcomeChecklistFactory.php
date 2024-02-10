<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WelcomeChecklist>
 */
class WelcomeChecklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'img_url' => $faker->img_url('public/storage/assets/images/loading-amico.png',640,480, null, false),
        ];
    }
}
