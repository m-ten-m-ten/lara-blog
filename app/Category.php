<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_title',
        'category_name',
    ];

    // postsテーブルへの参照
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
