<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            [
                'id' => 1,
                'faculty_name' => '人文学部',
                'color' => '#ffff33',
            ],
            [
                'id' => 2,
                'faculty_name' => '教育学部',
                'color' => '#33ffff',
            ],
            [
                'id' => 3,
                'faculty_name' => '医学部',
                'color' => '#ff33ff',
            ],
            [
                'id' => 4,
                'faculty_name' => '工学部',
                'color' => '#7b3cff',
            ],
            [
                'id' => 5,
                'faculty_name' => '生物資源学部',
                'color' => '#2dff57',
            ],
            [
                'id' => 6,
                'faculty_name' => '人文社会科学研究科',
                'color' => '#ffff99',
            ],
            [
                'id' => 7,
                'faculty_name' => '教育学研究科',
                'color' => '#99ffff',
            ],
            [
                'id' => 8,
                'faculty_name' => '医学系研究科',
                'color' => '#ff99ff',
            ],
            [
                'id' => 9,
                'faculty_name' => '工学研究科',
                'color' => '#b384ff',
            ],
            [
                'id' => 10,
                'faculty_name' => '生物資源学研究科',
                'color' => '#93ffab',
            ],
            [
                'id' => 11,
                'faculty_name' => '地域イノベーション学研究科',
                'color' => '#cccccc',
            ]
        ]);
    }
}
