<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['image_file'];

    public static function getImageList()
    {
        return static::latest()->paginate(15);
    }
}
