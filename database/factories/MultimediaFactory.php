<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Multimedia>
 */
class MultimediaFactory extends Factory
{
    public function definition(): array
    {
        static $imageNumber = 1;
        return [
            'name'=>'imagen'.$imageNumber++.'.jpg',
            'moment_id' => $this->faker->numberBetween(1, 4),
            'user_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
