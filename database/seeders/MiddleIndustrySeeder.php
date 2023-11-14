<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiddleIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('middle_industries')->insert([
            [
                'id' => 1,
                'major_class_id' => 1,
                'industry_name' => '農業',
            ],
            [
                'id' => 2,
                'major_class_id' => 1,
                'industry_name' => '林業',
            ],
            [
                'id' => 3,
                'major_class_id' => 2,
                'industry_name' => '漁業(水産養殖業を除く)',
            ],
            [
                'id' => 4,
                'major_class_id' => 2,
                'industry_name' => '水産養殖業',
            ],
            [
                'id' => 5,
                'major_class_id' => 3,
                'industry_name' => '鉱業・採石業・砂利採取業',
            ],
            [
                'id' => 6,
                'major_class_id' => 4,
                'industry_name' => '総合工事業',
            ],
            [
                'id' => 7,
                'major_class_id' => 4,
                'industry_name' => '職別工事業(設備工事業を除く)',
            ],
            [
                'id' => 8,
                'major_class_id' => 4,
                'industry_name' => '設備工事業',
            ],
            [
                'id' => 9,
                'major_class_id' => 5,
                'industry_name' => '食料品製造業',
            ],
            [
                'id' => 10,
                'major_class_id' => 5,
                'industry_name' => '飲料・たばこ・飼料製造業',
            ],
            [
                'id' => 11,
                'major_class_id' => 5,
                'industry_name' => '繊維工業',
            ],
            [
                'id' => 12,
                'major_class_id' => 5,
                'industry_name' => '木材・木製品製造業(家具を除く)',
            ],
            [
                'id' => 13,
                'major_class_id' => 5,
                'industry_name' => '家具・装備品製造業',
            ],
            [
                'id' => 14,
                'major_class_id' => 5,
                'industry_name' => 'パルプ・紙・紙加工品製造業',
            ],
            [
                'id' => 15,
                'major_class_id' => 5,
                'industry_name' => '印刷・同関連業',
            ],
            [
                'id' => 16,
                'major_class_id' => 5,
                'industry_name' => '化学工業',
            ],
            [
                'id' => 17,
                'major_class_id' => 5,
                'industry_name' => '石油製品・石炭製品製造業',
            ],
            [
                'id' => 18,
                'major_class_id' => 5,
                'industry_name' => 'プラスチック製品製造業',
            ],
            [
                'id' => 19,
                'major_class_id' => 5,
                'industry_name' => 'ゴム製品製造業',
            ],
            [
                'id' => 20,
                'major_class_id' => 5,
                'industry_name' => 'なめし革・同製品・毛皮製造業',
            ],
            [
                'id' => 21,
                'major_class_id' => 5,
                'industry_name' => '窯業・土石製品製造業',
            ],
            [
                'id' => 22,
                'major_class_id' => 5,
                'industry_name' => '鉄鋼業',
            ],
            [
                'id' => 23,
                'major_class_id' => 5,
                'industry_name' => '非鉄金属製造業',
            ],
            [
                'id' => 24,
                'major_class_id' => 5,
                'industry_name' => '金属製品製造業',
            ],
            [
                'id' => 25,
                'major_class_id' => 5,
                'industry_name' => 'はん用機械器具製造業',
            ],
            [
                'id' => 26,
                'major_class_id' => 5,
                'industry_name' => '生産用機械器具製造業',
            ],
            [
                'id' => 27,
                'major_class_id' => 5,
                'industry_name' => '業務用機械器具製造業',
            ],
            [
                'id' => 28,
                'major_class_id' => 5,
                'industry_name' => '電子部品・デバイス・電子回路製造業',
            ],
            [
                'id' => 29,
                'major_class_id' => 5,
                'industry_name' => '電気機械器具製造業',
            ],
            [
                'id' => 30,
                'major_class_id' => 5,
                'industry_name' => '情報通信機械器具製造業',
            ],
            [
                'id' => 31,
                'major_class_id' => 5,
                'industry_name' => '輸送用機械器具製造業',
            ],
            [
                'id' => 32,
                'major_class_id' => 5,
                'industry_name' => 'その他の製造業',
            ],
            [
                'id' => 33,
                'major_class_id' => 6,
                'industry_name' => '電気業',
            ],
            [
                'id' => 34,
                'major_class_id' => 6,
                'industry_name' => 'ガス業',
            ],
            [
                'id' => 35,
                'major_class_id' => 6,
                'industry_name' => '熱供給業',
            ],
            [
                'id' => 36,
                'major_class_id' => 6,
                'industry_name' => '水道業',
            ],
            [
                'id' => 37,
                'major_class_id' => 7,
                'industry_name' => '通信業',
            ],
            [
                'id' => 38,
                'major_class_id' => 7,
                'industry_name' => '放送業',
            ],
            [
                'id' => 39,
                'major_class_id' => 7,
                'industry_name' => '情報サービス業',
            ],
            [
                'id' => 40,
                'major_class_id' => 7,
                'industry_name' => 'インターネット附随サービス業',
            ],
            [
                'id' => 41,
                'major_class_id' => 7,
                'industry_name' => '映像・音声・文字情報制作業',
            ],
            [
                'id' => 42,
                'major_class_id' => 8,
                'industry_name' => '鉄道業',
            ],
            [
                'id' => 43,
                'major_class_id' => 8,
                'industry_name' => '道路旅客運送業',
            ],
            [
                'id' => 44,
                'major_class_id' => 8,
                'industry_name' => '道路貨物運送業',
            ],
            [
                'id' => 45,
                'major_class_id' => 8,
                'industry_name' => '水運業',
            ],
            [
                'id' => 46,
                'major_class_id' => 8,
                'industry_name' => '航空運輸業',
            ],
            [
                'id' => 47,
                'major_class_id' => 8,
                'industry_name' => '倉庫業',
            ],
            [
                'id' => 48,
                'major_class_id' => 8,
                'industry_name' => '運輸に附帯するサービス業',
            ],
            [
                'id' => 49,
                'major_class_id' => 8,
                'industry_name' => '郵便業(通信便事業を含む)',
            ],
            [
                'id' => 50,
                'major_class_id' => 9,
                'industry_name' => '各種商品卸売業',
            ],
            [
                'id' => 51,
                'major_class_id' => 9,
                'industry_name' => '繊維・衣服等卸売業',
            ],
            [
                'id' => 52,
                'major_class_id' => 9,
                'industry_name' => '飲食料品卸売業',
            ],
            [
                'id' => 53,
                'major_class_id' => 9,
                'industry_name' => '建築材料、鉱物・金属材料等卸売業',
            ],
            [
                'id' => 54,
                'major_class_id' => 9,
                'industry_name' => '機械器具卸売業',
            ],
            [
                'id' => 55,
                'major_class_id' => 9,
                'industry_name' => 'その他の卸売業',
            ],
            [
                'id' => 56,
                'major_class_id' => 9,
                'industry_name' => '各種商品小売業',
            ],
            [
                'id' => 57,
                'major_class_id' => 9,
                'industry_name' => '繊維・衣服・身の回り品等小売業',
            ],
            [
                'id' => 58,
                'major_class_id' => 9,
                'industry_name' => '飲食料品小売業',
            ],
            [
                'id' => 59,
                'major_class_id' => 9,
                'industry_name' => '機械器具小売業',
            ],
            [
                'id' => 60,
                'major_class_id' => 9,
                'industry_name' => 'その他の小売業',
            ],
            [
                'id' => 61,
                'major_class_id' => 9,
                'industry_name' => '無店舗小売業',
            ],
            [
                'id' => 62,
                'major_class_id' => 10,
                'industry_name' => '銀行業',
            ],
            [
                'id' => 63,
                'major_class_id' => 10,
                'industry_name' => '協同組織金融業',
            ],
            [
                'id' => 64,
                'major_class_id' => 10,
                'industry_name' => '貸金業、クレジットカード業等非預金信用機関',
            ],
            [
                'id' => 65,
                'major_class_id' => 10,
                'industry_name' => '金融商品取引業、商品先物取引業',
            ],
            [
                'id' => 66,
                'major_class_id' => 10,
                'industry_name' => '補助的金融業等',
            ],
            [
                'id' => 67,
                'major_class_id' => 10,
                'industry_name' => '保険業(保健媒介代理業、保健サービス業を含む)',
            ],
            [
                'id' => 68,
                'major_class_id' => 11,
                'industry_name' => '不動産取引業',
            ],
            [
                'id' => 69,
                'major_class_id' => 11,
                'industry_name' => '不動産賃貸業・管理業',
            ],
            [
                'id' => 70,
                'major_class_id' => 11,
                'industry_name' => '物品賃貸業',
            ],
            [
                'id' => 71,
                'major_class_id' => 12,
                'industry_name' => '学術・開発研究機関',
            ],
            [
                'id' => 72,
                'major_class_id' => 12,
                'industry_name' => '専門サービス業(他に分類されないもの)',
            ],
            [
                'id' => 73,
                'major_class_id' => 12,
                'industry_name' => '広告業',
            ],
            [
                'id' => 74,
                'major_class_id' => 12,
                'industry_name' => '技術サービス業(他に分類されないもの)',
            ],
            [
                'id' => 75,
                'major_class_id' => 13,
                'industry_name' => '宿泊業',
            ],
            [
                'id' => 76,
                'major_class_id' => 13,
                'industry_name' => '飲食店',
            ],
            [
                'id' => 77,
                'major_class_id' => 13,
                'industry_name' => '持ち帰り・配達飲食サービス業',
            ],
            [
                'id' => 78,
                'major_class_id' => 14,
                'industry_name' => '洗濯・理容・美容・浴場業',
            ],
            [
                'id' => 79,
                'major_class_id' => 14,
                'industry_name' => 'その他の生活関連サービス業',
            ],
            [
                'id' => 80,
                'major_class_id' => 14,
                'industry_name' => '娯楽業',
            ],
            [
                'id' => 81,
                'major_class_id' => 15,
                'industry_name' => '学校教育',
            ],
            [
                'id' => 82,
                'major_class_id' => 15,
                'industry_name' => 'その他の教育、学習支援業',
            ],
            [
                'id' => 83,
                'major_class_id' => 16,
                'industry_name' => '医療業',
            ],
            [
                'id' => 84,
                'major_class_id' => 16,
                'industry_name' => '保健衛生',
            ],
            [
                'id' => 85,
                'major_class_id' => 16,
                'industry_name' => '社会保険・社会福祉・介護事業',
            ],
            [
                'id' => 86,
                'major_class_id' => 17,
                'industry_name' => '郵便局',
            ],
            [
                'id' => 87,
                'major_class_id' => 17,
                'industry_name' => '協同組合(他に分類されないもの)',
            ],
            [
                'id' => 88,
                'major_class_id' => 18,
                'industry_name' => '廃棄物処理業',
            ],
            [
                'id' => 89,
                'major_class_id' => 18,
                'industry_name' => '自動車整備業',
            ],
            [
                'id' => 90,
                'major_class_id' => 18,
                'industry_name' => '機械等修理業',
            ],
            [
                'id' => 91,
                'major_class_id' => 18,
                'industry_name' => '職業紹介・労働者派遣業',
            ],
            [
                'id' => 92,
                'major_class_id' => 18,
                'industry_name' => 'その他の事業サービス業',
            ],
            [
                'id' => 93,
                'major_class_id' => 18,
                'industry_name' => '政治・経済・文化団体',
            ],
            [
                'id' => 94,
                'major_class_id' => 18,
                'industry_name' => '宗教',
            ],
            [
                'id' => 95,
                'major_class_id' => 18,
                'industry_name' => 'その他のサービス業',
            ],
            [
                'id' => 96,
                'major_class_id' => 18,
                'industry_name' => '外国公務',
            ],
            [
                'id' => 97,
                'major_class_id' => 19,
                'industry_name' => '国家公務',
            ],
            [
                'id' => 98,
                'major_class_id' => 19,
                'industry_name' => '地方公務',
            ],
            [
                'id' => 99,
                'major_class_id' => 20,
                'industry_name' => '分類不能の産業',
            ]
        ]);
    }
}
