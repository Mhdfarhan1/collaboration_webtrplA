<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectMember extends Pivot
{
    protected $table = 'project_members';
    protected $primaryKey = 'project_member_id';
    public $timestamps = true;

    protected $fillable = [
        'project_member_id',
        'member_id',
        'project_id',
        'project_member_role',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}