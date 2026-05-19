<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_opening_id',
        'name',
        'email',
        'phone',
        'resume',
        'cover_letter',
        'status',
    ];

    /**
     * Get the job opening associated with this application.
     */
    public function jobOpening()
    {
        return $this->belongsTo(JobOpening::class);
    }
}
