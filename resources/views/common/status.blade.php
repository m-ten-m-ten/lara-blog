@if (session('status'))
  <div class="bg-blue-100 text-blue-900 px-4 py-2">
    {{ session('status') }}
  </div>
@endif