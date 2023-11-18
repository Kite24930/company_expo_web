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
        DB::statement('create or replace view distribution_views as select row_number() over(order by date asc, period_start asc, booth_number asc) as id, x.date as date, y.period as period, y.period_start as period_start, y.period_end as period_end, z.booth_number as booth_number from dates as x cross join periods as y cross join booths as z');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_views');
    }
};