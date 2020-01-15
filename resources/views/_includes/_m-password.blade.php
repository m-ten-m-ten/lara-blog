<label for="password">パスワード</label>

<input id="password" type="password" class="text-form {{$errors->has('password') ? 'border-red-500' : 'border-gray-200' }}" name="password" required autocomplete="{{ isset($token)? 'new': 'current' }}-password" minlength="8" maxlength="30">

@error('password')
  <span class="text-red-500" role="alert">{{ $message }}</span>
@enderror

