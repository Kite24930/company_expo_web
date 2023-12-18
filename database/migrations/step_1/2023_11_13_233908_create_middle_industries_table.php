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
        Schema::create('middle_industries', function (Blueprint $table) {
            $table->id();
            $table->integer('major_class_id')->unsigned()->comment('大分類ID');
            $table->string('industry_name')->comment('中分類名');
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'MiddleIndustrySeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('middle_industries');
    }
};
