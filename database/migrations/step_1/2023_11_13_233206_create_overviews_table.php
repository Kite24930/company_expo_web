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
        Schema::create('overviews', function (Blueprint $table) {
            $table->id();
            $table->string('target')->comment('イベント対象者');
            $table->string('title')->comment('イベント名');
            $table->string('description')->comment('イベント説明、補足等');
            $table->string('place')->comment('開催場所');
            $table->string('remarks')->comment('備考');
            $table->tinyInteger('period_change_status')->comment('ピリオドで企業の入れ替わりがあるかどうか 0:切り替わりなし, 1:切り替わりあり');
            $table->string('footer_hosts')->comment('フッター挿入：主催、共催');
            $table->string('footer_in_charge')->comment('フッター挿入：担当者');
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'OverViewSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overviews');
    }
};
