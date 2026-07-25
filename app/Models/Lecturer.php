<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = 'lecturers';
    protected $primaryKey = 'lecturer_id';
    public $timestamps = true;

    protected $fillable = [
        'lecturer_name',
        'lecturer_title',
        'lecturer_nip',
        'lecturer_image',
        'lecturer_position',
        'lecturer_email',
        'last_education',
        'education_history',
        'lecturer_expertise',
        'lecturer_type',
        'scholar_url',
        'scopus_url',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'is_advisor',
    ];

    protected $casts = [
        'is_advisor' => 'boolean',
    ];

    public function getFullNameWithTitleAttribute()
    {
        return $this->lecturer_name . ($this->lecturer_title ? ', ' . $this->lecturer_title : '');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_manager_id', 'lecturer_id');
    }
}
