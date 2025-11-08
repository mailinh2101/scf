<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'position',
        'description',
        'location',
        'employment_type',
        'salary_range',
        'requirements',
        'benefits',
        'published',
        'published_at',
        'contact_email',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = \Illuminate\Support\Str::slug($job->title);
            }
        });

        static::updating(function ($job) {
            if ($job->isDirty('title') && empty($job->slug)) {
                $job->slug = \Illuminate\Support\Str::slug($job->title);
            }
        });
    }
}
