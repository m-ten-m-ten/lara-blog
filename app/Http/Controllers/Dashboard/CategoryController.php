<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
  public function index()
  {
    $data = [
      'categories' => Category::latest()->paginate(10)
    ];
    return view('dashboard.category.index', $data);
  }

  public function create()
  {
    return view('dashboard.category.create');
  }

  public function store( CategoryStoreRequest $request )
  {
    $category = new Category();
    $category->fill($request->except('_token'))->save();
    return redirect('dashboard/category/'. $category->id . '/edit')->with('status', __('カテゴリーの登録が完了しました。'));
  }

  public function edit( Category $category )
  {
   return view('dashboard.category.edit', compact('category'));
  }

  public function update( CategoryStoreRequest $request, Category $category )
  {
    $category->fill($request->except('_token', '_method'))->save();
    return redirect('dashboard/category/'. $category->id . '/edit')->with('status', __('カテゴリーの更新が完了しました。'));
  }

  public function delete(Request $request)
  {
    if($request->checked_categories) {
      foreach ($request->checkedIds as $id) {
        $category = Category::findOrFail($id);
        $category->delete();
      }
    } else {
      $category = Category::findOrFail($request->deleteId);
      $category->delete();
    }
    return redirect('dashboard/category');
  }
}
