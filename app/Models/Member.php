<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $timestamps = true;

    protected $fillable = [
        'member_name',
        'member_image',
        'member_nim',
        'member_is_core',
        'instagram_url',
        'linkedin_url',
        'github_url',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'member_id', 'project_id')
            ->withPivot('project_member_role')
            ->withTimestamps();
    }
}