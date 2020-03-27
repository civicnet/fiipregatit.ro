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
      @foreach ($section['sidebar_links'] as $link)
        <a class="dropdown-item" href="{{ $link['href'] }}">{{ $link['text'] }}</a>
      @endforeach
    </div>
  </div>
  <div class="container">
    <div class="section-header">
      <a
        href="{{ $section['guide']['permalink'] }}"
        class="outline-button guide-section-button">
        &laquo; Vezi "{{ $section['title'] }}"
      </a>
    </div>
    <div class="row ghid-row">
      <div class="col col-lg-9 col-md-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button
                  class="btn btn-link"
                  data-toggle="collapse"
                  data-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne">
                  {{ $section['subtitle'] }}
                  <i class="fa fa-chevron-down pull-right"></i>
                </button>
              </h5>
            </div>
            <div
              id="collapseOne"
              class="collapse show">
              <div class="card-body">
                {!! $section['content'] !!}
              </div>
            </div>
          </div>

          @if ($section['guide']['is_licensed'])
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

          <a
            style="margin-top: 16px"
            href="{{ $section['guide']['permalink'] }}"
            class="outline-button guide-section-button">
            &laquo; Vezi "{{ $section['title'] }}"
          </a>

          @if ($section['guide']['pdf_guide'])
            <div class="download-guide">
              <a href="{{ $section['guide']['pdf_guide']['url'] }}" target="_blank">
                <i class="far fa-file-pdf pdf-icon"></i>
                <strong>Descarcă ghidul</strong>
                @if ($section['guide']['pdf_size'])
                  (PDF, {{ $section['guide']['pdf_size'] }})
                @endif
              </a>
            </div>
          @endif

        </div>
      </div>
      <div class="col col-lg-3 col-md-12 guide-sidebar d-none d-lg-block">
        <h3>Alte Ghiduri</h3>
        <ul>
          @foreach ($section['guide']['sidebar_links'] as $link)
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
