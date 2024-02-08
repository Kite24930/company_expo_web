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
        DB::statement('create or replace view layout_views as select x.id as distribution_id, x.date_id as date_id, y.date as date, x.period_id as period_id, z.period as period, z.period_start as period_start, z.period_end as period_end, x.booth_id as booth_id, a.booth_number as booth_number, x.company_id as company_id, b.user_id as user_id, b.company_logo as company_logo, b.company_img as company_img, b.company_name as company_name, b.company_name_ruby as company_name_ruby, b.mieet_plus_id as mieet_plus_id, b.url as url, b.business_detail as business_detail, b.pr as pr, b.head_office_address as head_office_address, b.head_office_lat as head_office_lat, b.head_office_lng as head_office_lng, b.established_at as established_at, b.capital as capital, b.sales as sales, b.employees as employees, b.mie_univ_ob_og as mie_univ_ob_og, b.job_detail as job_detail, b.planned_number as planned_number, b.recruit_department as recruit_department, b.recruit_in_charge_person as recruit_in_charge_person, b.recruit_in_charge_person_ruby as recruit_in_charge_person_ruby, b.recruit_in_charge_tel as recruit_in_charge_tel, b.recruit_in_charge_email as recruit_in_charge_email, c.industry_id as industry_id, c.industry_name as industry_name, c.major_class_id as major_class_id, c.major_class_name as major_class_name, b.created_at as created_at, b.updated_at as updated_at from layouts as x left join dates as y on x.date_id = y.id left join periods as z on x.period_id = z.id left join booths as a on x.booth_id = a.id left join companies as b on x.company_id = b.id left join company_industry_views as c on x.company_id = c.company_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_views');
    }
};
