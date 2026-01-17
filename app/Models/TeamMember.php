<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamMember extends Pivot
{
    protected $table = 'team_member';

    protected $fillable = [
        'team_id',
        'member_id',
        'role',
    ];
}
