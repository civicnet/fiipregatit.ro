@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @include('partials.404-section')

@endsection
