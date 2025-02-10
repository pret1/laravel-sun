<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    private array $genders = ['male', 'female'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => User::inRandomOrder()->first()->id,
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'gender' => Arr::random($this->genders),
        ];
    }
}
