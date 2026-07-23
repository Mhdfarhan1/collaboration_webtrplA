<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $primaryKey = 'album_id';
    
    protected $fillable = [
        'album_name',
        'album_description',
        'album_cover'
    ];

    public function images()
    {
        return $this->hasMany(AlbumImage::class, 'album_id', 'album_id');
    }
}
