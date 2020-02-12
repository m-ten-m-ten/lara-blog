@extends('_includes._layout')

@section('content')

<section class="l-index">

  @include('_includes._breadcrumb')

  @if(isset($category) || isset($tag))
    <div class="index__title">{{ isset($category)? $category->category_title: $tag->tag_title }}の記事一覧</div>
  @endif

  @include('_includes._postList')

{{ $posts->links() }}

</section>

@endsection
