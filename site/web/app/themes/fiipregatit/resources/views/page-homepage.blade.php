
@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => true])

  @include('partials.guide-section', [
    'show_count' => 8,
    'show_button' => false,
    'title' => 'Ghiduri COVID-19',
    'category' => 'covid-19',
    'bg' => '#fff'
  ])

  @include('partials.guide-section', [
    'show_count' => 8,
    'show_button' => true,
    'category' => null,
    'bg' => '#e4e4e4'
  ])

  @include('partials.survival-kit')

  @include('partials.campaign-section', [
    'show_count' => 3,
    'show_button' => true,
  ])

  @include('partials.app-promo')
@endsection
