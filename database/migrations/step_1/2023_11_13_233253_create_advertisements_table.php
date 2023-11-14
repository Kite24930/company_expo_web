<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->unsigned()->comment('企業ID');
            $table->string('banner_img')->comment('バナー画像');
            $table->string('title')->comment('タイトル');
            $table->string('ad')->comment('広告コンテンツ');
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'AdvertisementSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
