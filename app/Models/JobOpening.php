<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'department',
        'location',
        'employment_type',
        'experience_required',
        'salary_range',
        'description',
        'requirements',
        'is_active',
        'sort_order',
    ];

    /**
     * Get the applications associated with the job opening.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
