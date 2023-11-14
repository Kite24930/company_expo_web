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
        DB::statement('create or replace view industry_views as select x.id as industry_id, x.industry_name as industry_name, x.major_class_id as major_class_id, y.major_class_name as major_class_name from middle_industries as x left join major_industries as y on x.major_class_id = y.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_views');
    }
};
