<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periods')->insert(
            [
                [
                    'period' => '第一部',
                    'period_start' => '09:30:00',
                    'period_end' => '11:30:00',
                ],
                [
                    'period' => '第二部',
                    'period_start' => '12:30:00',
                    'period_end' => '14:30:00',
                ],
            ]
        );
    }
}
