<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'profile_picture_url',
        'is_core',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->using(TeamMember::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}