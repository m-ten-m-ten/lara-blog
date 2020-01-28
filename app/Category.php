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
        return $this->hasMany(Post::class);
    }

    // 管理用カテゴリー一覧を取得（プルダウン用）
    public static function getCategoryList()
    {
        return static::latest()->pluck('category_title', 'id');
    }

    // 公開用カテゴリー別記事一覧を取得
    public static function getPublishCategoryPostList(Int $id)
    {
        return static::find($id)->posts()->where('post_status', 'published')->latest()->paginate(10);
    }
}
