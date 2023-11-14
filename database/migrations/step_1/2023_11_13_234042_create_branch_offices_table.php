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
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned()->comment('会社ID');
            $table->string('office_name')->comment('支社名');
            $table->string('office_address')->comment('支社住所');
            $table->double('office_lat')->unsigned()->comment('支社緯度');
            $table->double('office_lng')->unsigned()->comment('支社経度');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_offices');
    }
};
