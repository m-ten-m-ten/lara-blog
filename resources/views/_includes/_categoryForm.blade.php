<ul>
  <li class="form__row">
    <label class="form__title">カテゴリー名</label>
    <input type="text" class="{{$errors->has('category_title') ? 'form__input-error' : 'form__input ' }}" name="category_title" value="{{ old('category_title', $category->category_title) }}" required maxlength="15">
    @error('category_title')
      <p class="error-text">{{ $message }}</p>
    @enderror
  </li>

  <li class="form__row">
    <label class="form__title">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
    <input type="category_name" class="{{$errors->has('category_name') ? 'form__input-error' : 'form__input ' }}" name="category_name" value="{{ old('category_name', $category->category_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
    @error('category_name')
      <p class="error-text">{{ $message }}</p>
    @enderror
  </li>
</ul>
