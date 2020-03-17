
@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => true])

  @include('partials.guide-section', [
    'show_count' => 4,
    'show_button' => true,
    'title' => 'COVID-19',
    'category' => 'covid-19',
  ])

  @include('partials.guide-section', [
    'show_count' => 8,
    'show_button' => true,
    'category' => null,
  ])

  @include('partials.homepage-counter', FrontPage::counters())

  @include('partials.survival-kit')

  @include('partials.campaign-section', [
    'show_count' => 3,
    'show_button' => true,
  ])

  @include('partials.app-promo')
@endsection
