<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->insert([
            [
                'id' => 1,
                'grade_name' => '学部1年',
            ],
            [
                'id' => 2,
                'grade_name' => '学部2年',
            ],
            [
                'id' => 3,
                'grade_name' => '学部3年',
            ],
            [
                'id' => 4,
                'grade_name' => '学部4年',
            ],
            [
                'id' => 5,
                'grade_name' => '学部5年',
            ],
            [
                'id' => 6,
                'grade_name' => '学部6年',
            ],
            [
                'id' => 7,
                'grade_name' => '大学院1年',
            ],
            [
                'id' => 8,
                'grade_name' => '大学院2年',
            ],
            [
                'id' => 9,
                'grade_name' => '大学院3年',
            ],
            [
                'id' => 10,
                'grade_name' => '大学院4年',
            ],
        ]);
    }
}
