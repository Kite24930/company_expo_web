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
                'color' => '#cbffd3'
            ],
            [
                'id' => 2,
                'grade_name' => '学部2年',
                'color' => '#b1f9d0'
            ],
            [
                'id' => 3,
                'grade_name' => '学部3年',
                'color' => '#edffbe'
            ],
            [
                'id' => 4,
                'grade_name' => '学部4年',
                'color' => '#c2eeff'
            ],
            [
                'id' => 5,
                'grade_name' => '学部5年',
                'color' => '#bad3ff'
            ],
            [
                'id' => 6,
                'grade_name' => '学部6年',
                'color' => '#dcc2ff'
            ],
            [
                'id' => 7,
                'grade_name' => '大学院1年',
                'color' => '#43ff6b'
            ],
            [
                'id' => 8,
                'grade_name' => '大学院2年',
                'color' => '#4df9b9'
            ],
            [
                'id' => 9,
                'grade_name' => '大学院3年',
                'color' => '#d0ff43'
            ],
            [
                'id' => 10,
                'grade_name' => '大学院4年',
                'color' => '#46eeff'
            ],
        ]);
    }
}
