<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category',
        'location',
        'image',
        'description',
        'sort_order',
        'is_active',
        'client',
        'sector',
        'value',
        'timeline',
    ];
}
