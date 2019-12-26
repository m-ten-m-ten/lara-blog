<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
    'tag_title',
    'tag_name',
  ];

  // postsテーブルへの参照
  public function posts()
  {
    return $this->belongsToMany('App\Post');
  }
}
