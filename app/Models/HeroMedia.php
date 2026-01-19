<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroMedia extends Model
{
    protected $table = 'hero_media';
    protected $primaryKey = 'hero_media_id';
    public $timestamps = true;

    protected $fillable = [
        'hero_title',
        'image_url',
    ];
}
