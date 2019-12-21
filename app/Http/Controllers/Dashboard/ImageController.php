<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\image;
use App\Http\Requests\StoreImage;

class ImageController extends Controller
{
  public function index(){
    $data = [
      'images' => Image::orderBy('created_at', 'desc')->paginate(10)
    ];
    return view('dashboard.image.index', $data);
  }

  public function create(){
    return view('dashboard.image.create');
  }

  public function store( StoreImage $request ){
    if ($request->file('image_file')->isValid()) {
      $image_fullname = $request->image_name . "." . $request->file('image_file')->guessExtension();
      $request->file('image_file')->move(public_path()."/img", $image_fullname);
      $image = new Image();
      $image->image_name = $request->image_name;
      $image->save();
    }
    return redirect('dashboard/image');
  }

  public function edit( StoreImage $req )
  {
   return view('dashboard/image/edit', compact('image'));
  }

  public function update( StoreImage $req, Image $image ){
    $image->fill($req->except('_token', '_method'))->save();
    return view('dashboard/image/edit', compact('image'));
  }

  public function delete(Request $req)
  {
    if($req->checked_images) {
      Image::destroy($req->checked_id);
    } else {
      $image = Image::findOrFail($req->delete_id);
      $image->delete();
    }
    return redirect('dashboard/image');
  }
}