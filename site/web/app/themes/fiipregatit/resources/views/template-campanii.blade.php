{{--
  Template Name: Campanii
--}}

@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @include('partials.campaign-section', [
    'show_count' => 100,
    'show_button' => false,
  ])

  @include('partials.app-promo')
@endsection
