
@extends('layouts.app')

@section('content')
  @include('partials.jumbotron')
  @include('partials.guide-section')
  @include('partials.homepage-counter',
  ['guide_count' => 1, 'video_count' => 2, 'image_count' => 3])
  @include('partials.survival-kit')
  @include('partials.campaign-section')
@endsection
