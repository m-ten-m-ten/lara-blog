@extends('_includes._layout')
@section('jsAction', 'page')
@section('content')

<div class="l-show">

  <div class="l-show__main">

    <div class="page">

      <h1 class="page__title">{{ $page->page_title }}</h1>

      <hr class="overPC">

      <div class="toc accordion-wrapper">
        <div class="toc__title accordion-trigger is-open">Table of Contents</div>
        <div class="toc__body accordion-body"></div>
      </div>

      <div class="page__body">
        {!! $page->page_content !!}
      </div>

    </div>

  </div>

  {{-- サイドバー --}}
  @include('_includes._sidebar')

</div>

@endsection