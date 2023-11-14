<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoothNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $booth_max_number = 60;

        $booth_numbers = [];
        for ($i = 1; $i <= $booth_max_number; $i++) {
            $booth_numbers[] = [
                'booth_number' => $i,
            ];
        }

        DB::table('booths')->insert($booth_numbers);
    }
}
