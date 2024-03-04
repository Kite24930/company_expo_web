<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneWordPr extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'one_word_pr',
        'background_color',
        'text_color',
    ];
}
