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
            ],
            [
                'id' => 2,
                'faculty_name' => '教育学部',
            ],
            [
                'id' => 3,
                'faculty_name' => '医学部',
            ],
            [
                'id' => 4,
                'faculty_name' => '工学部',
            ],
            [
                'id' => 5,
                'faculty_name' => '生物資源学部',
            ],
            [
                'id' => 6,
                'faculty_name' => '人文社会科学研究科',
            ],
            [
                'id' => 7,
                'faculty_name' => '教育学研究科',
            ],
            [
                'id' => 8,
                'faculty_name' => '医学系研究科',
            ],
            [
                'id' => 9,
                'faculty_name' => '工学研究科',
            ],
            [
                'id' => 10,
                'faculty_name' => '生物資源学研究科',
            ],
            [
                'id' => 11,
                'faculty_name' => '地域イノベーション学研究科',
            ]
        ]);
    }
}
