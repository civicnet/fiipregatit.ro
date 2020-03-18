@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-single-'.get_post_type(), ['campaign' => Campanie::get()])
  @endwhile
@endsection
