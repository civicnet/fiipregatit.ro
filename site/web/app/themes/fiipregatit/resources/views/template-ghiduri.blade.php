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
    'title' => 'COVID-19',
    'category' => 'covid-19',
    'bg' => '#fff',
  ])

  @include('partials.guide-section', [
    'show_count' => 100,
    'show_button' => false,
    'category' => null,
    'bg' => '#e4e4e4',
  ])

  @include('partials.app-promo')
@endsection
