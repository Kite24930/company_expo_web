<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('advertisements')->insert([
            'company_id' => 0,
            'banner_img' => 'projectm_ad.png',
            'title' => '株式会社プロジェクトM',
            'ad' => 'プロジェクトMは、三重大学発ベンチャー企業です。三重大学の学生の皆さんに、三重大学の学生のためのサービス展開を行っています。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
