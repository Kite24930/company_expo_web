<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('major_industries')->insert([
            [
                'id' => 1,
                'major_class_name' => '農業・林業',
            ],
            [
                'id' => 2,
                'major_class_name' => '漁業',
            ],
            [
                'id' => 3,
                'major_class_name' => '鉱業・採石業・砂利採取業',
            ],
            [
                'id' => 4,
                'major_class_name' => '建設業',
            ],
            [
                'id' => 5,
                'major_class_name' => '製造業',
            ],
            [
                'id' => 6,
                'major_class_name' => '電気・ガス・熱供給・水道業',
            ],
            [
                'id' => 7,
                'major_class_name' => '情報通信業',
            ],
            [
                'id' => 8,
                'major_class_name' => '運輸業・郵便業',
            ],
            [
                'id' => 9,
                'major_class_name' => '卸売業・小売業',
            ],
            [
                'id' => 10,
                'major_class_name' => '金融業・保険業',
            ],
            [
                'id' => 11,
                'major_class_name' => '不動産業・物品賃貸業',
            ],
            [
                'id' => 12,
                'major_class_name' => '学術研究・専門・技術サービス業',
            ],
            [
                'id' => 13,
                'major_class_name' => '宿泊業・飲食サービス業',
            ],
            [
                'id' => 14,
                'major_class_name' => '生活関連サービス業・娯楽業',
            ],
            [
                'id' => 15,
                'major_class_name' => '教育・学習支援業',
            ],
            [
                'id' => 16,
                'major_class_name' => '医療・福祉',
            ],
            [
                'id' => 17,
                'major_class_name' => '複合サービス事業',
            ],
            [
                'id' => 18,
                'major_class_name' => 'サービス業（他に分類されないもの）',
            ],
            [
                'id' => 19,
                'major_class_name' => '公務（他に分類されるものを除く）',
            ],
            [
                'id' => 20,
                'major_class_name' => '分類不能の産業',
            ],
        ]);
    }
}
