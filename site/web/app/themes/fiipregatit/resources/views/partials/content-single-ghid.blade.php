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
                    În timpul evenimentului
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
            @include('partials/components/guide-section', [
              'id' => 'AfterContent',
              'isCollapsed' => $guide['is_after_single'],
              'title' => 'După eveniment',
              'content' => $guide['after_content']
              // 'bg' => '#fff'
            ])
          @endif

          @foreach ($guide['sections'] as $section)
            @include('partials/components/guide-section', [
              'id' => md5($section['name']),
              'isCollapsed' => true,
              'title' => $section['name'],
              'content' => $section['content'],
              // 'bg' => '#fff'
            ])
          @endforeach

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

                  <div
                    id="carouselControls"
                    class="carousel slide"
                    data-ride="carousel"
                    data-interval="false">

                    @if ($guide['photo_gallery_is_single'])
                      <ol class="carousel-indicators">
                        @foreach ($guide['photo_gallery'] as $idx => $photo)
                          <li
                            data-target="#carouselIndicators"
                            data-slide-to="{{ $idx }}"
                            class="@if ($loop->first) active @endif">
                          </li>
                        @endforeach
                      </ol>
                    @endif

                    <div class="carousel-inner">
                      @foreach ($guide['photo_gallery'] as $attachment)
                        <div
                          class="carousel-item @if ($loop->first) active @endif"
                          style="background-image: url({{ $attachment }})">
                          <a
                            href="{{ $attachment }}"
                            data-toggle="lightbox"
                            data-title="Ghid {{ $guide['title'] }}"
                            data-gallery="guide-gallery"
                            class="lightbox">
                          </a>
                        </div>
                      @endforeach
                    </div>

                    @if (!$guide['photo_gallery_is_single'])
                      <a
                        class="carousel-control-prev"
                        href="#carouselControls"
                        role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Înapoi</span>
                      </a>
                      <a
                        class="carousel-control-next"
                        href="#carouselControls"
                        role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Înainte</span>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif

          @if ($guide['pdf_guide'])
            <div class="download-guide">
              <a href="{{ $guide['pdf_guide']['url'] }}" target="_blank">
                <i class="far fa-file-pdf pdf-icon"></i>
                <strong>Descarcă ghidul</strong>
                @if ($guide['pdf_size'])
                  (PDF, {{ $guide['pdf_size'] }})
                @endif
              </a>
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
  'title' => 'COVID-19',
  'bg' => '#fff',
  'category' => 'covid-19',
])

@include('partials.guide-section', [
  'show_count' => 4,
  'show_button' => false,
  'title' => 'Alte Situații',
  'bg' => '#e4e4e4',
  'category' => null,
])
