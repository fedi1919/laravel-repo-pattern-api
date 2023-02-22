<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'title' => $this->faker->unique()->sentence(4),
            'content' => $this->faker->paragraph(3),
            'price' => $this->faker->randomNumber(4),
            'rate' =>$this->faker->randomElement([1,2,3,4,5])
        ];
    }
}
