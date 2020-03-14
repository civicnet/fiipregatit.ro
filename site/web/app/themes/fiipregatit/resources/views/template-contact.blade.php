{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @include('partials.contact-section')
@endsection
