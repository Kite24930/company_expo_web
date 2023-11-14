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
        DB::statement('create or replace view company_industry_views as select x.id as id, x.company_id as company_id, x.industry_id as industry_id, y.industry_name as industry_name, y.major_class_id as major_class_id, y.major_class_name as major_class_name from industries as x left join industry_views as y on x.industry_id = y.industry_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_industry_views');
    }
};
