<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassLogo extends Model
{
    protected $table = 'class_logos';

    protected $fillable = [
        'logo_url',
    ];
}
