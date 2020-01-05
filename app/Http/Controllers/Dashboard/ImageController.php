<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\image;
use App\Http\Requests\ImageStoreRequest;

class ImageController extends Controller
{
  public function index(){
    $data = [
      'images' => Image::latest()->paginate(10)
    ];
    return view('dashboard.image.index', $data);
  }

  public function create(Image $image){
    return view('dashboard.image.create', compact('image'));
  }

  public function store( ImageStoreRequest $request, Image $image ){
    if ($request->file('image_file')->isValid()) {
      $image_name = $request->image_name;
      $image_extension = $request->file('image_file')->guessExtension();
      $request->file('image_file')->move(public_path()."/img", $image_name.".".$image_extension);
      $image->image_name = $image_name;
      $image->image_extension = $image_extension;
      $image->save();
    }
    return redirect(route('image.edit', $image))->with('status', __('画像の登録が完了しました。'));
  }

  public function edit( Image $image )
  {
   return view('dashboard.image.create', compact('image'));
  }

  public function update( ImageStoreRequest $request, Image $image ){
    rename(public_path() . "/img/" . $image->image_name . "." . $image->image_extension, public_path() . "/img/" . $request->image_name . "." . $image->image_extension);
    $image->image_name = $request->image_name;
    $image->save();
    return redirect(route('image.edit', $image))->with('status', __('変更が完了しました。'));
  }

  public function delete(Request $request)
  {
    if ( $request->checked_images ) {
      foreach ($request->checkedIds as $id) {
        $image = Image::findOrFail($id);
        \File::delete(public_path()."/img/".$image->image_name.".".$image->image_extension);
        $image->delete();
      }
    } else {
      $image = Image::findOrFail($request->deleteId);
      \File::delete(public_path()."/img/".$image->image_name.".".$image->image_extension);
      $image->delete();
    }
    return redirect(route('image.index'));
  }
}