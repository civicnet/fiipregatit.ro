<div class="container-fluid" id="guide-content">
  <div class="dropdown show small-menu">
    <a
      class="btn btn-secondary dropdown-toggle d-lg-none"
      href="#"
      role="button"
      id="dropdownMenuLink"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false">
      Vezi Alte Ghiduri
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      @foreach ($guide['sidebar_links'] as $link)
        <a class="dropdown-item" href="{{ $link['href'] }}">{{ $link['text'] }}</a>
      @endforeach
    </div>
  </div>
  <div class="container">
    <h2>Ghid {{ $guide['title'] }}</h2>
    <div class="row ghid-row">
      <div class="col col-lg-9 col-md-12">
        <div id="accordion">
          @if ($guide['before_content'])
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link @if (!$guide['is_before_single']) collapsed @endif"
                    data-toggle="collapse"
                    data-target="#collapseOne"
                    aria-expanded="@if ($guide['is_before_single']) true @else false @endif"
                    aria-controls="collapseOne">
                    Înainte de eveniment
                    <i class="fa fa-chevron-down pull-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapseOne"
                class="collapse @if ($guide['is_before_single']) show @endif">
                <div class="card-body">
                  {!! $guide['before_content'] !!}
                </div>
              </div>
            </div>
          @endif

          @if ($guide['during_content'])
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link @if (!$guide['is_during_single']) collapsed @endif"
                    data-toggle="collapse"
                    data-target="#collapseTwo"
                    aria-expanded="@if ($guide['is_during_single']) true @else false @endif"
                    aria-controls="collapseTwo">
                    Înainte de eveniment
                    <i class="fa fa-chevron-down pull-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapseTwo"
                class="collapse @if ($guide['is_during_single']) show @endif">
                <div class="card-body">
                  {!! $guide['during_content'] !!}
                </div>
              </div>
            </div>
          @endif


          @if ($guide['after_content'])
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link @if (!$guide['is_after_single']) collapsed @endif"
                    data-toggle="collapse"
                    data-target="#collapseThree"
                    aria-expanded="@if ($guide['is_after_single']) true @else false @endif"
                    aria-controls="collapseThree">
                    Înainte de eveniment
                    <i class="fa fa-chevron-down pull-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapseThree"
                class="collapse @if ($guide['is_after_single']) show @endif">
                <div class="card-body">
                  {!! $guide['after_content'] !!}
                </div>
              </div>
            </div>
          @endif

          @if ($guide['has_extra_info'])
            <div class="card">
              <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link collapsed"
                    data-toggle="collapse"
                    data-target="#collapseFour"
                    aria-expanded="false"
                    aria-controls="collapseFour">
                    Info ajutător (foto / video)
                    <i class="fa fa-chevron-down pull-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapseFour"
                class="collapse">
                <div class="card-body">
                  {!! $guide['extra_info'] !!}

                  @if ($guide['video'])
                  <div class="extra-video">
                    {!! $guide['video'] !!}
                  </div>
                  @endif

                </div>
              </div>
            </div>
          @endif

        </div>
      </div>
      <div class="col col-lg-3 col-md-12 guide-sidebar d-none d-lg-block">
        <h3>Alte Ghiduri</h3>
        <ul>
          @foreach ($guide['sidebar_links'] as $link)
            <li>
              <a href="{{ $link['href'] }}">
                <i class="fas fa-chevron-right"></i>
                {{ $link['text'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

@include('partials.guide-section', [
  'show_count' => 4,
  'show_button' => false,
  'title' => 'Alte Situații',
  'bg' => '#fff'
])
