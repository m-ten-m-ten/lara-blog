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
        'for_subscriber',
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

    // モデルのルートキーの取得
    public function getRouteKeyName()
    {
        return 'post_name';
    }

    // categorysテーブルへの参照
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // tagsテーブルへの参照
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 管理用記事一覧データ取得
     *
     * @return object
     */
    public static function getPostList()
    {
        return static::with('tags')->latest()->paginate(10);
    }

    /**
     * 公開用記事一覧表示用データ取得
     *
     * @return object
     */
    public static function getPublicPostList()
    {
        return static::where('post_status', 'published')->latest()->paginate(10);
    }

    /**
     * 公開用最新記事一覧表示用データ取得
     *
     * @return object
     */
    public static function getLatestPost()
    {
        return static::where('post_status', 'published')->latest()->paginate(6);
    }
}
