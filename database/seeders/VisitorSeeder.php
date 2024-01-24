<?php

namespace Database\Seeders;

use App\Models\Follower;
use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $target_company_id = 101;
        for ($i = 0; $i < 100; $i++) {
            while (true) {
                $target_company_id = rand(1, 100);
                $student_id = rand(1, 134);
                if (Visitor::where('student_id', $student_id)->where('company_id', $target_company_id)->count() === 0) {
                    break;
                }
            }
            Visitor::create([
                'company_id' => $target_company_id,
                'student_id' => $student_id,
                'disclosure' => rand(0, 1),
            ]);
        }
    }
}
