@extends('_includes._layout')
@section('jsAction', 'page')
@section('content')

<div class="l-show">

  <div class="l-show__main">

    <div class="page">

      <h1 class="page__title">{{ $page->page_title }}</h1>

      <hr class="overPC">

      @include('_includes._toc')

      <div class="page__body">
        {!! $page->page_content !!}
      </div>

    </div>

  </div>

  {{-- サイドバー --}}
  @include('_includes._sidebar')

</div>

@endsection