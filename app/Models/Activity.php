<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'activity_id';
    public $timestamps = true;

    protected $fillable = [
        'activity_name',
        'activity_description',
        'activity_image',
    ];

    public function activityMedia()
    {
        return $this->hasMany(ActivityMedia::class, 'activity_id', 'activity_id');
    }
}
