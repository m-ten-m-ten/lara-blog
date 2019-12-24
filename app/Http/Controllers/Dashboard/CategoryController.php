<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category;
use App\Http\Requests\StoreCategory;

class CategoryController extends Controller
{
  public function index(){
    $data = [
      'categories' => Category::orderBy('created_at', 'desc')->paginate(10)
    ];
    return view('dashboard.category.index', $data);
  }

  public function create(){
    return view('dashboard.category.create');
  }

  public function store( StoreCategory $request ){
    $category = new Category();
    $category->fill($request->except('_token'))->save();
    return redirect('dashboard/category/create')->with('status', __('カテゴリーの登録が完了しました。'));
  }

  public function edit( Category $category )
  {
   return view('dashboard.category.edit', compact('category'));
  }

  public function update( StoreCategory $request, Category $category ){
    $category->fill($request->except('_token', '_method'))->save();
    return redirect('dashboard/category/')->with('status', __('ファイル名の変更が完了しました。'));
  }

  public function delete(Request $request)
  {
    if($request->checked_categories) {
      foreach ($request->checked_id as $id) {
        $category = Category::findOrFail($id);
        $category->delete();
      }
    } else {
      $category = Category::findOrFail($request->delete_id);
      $category->delete();
    }
    return redirect('dashboard/category');
  }
}
