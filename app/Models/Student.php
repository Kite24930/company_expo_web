<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_name',
        'gender',
        'email',
        'tel',
        'faculty_id',
        'grade_id',
        'birthplace',
        'address',
        'follow_disclosure',
    ];
}
