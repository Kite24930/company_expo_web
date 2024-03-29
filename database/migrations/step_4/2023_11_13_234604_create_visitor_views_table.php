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
        DB::statement('create or replace view visitor_views as select x.id as id, x.student_id as student_id, y.user_id as student_user_id, y.student_name as student_name, y.gender as student_gender, y.email as student_email, y.tel as student_tel, y.faculty_id as student_faculty_id, y.faculty_name as student_faculty_name, y.faculty_color as student_faculty_color, y.grade_id as student_grade_id, y.grade_name as student_grade_name, y.grade_color as student_grade_color, y.birthplace as student_birthplace, y.address as student_address, y.follow_disclosure as student_follow_disclosure, y.created_at as student_created_at, y.updated_at as student_updated_at, x.company_id as company_id, z.user_id as company_user_id, z.distribution_id as distribution_id, z.date as date, z.period as period, z.period_start as period_start, z.period_end as period_end, z.booth_number as booth_number, z.company_logo as company_logo, z.company_img as company_img, z.company_name as company_name, z.company_name_ruby as company_name_ruby, z.mieet_plus_id as mieet_plus_id, z.url as url, z.business_detail as business_detail, z.pr as pr, z.head_office_address as head_office_address, z.head_office_lat as head_office_lat, z.head_office_lng as head_office_lng, z.established_at as established_at, z.capital as capital, z.sales as sales, z.employees as employees, z.mie_univ_ob_og as mie_univ_ob_og, z.job_detail as job_detail, z.planned_number as planned_number, z.recruit_department as recruit_department, z.recruit_in_charge_person as recruit_in_charge_person, z.recruit_in_charge_person_ruby as recruit_in_charge_person_ruby, z.recruit_in_charge_tel as recruit_in_charge_tel, z.recruit_in_charge_email as recruit_in_charge_email, a.industry_id as industry_id, a.industry_name as industry_name, a.major_class_id as major_class_id, a.major_class_name as major_class_name, z.created_at as company_created_at, z.updated_at as company_updated_at, x.disclosure as disclosure, x.created_at as created_at, x.updated_at as updated_at from visitors as x left join student_views as y on x.student_id = y.id left join layout_views as z on x.company_id = z.company_id left join company_industry_views as a on x.company_id = a.company_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiter_views');
    }
};
