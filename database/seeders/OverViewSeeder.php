<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OverViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('overviews')->insert([
            'target' => '令和⚪︎年度卒対象',
            'title' => '学内合同企業説明会',
            'description' => '様々な業界の優良・人気企業が三重大学に集結！全ての企業が、まだまだ積極採用中！ぜひ参加して、内定を掴み取ろう！',
            'place' => '三重大学 三翠ホール',
            'remarks' => '登録不要・服装自由・入退場自由/1・2年生も見学OK![運営事務局]株式会社プロジェクトM',
            'period_change_status' => 1,
            'footer_hosts' => '【主催】三重大学工学部同窓会【共催】三重大学工学部、三重大学工学研究科、三重大学キャリアセンター、三重大学全学同窓会',
            'footer_in_charge' => '【企画・運営】株式会社プロジェクトM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
