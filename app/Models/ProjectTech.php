<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTech extends Model
{
    protected $table = 'project_techs';
    protected $primaryKey = 'project_tech_id';
    public $timestamps = true;

    protected $fillable = [
        'project_id',
        'tech_name',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
