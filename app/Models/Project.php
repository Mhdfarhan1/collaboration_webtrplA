<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'demo_url',
        'project_manager_id',
    ];

    public function projectManager()
    {
        return $this->belongsTo(Lecturer::class, 'project_manager_id', 'lecturer_id');
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class, 'project_id', 'project_id');
    }

    public function projectTechs()
    {
        return $this->hasMany(ProjectTech::class, 'project_id', 'project_id');
    }
}
