<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamMember extends Pivot
{
    protected $table = 'team_members';
    protected $primaryKey = 'team_member_id';
    public $timestamps = true;

    protected $fillable = [
        'team_member_id',
        'member_id',
        'project_id',
        'team_member_role',
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