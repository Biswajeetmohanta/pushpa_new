<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'description',
        'qualifications',
        'image',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'sort_order',
        'is_active'
    ];
}
