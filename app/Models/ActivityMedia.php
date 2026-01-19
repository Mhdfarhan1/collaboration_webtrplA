<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityMedia extends Model
{
    protected $table = 'activity_media';
    protected $primaryKey = 'activity_media_id';
    public $timestamps = true;

    protected $fillable = [
        'activity_id',
        'activity_media_url',
        'activity_media_is_thumbnail',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'activity_id');
    }
}
