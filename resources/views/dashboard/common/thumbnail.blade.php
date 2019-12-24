<div class="flex flex-wrap items-start">

  <button type="button" id="modal-open" class="shadow bg-blue-700 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 mb-2 mr-4 md:mr-0 rounded">画像を選択</button>

  <div class="text-center">
    <img id="selected_thumb_img" src="" alt="" width="120px">
    <div id="selected_thumb_name" class="text-sm"></div>
  </div>

</div>

<div id="modal" class="hidden text-center px-4 py-4 fixed z-10 inset-0 h-full w-full bg-gray-700 opacity-100">

  <div class="bg-white opacity-100 h-full overflow-auto mx-auto px-4 py-2">

    <div class="flex flex-wrap justify-center">
      @foreach ($images as $id => $image)
        <input id="post_thumbnail_{{ $image->id }}" type="radio" name="post_thumbnail" value="{{ $image->id }}" class="radio hidden" @if(isset($post) && $post->post_thumbnail == $image->id) checked="checked" @endif>
        <label for="post_thumbnail_{{ $image->id }}" class="cursor-pointer p-2 border-4 border-white rounded">
          <img src="/img/{{$image->image_name}}.{{$image->image_extension}}" alt="" width="120px">
          <div class="text-sm text-center">{{ $image->image_name }}.{{$image->image_extension}}</div>
        </label>
      @endforeach
    </div>

    <div class="flex justify-center p-2 mb-2">
      {{ $images->links() }}
    </div>
    <button type="button" id="modal-close" class="shadow bg-white text-blue-700 border border-blue-700 font-bold py-2 px-4 mr-2 rounded">閉じる</button>

  </div>

</div>

