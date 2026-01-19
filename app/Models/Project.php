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
    ];

    public function teamMember()
    {
        return $this->hasMany(TeamMember::class, 'project_id', 'project_id');
    }

    public function projectTechs()
    {
        return $this->hasMany(ProjectTech::class, 'project_id', 'project_id');
    }
}
