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
        Schema::create('booths', function (Blueprint $table) {
            $table->integer('booth_number')->unsigned()->primary()->comment('ブース番号');
        });

        Artisan::call('db:seed', [
            '--class' => 'BoothNumberSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booths');
    }
};
