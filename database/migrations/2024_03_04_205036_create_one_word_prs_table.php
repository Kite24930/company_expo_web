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
        Schema::create('one_word_prs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->comment('企業ID');
            $table->string('one_word_pr')->comment('ひとことPR');
            $table->string('background_color', 7)->comment('カラーコード');
            $table->string('text_color', 7)->comment('カラーコード');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('one_word_prs');
    }
};
