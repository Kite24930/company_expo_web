<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ユーザーID');
            $table->string('company_logo')->nullable()->comment('会社ロゴ');
            $table->string('company_img')->nullable()->comment('イメージ画像');
            $table->string('company_name')->comment('会社名');
            $table->string('company_name_ruby')->comment('会社名(フリガナ)');
            $table->integer('mieet_plus_id')->nullable()->comment('MieetPlusID');
            $table->string('url')->nullable()->comment('URL');
            $table->longText('business_detail')->nullable()->comment('事業内容');
            $table->longText('pr')->nullable()->comment('PR');
            $table->string('head_office_address')->comment('本社所在地');
            $table->double('head_office_lat')->unsigned()->comment('本社緯度');
            $table->double('head_office_lng')->unsigned()->comment('本社経度');
            $table->date('established_at')->comment('設立年月日');
            $table->integer('capital')->comment('資本金');
            $table->integer('sales')->nullable()->comment('売上高');
            $table->integer('employees')->unsigned()->comment('従業員数');
            $table->integer('mie_univ_ob_og')->unsigned()->comment('三重大OB・OG数');
            $table->longText('job_detail')->nullable()->comment('仕事内容');
            $table->integer('planned_number')->unsigned()->comment('募集人数');
            $table->string('recruit_department')->comment('採用担当部署');
            $table->string('recruit_in_charge_person')->comment('採用担当者');
            $table->string('recruit_in_charge_person_ruby')->comment('採用担当者(フリガナ)');
            $table->string('recruit_in_charge_tel')->comment('採用担当者電話番号');
            $table->string('recruit_in_charge_email')->comment('採用担当者メールアドレス');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
