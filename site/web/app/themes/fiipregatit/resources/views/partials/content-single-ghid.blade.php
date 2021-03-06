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

    @if ($guide['top_content'])
      <div class="row ghid-row">
        <div class="col col-lg-9 col-md-12" style="padding-bottom: 30px">
          {!! $guide['top_content'] !!}
        </div>
      </div>
    @endif

    <div class="row ghid-row">
      <div class="col col-lg-9 col-md-12">
        <div id="accordion">
          @if ($guide['before_content'])
            @include('partials/components/guide-section', [
              'id' => 'BeforeContent',
              'isOpen' => $guide['is_before_single'],
              'title' => 'Înainte de evenimentului',
              'content' => $guide['before_content']
            ])
          @endif

          @if ($guide['during_content'])
            @include('partials/components/guide-section', [
              'id' => 'DuringContent',
              'isOpen' => $guide['is_during_single'],
              'title' => 'În timpul evenimentului',
              'content' => $guide['during_content']
            ])
          @endif

          @if ($guide['after_content'])
            @include('partials/components/guide-section', [
              'id' => 'AfterContent',
              'isOpen' => $guide['is_after_single'],
              'title' => 'După eveniment',
              'content' => $guide['after_content']
            ])
          @endif

          @foreach ($guide['sections'] as $section)
            @include('partials/components/guide-section', [
              'id' => md5($section['name']),
              'isOpen' => count($guide['sections']) === 1,
              'title' => $section['name'],
              'content' => $section['content'],
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

          @if ($guide['bottom_content'])
            <div class="row ghid-row">
              <div
                class="col col-lg-9 col-md-12"
                style="padding-top: 30px; padding-bottom: 12px">
                {!! $guide['bottom_content'] !!}
              </div>
            </div>
          @endif

          @if ($guide['is_licensed'])
            <div class="licensed-guide">
              <a
                rel="license"
                href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
                  <img alt="Licenţa Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" />
              </a>
              <p>
                Această operă este pusă la dispoziţie sub
                <a
                  rel="license"
                  href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
                    Licenţa Creative Commons Atribuire-Necomercial-Distribuire în Condiţii Identice 4.0 Internațional
                </a>.
              </p>
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
  'title' => 'Ghiduri COVID-19',
  'bg' => '#fff',
  'category' => 'covid-19',
])

@include('partials.guide-section', [
  'show_count' => 4,
  'show_button' => false,
  'title' => 'Alte Situații',
  'category' => null,
  'bg' => '#e4e4e4'
])
