<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $dates = [
    'post_drafted',
    'post_published',
    'post_modified',
  ];

  protected $fillable = [
    'post_title',
    'post_content',
    'post_excerpt',
    'post_status',
    'post_drafted',
    'post_published',
    'post_modified',
    'post_name',
    'category_id',
  ];

  // categorysテーブルへの参照
  public function category()
  {
    return $this->belongsTo('App\Category');
  }
  // tagsテーブルへの参照
  public function tags()
  {
    return $this->belongsToMany('App\Tag');
  }
}
