<label for="email" class="block font-bold py-2">{{ __('E-Mail Address') }}</label>
<input id="email" type="email" class="{{$errors->has('email') ? 'border-red-500' : 'border-gray-200' }} bg-gray-200 appearance-none border-2 rounded w-full py-2 px-4 focus:outline-none focus:bg-white focus:border-blue-700" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
  @error('email')
  <span class="text-red-500" role="alert">{{ $message }}</span>
@enderror
