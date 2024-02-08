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
        DB::statement('create or replace view distribution_views as select x.id as id, x.date_id as date_id, y.date as date, x.period_id as period_id, z.period as period, z.period_start as period_start, z.period_end as period_end, x.booth_id as booth_id, a.booth_number as booth_number from layouts as x left join dates as y on x.date_id = y.id left join periods as z on x.period_id = z.id left join booths as a on x.booth_id = a.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_views');
    }
};
