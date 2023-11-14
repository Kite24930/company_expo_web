<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorIndustry extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_class_name',
    ];
}
