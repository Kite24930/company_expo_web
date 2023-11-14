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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned()->comment('学生ID');
            $table->integer('company_id')->unsigned()->comment('企業ID');
            $table->tinyInteger('disclosure')->comment('開示設定 0:開示拒否, 1:開示許可');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiters');
    }
};
