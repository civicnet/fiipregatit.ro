{{--
  Template Name: Plan Personal
--}}

@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  @include('partials.content-plan-personal',
  ['plan' => PlanPersonal::sections()])

  @include('partials.campaign-section')
  @include('partials.app-promo')
@endsection
