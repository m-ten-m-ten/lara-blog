<?php

/**
 * 固定ページ管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\{Category, Image, Page, Post, Tag};
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * 管理用固定ページ一覧画面を表示。
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);

        return view('admin.page.index', \compact('pages'));
    }

    /**
     * 新規固定ページ入力画面を表示。
     */
    public function create(Page $page)
    {
        return view('admin.page.create', \compact('page'));
    }

    /**
     * 新規固定ページの登録処理。
     *
     * @return Response 固定ページ編集画面へリダイレクト
     */
    public function store(PageStoreRequest $request, Page $page)
    {
        $page->fill($request->validated())->save();

        return redirect(route('admin.page.edit', $page))->with('status', '登録が完了しました。');
    }

    /**
     * 固定ページの編集画面を表示。
     */
    public function edit(Page $page)
    {
        return view('admin.page.create', \compact('page'));
    }

    /**
     * 固定ページの更新処理。
     *
     * @return 投稿編集画面へリダイレクト
     */
    public function update(PageStoreRequest $request, Page $page)
    {
        $page->fill($request->validated())->save();

        return redirect(route('admin.page.edit', $page))->with('status', '変更が完了しました。');
    }

    /**
     * 固定ページの削除処理
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response 管理用記事一覧ページへリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            foreach ($request->checkedIds as $deleteId) {
                $this->deletePage($deleteId);
            }
        } elseif ($request->deleteId) {
            $this->deletePage($request->deleteId);
        }
        return redirect(route('admin.page.index'))->with('status', '削除が完了しました。');
    }

    /**
     * 固定ページの削除処理
     *
     * @param int $deleteId 固定ページのid
     */
    public function deletePage($deleteId): void
    {
        $page = Page::findOrFail($deleteId);
        $page->delete();
    }

    /**
     * 記事作成のTinyMce（WYSIWYGエディタ）用の画像JSONデータ出力処理
     *
     * @return JSON
     */
    public function readImage()
    {
        $images = Image::latest()->get();

        $imageJSON = $images->map(function ($image) {
            return ['title' => $image->file_name, 'value' => $image->path];
        });

        return $imageJSON;
    }
}
