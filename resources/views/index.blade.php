@extends('layouts.base')
@section('content')
フロント
<div class="flex justify-center pt-2 pb-10">
  {{ $posts->links() }}
</div>
@endsection
