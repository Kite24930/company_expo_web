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
        DB::statement('create or replace view student_views as select x.id as id, x.user_id as user_id, x.student_name as student_name, x.gender as gender, x.email as email, x.tel as tel, x.faculty_id as faculty_id, y.faculty_name as faculty_name, x.grade_id as grade_id, z.grade_name as grade_name, x.birthplace as birthplace, x.address as address, x.follow_disclosure as follow_disclosure, x.created_at as created_at, x.updated_at as updated_at from students as x left join faculties as y on x.faculty_id = y.id left join grades as z on x.grade_id = z.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_views');
    }
};
