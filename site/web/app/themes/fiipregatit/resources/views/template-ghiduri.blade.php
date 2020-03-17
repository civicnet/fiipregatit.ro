{{--
  Template Name: Ghiduri
--}}

@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @include('partials.guide-section', [
    'show_count' => 100,
    'show_button' => false,
    'category' => null,
  ])

  @include('partials.app-promo')
@endsection
