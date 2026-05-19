<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'title',
        'description_heading',
        'description',
        'image',
        'sort_order',
        'is_active'
    ];
}
