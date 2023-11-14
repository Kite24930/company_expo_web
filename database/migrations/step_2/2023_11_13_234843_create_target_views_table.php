<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('create or replace view target_views as select x.id as id, x.company_id as company_id, x.faculty_id as faculty_id, y.faculty_name as faculty_name from targets as x left join faculties as y on x.faculty_id = y.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_views');
    }
};
