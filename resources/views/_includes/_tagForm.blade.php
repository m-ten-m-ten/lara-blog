<ul>
  <li class="form__row">
    <label class="form__title">タグ名</label>
    <input type="text" class="{{$errors->has('tag_title') ? 'form__input-error' : 'form__input ' }}" name="tag_title" value="{{ old('tag_title', $tag->tag_title) }}" required maxlength="15">
    @error('tag_title')
      <p class="error-text">{{ $message }}</p>
    @enderror
  </li>

  <li class="form__row">
    <label class="form__title">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
    <input type="tag_name" class="{{$errors->has('tag_name') ? 'form__input-error' : 'form__input ' }}" name="tag_name" value="{{ old('tag_name', $tag->tag_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
    @error('tag_name')
      <p class="error-text">{{ $message }}</p>
    @enderror
  </li>
</ul>
