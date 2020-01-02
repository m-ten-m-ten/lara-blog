<label for="password" class="block font-bold py-2">{{ __('Password') }}</label>

<input id="password" type="password" class="{{$errors->has('password') ? 'border-red-500' : 'border-gray-200' }} bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 focus:outline-none focus:bg-white focus:border-blue-700" name="password" value="{{ $password ?? old('password') }}" required autocomplete="{{ isset($token)? 'new': 'current' }}-password">

@error('password')
  <span class="text-red-500" role="alert">{{ $message }}</span>
@enderror

