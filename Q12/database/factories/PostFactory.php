<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480),
            'content' => $this->faker->paragraph,
            'is_active' => 1,
            'order_no' => null,
        ];
    }
}
