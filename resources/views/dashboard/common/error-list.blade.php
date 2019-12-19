@if (count($errors) > 0)
  <div class="bg-red-100 py-2 px-4">
    <ul class="list-disc list-inside">
      @foreach ($errors->all() as $err)
        <li class="text-red-500">{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif