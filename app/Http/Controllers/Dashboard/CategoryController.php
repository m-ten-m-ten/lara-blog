<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::latest()->paginate(10),
        ];
        return view('dashboard.category.index', $data);
    }

    public function create(Category $category)
    {
        return view('dashboard.category.create', \compact('category'));
    }

    public function store(CategoryStoreRequest $request, Category $category)
    {
        $category->fill($request->validated())->save();
        return redirect(route('category.edit', $category))->with('status', __('登録が完了しました。'));
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.create', \compact('category'));
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->fill($request->validated())->save();
        return redirect(route('category.edit', $category))->with('status', __('変更が完了しました。'));
    }

    public function delete(Request $request)
    {
        if ($request->checked_categories) {
            foreach ($request->checkedIds as $id) {
                $category = Category::findOrFail($id);
                $category->delete();
            }
        } else {
            $category = Category::findOrFail($request->deleteId);
            $category->delete();
        }
        return redirect(route('category.index'));
    }
}
