<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'post_id',
        'image_name',
        'image_extension',
    ];

    public static function getImageList()
    {
        return static::latest()->paginate(15);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($image) {
            \File::delete(public_path() . '/img/' . $image->image_name . '.' . $image->image_extension);
        });
    }
}
