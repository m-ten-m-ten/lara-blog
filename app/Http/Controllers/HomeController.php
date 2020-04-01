<?php
/**
 * Laravelブログアプリの公開ページ用コントローラー
 */

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    /**
     * ホームページ（記事一覧）を表示。
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
     * カテゴリー別記事一覧を表示。
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
     * タグ別記事一覧を表示。
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

    /**
     * ブログ記事の詳細画面を表示。
     */
    public function post(Post $post)
    {
        $data = [
            'post'       => Post::with(['tags'])->find($post->id),
            'posts'      => Post::getLatestPost(),
            'categories' => Category::withCount('posts')->get(),
            'tags'       => Tag::withCount('posts')->get(),
        ];
        return view('show', $data);
    }

    /**
     * 固定ページを表示。
     */
    public function page(Page $page)
    {
        $data = [
            'page'       => Page::find($page->id),
            'posts'      => Post::getLatestPost(),
            'categories' => Category::withCount('posts')->get(),
            'tags'       => Tag::withCount('posts')->get(),
        ];
        return view('page', $data);
    }
}
