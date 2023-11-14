<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $studentUser = User::factory()->create();
            $studentUser->assignRole('student');
            $student = Student::factory()->user($studentUser->id, $studentUser->email)->create();
            $companyUser = User::factory()->create();
            $companyUser->assignRole('company');
            $company = Company::factory()->user($companyUser->id, $companyUser->email)->create();
        }
    }
}
