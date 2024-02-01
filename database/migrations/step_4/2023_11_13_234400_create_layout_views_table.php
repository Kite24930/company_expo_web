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
        DB::statement('create or replace view layout_views as select x.distribution_id as distribution_id, y.date as date, y.period as period, y.period_start as period_start, y.period_end as period_end, y.booth_number as booth_number, x.company_id as company_id, z.user_id as user_id, z.company_logo as company_logo, z.company_img as company_img, z.company_name as company_name, z.company_name_ruby as company_name_ruby, z.mieet_plus_id as mieet_plus_id, z.url as url, z.business_detail as business_detail, z.pr as pr, z.head_office_address as head_office_address, z.head_office_lat as head_office_lat, z.head_office_lng as head_office_lng, z.established_at as established_at, z.capital as capital, z.sales as sales, z.employees as employees, z.mie_univ_ob_og as mie_univ_ob_og, z.job_detail as job_detail, z.planned_number as planned_number, z.recruit_department as recruit_department, z.recruit_in_charge_person as recruit_in_charge_person, z.recruit_in_charge_person_ruby as recruit_in_charge_person_ruby, z.recruit_in_charge_tel as recruit_in_charge_tel, z.recruit_in_charge_email as recruit_in_charge_email, a.industry_id as industry_id, a.industry_name as industry_name, a.major_class_id as major_class_id, a.major_class_name as major_class_name, z.created_at as created_at, z.updated_at as updated_at from layouts as x left join distribution_views as y on x.distribution_id = y.id left join companies as z on x.company_id = z.id left join company_industry_views as a on x.company_id = a.company_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_views');
    }
};
