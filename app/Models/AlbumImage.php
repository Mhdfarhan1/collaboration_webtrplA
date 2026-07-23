<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    protected $table = 'album_images';
    protected $primaryKey = 'album_image_id';

    protected $fillable = [
        'album_id',
        'image_url'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }
}
