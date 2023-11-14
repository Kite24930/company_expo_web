<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
            'company_logo' => fake()->imageUrl(480, 480, 'cats'),
            'company_img' => fake()->imageUrl(640, 480, 'cats'),
            'company_name' => fake()->company(),
            'company_name_ruby' => fake()->company(),
            'mieet_plus_id' => null,
            'url' => fake()->url(),
            'business_detail' => fake()->realText(300),
            'pr' => fake()->realText(300),
            'head_office_address' => fake()->streetAddress(),
            'head_office_lat' => fake()->latitude(),
            'head_office_lng' => fake()->longitude(),
            'established_at' => fake()->date(),
            'capital' => fake()->numberBetween(1000, 100000),
            'sales' => fake()->numberBetween(1000, 100000),
            'employees' => fake()->numberBetween(50, 50000),
            'mie_univ_ob_og' => fake()->numberBetween(0, 150),
            'job_detail' => fake()->realText(300),
            'planned_number' => fake()->numberBetween(1, 10),
            'recruit_department' => fake()->jobTitle(),
            'recruit_in_charge_person' => fake()->name(),
            'recruit_in_charge_person_ruby' => fake()->name(),
            'recruit_in_charge_email' => '',
            'recruit_in_charge_tel' => fake()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function user(int $id, string $email): CompanyFactory
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $id,
            'recruit_in_charge_email' => $email,
        ]);
    }
}
