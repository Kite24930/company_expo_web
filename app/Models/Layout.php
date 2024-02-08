<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribution_id',
        'date_id',
        'period_id',
        'booth_id',
        'company_id',
    ];
}
