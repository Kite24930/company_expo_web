<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'office_name',
        'office_address',
        'office_lat',
        'office_lng',
    ];
}
