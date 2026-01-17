<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'team_id',
        'title',
        'description',
        'image_url',
        'demo_url',
        'tech_stack',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
