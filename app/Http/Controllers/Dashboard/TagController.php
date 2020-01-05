<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data = [
            'tags' => Tag::latest()->paginate(10),
        ];
        return view('dashboard.tag.index', $data);
    }

    public function create(Tag $tag)
    {
        return view('dashboard.tag.create', \compact('tag'));
    }

    public function store(TagStoreRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return redirect(route('tag.edit', $tag))->with('status', __('登録が完了しました。'));
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tag.create', \compact('tag'));
    }

    public function update(TagStoreRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return redirect(route('tag.edit', $tag))->with('status', __('変更が完了しました。'));
    }

    public function delete(Request $request)
    {
        if ($request->checked_tags) {
            foreach ($request->checkedIds as $id) {
                $tag = Tag::findOrFail($id);
                $tag->delete();
            }
        } else {
            $tag = Tag::findOrFail($request->deleteId);
            $tag->delete();
        }
        return redirect(route('tag.index'));
    }
}
