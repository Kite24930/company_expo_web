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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ユーザーID');
            $table->string('student_name')->comment('生徒名');
            $table->integer('gender')->comment('性別 0:男性, 1:女性, 2:非回答');
            $table->string('email')->comment('メールアドレス');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->integer('faculty_id')->unsigned()->comment('学部ID');
            $table->integer('grade_id')->unsigned()->comment('学年ID');
            $table->string('birthplace')->comment('出身地');
            $table->string('address')->comment('住所');
            $table->tinyInteger('follow_disclosure')->default(0)->comment('フォロー時の企業への情報開示設定 0:開示拒否, 1:開示許可');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
