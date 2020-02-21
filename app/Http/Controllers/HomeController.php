<?php
/**
 * Laravelブログアプリの公開ページ用コントローラー
 */

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    /**
     * ホームページ（記事一覧）へアクセスする。
     *
     * @return Resonse ホームページ（記事一覧）を表示
     */
    public function index()
    {
        $data = [
            'posts'      => Post::getPublicPostList(),
            'categories' => Category::withCount('posts')->get(),
            'tags'       => Tag::withCount('posts')->get(),
        ];
        return view('index', $data);
    }

    /**
     * 個別記事ページへアクセスする。
     *
     * @return Resonse 個別記事ページを表示
     */
    public function show(Post $post)
    {
        $data = [
            'show' => 'show',
            'post'              => Post::with(['tags'])->find($post->id),
            'posts'             => Post::getLatestPost(),
            'categories'        => Category::withCount('posts')->get(),
            'tags'              => Tag::withCount('posts')->get(),
        ];
        return view('show', $data);
    }

    /**
     * カテゴリー別記事一覧へアクセスする。
     *
     * @return Resonse カテゴリー別記事一覧を表示
     */
    public function category(Category $category)
    {
        $data = [
            'category'   => $category,
            'posts'      => Category::getPublishCategoryPostList($category->id),
            'categories' => Category::withCount('posts')->get(),
            'tags'       => Tag::withCount('posts')->get(),
        ];
        return view('index', $data);
    }

    /**
     * タグ別記事一覧へアクセスする。
     *
     * @return Resonse タグ別記事一覧を表示
     */
    public function tag(Tag $tag)
    {
        $data = [
            'tag'        => $tag,
            'posts'      => Tag::getPublishTagPostList($tag->id),
            'categories' => Category::withCount('posts')->get(),
            'tags'       => Tag::withCount('posts')->get(),
        ];
        return view('index', $data);
    }
}
