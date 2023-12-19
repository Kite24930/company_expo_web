<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'target',
        'title',
        'description',
        'place',
        'remarks',
        'period_change_status',
        'footer_hosts',
        'footer_in_charge',
        'created_at',
        'updated_at',
    ];
}
