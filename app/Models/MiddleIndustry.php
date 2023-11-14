<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleIndustry extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_class_id',
        'industry_name',
    ];
}
