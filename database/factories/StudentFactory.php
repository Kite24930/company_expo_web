<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 0,
            'student_name' => fake()->name(),
            'gender' => fake()->biasedNumberBetween(0, 2, 'exp'),
            'email' => '',
            'tel' => fake()->phoneNumber(),
            'faculty_id' => fake()->numberBetween(1, 11),
            'grade_id' => fake()->numberBetween(1, 10),
            'birthplace' => fake()->streetAddress(),
            'address' => fake()->streetAddress(),
            'follow_disclosure' => fake()->numberBetween(0, 1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function user(int $id, string $email): StudentFactory
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $id,
            'email' => $email,
        ]);
    }
}
