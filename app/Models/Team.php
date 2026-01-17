<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'description',
        'thumbnail_url',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)
            ->using(TeamMember::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}
