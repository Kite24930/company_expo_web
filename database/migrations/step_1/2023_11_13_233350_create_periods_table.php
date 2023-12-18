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
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('period')->comment('区分名 exe)第一部');
            $table->time('period_start')->comment('開始時間');
            $table->time('period_end')->comment('終了時間');
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'PeriodSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
