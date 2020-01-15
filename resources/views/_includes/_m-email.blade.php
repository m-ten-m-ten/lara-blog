<label for="email">e-mail</label>
<input id="email" type="email" class="text-form {{$errors->has('email') ? 'border-red-500' : 'border-gray-200' }}" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
@error('email')
  <span class="text-red-500" role="alert">{{ $message }}</span>
@enderror
