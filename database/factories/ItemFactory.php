<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $image = [
            'baloon.jpg',
            'dice.jpeg',
            'p.png',
        ];

        // random image
        $imageName = $image[array_rand($image)];
        return [
            // faker unique name
            'name' => $this->faker->unique()->name,
            'buying_price' => $this->faker->numberBetween(1, 100),
            'selling_price' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'picture' => $imageName,
        ];
    }
}
