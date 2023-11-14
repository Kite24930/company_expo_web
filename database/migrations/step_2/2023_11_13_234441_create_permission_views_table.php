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
        DB::statement('create or replace view permission_views as select x.id as id, x.name as name, y.role_id as role_id, z.name as role_name from users as x left join model_has_roles as y on x.id = y.model_id left join roles as z on y.role_id = z.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_views');
    }
};
