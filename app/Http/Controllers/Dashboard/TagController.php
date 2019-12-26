<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\tag;
use App\Http\Requests\StoreTag;

class TagController extends Controller
{
    public function index(){
    $data = [
      'tags' => Tag::orderBy('created_at', 'desc')->paginate(10)
    ];
    return view('dashboard.tag.index', $data);
  }

  public function create(){
    return view('dashboard.tag.create');
  }

  public function store( StoreTag $request ){
    $tag = new Tag();
    $tag->fill($request->except('_token'))->save();
    return redirect('dashboard/tag/create')->with('status', __('タグの登録が完了しました。'));
  }

  public function edit( Tag $tag )
  {
   return view('dashboard.tag.edit', compact('tag'));
  }

  public function update( StoreTag $request, Tag $tag ){
    $tag->fill($request->except('_token', '_method'))->save();
    return redirect('dashboard/tag/')->with('status', __('ファイル名の変更が完了しました。'));
  }

  public function delete(Request $request)
  {
    if($request->checked_tags) {
      foreach ($request->checked_id as $id) {
        $tag = Tag::findOrFail($id);
        $tag->delete();
      }
    } else {
      $tag = Tag::findOrFail($request->delete_id);
      $tag->delete();
    }
    return redirect('dashboard/tag');
  }
}
