{{--
  Template Name: Despre
--}}

@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false])

  <div class="container-fluid" id="despre-content">
    <div class="dropdown show small-menu">
      <a
        class="btn btn-secondary dropdown-toggle d-lg-none"
        href="#"
        role="button"
        id="dropdownMenuLink"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        Alege Secțiune
      </a>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" role="tablist">
        <div
          class="nav flex-column nav-pills"
          id="custom-menu-tab-mobile"
          role="tablist"
          aria-orientation="vertical">
            @foreach (Despre::sections() as $section)
              @if ($section)
                @include('partials/components/about-page-mobile-menu-section',
                [ 'section' => $section ])
              @endif
            @endforeach
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row despre-row">
        <div class="col col-lg-9 col-md-12">
          <div class="tab-content" id="custom-menu-content">
            @foreach (Despre::sections() as $section)
              @if ($section)
                @include('partials/components/about-page-section', [ 'section' => $section ])
              @endif
            @endforeach
          </div>
        </div>
        <div class="col col-lg-3 col-md-12 guide-sidebar d-none d-lg-block">
          <h3>
            Află mai multe
          </h3>
          <div
            class="nav flex-column nav-pills"
            id="custom-menu-tab"
            role="tablist"
            aria-orientation="vertical">
              @foreach (Despre::sections() as $section)
                @if ($section)
                  @include('partials/components/about-page-menu-section',
                  [ 'section' => $section ])
                @endif
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('partials.app-promo')
@endsection
