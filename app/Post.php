<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $dates = [
    'post_drafted',
    'post_published',
    'post_modified'
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
  ];

  public static $rules = [
    'post_title' => 'required'
  ];
}
