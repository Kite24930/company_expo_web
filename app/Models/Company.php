<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_logo',
        'company_img',
        'company_name',
        'company_name_ruby',
        'mieet_plus_id',
        'url',
        'business_detail',
        'pr',
        'head_office_address',
        'head_office_lat',
        'head_office_lng',
        'established_at',
        'capital',
        'sales',
        'employees',
        'mie_univ_ob_og',
        'job_detail',
        'planned_number',
        'recruit_department',
        'recruit_in_charge_person',
        'recruit_in_charge_person_ruby',
        'recruit_in_charge_tel',
        'recruit_in_charge_email',
    ];
}
