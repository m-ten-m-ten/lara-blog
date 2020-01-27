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

    /**
     * 管理用記事登録・更新ページ用タグ一覧データ取得
     *
     * @return object
     */
    public static function getTagList()
    {
        return static::latest()->pluck('tag_title', 'id');
    }

    /**
     * 公開用タグ別記事一覧データ取得
     *
     * @return object
     */
    public static function getPublishTagPostList(Int $id)
    {
        return static::find($id)->posts()->where('post_status', 'published')->latest()->paginate(10);
    }
}
