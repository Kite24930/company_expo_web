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
        Schema::create('major_industries', function (Blueprint $table) {
            $table->id();
            $table->string('major_class_name')->comment('大分類名');
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'MajorIndustrySeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('major_industries');
    }
};
