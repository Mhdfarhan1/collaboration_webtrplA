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
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'team_members', 'member_id', 'project_id')
            ->withPivot('team_member_role')
            ->withTimestamps();
    }
}