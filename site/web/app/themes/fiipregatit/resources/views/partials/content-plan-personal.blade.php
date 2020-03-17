<div class="container-fluid" id="plan-personal-content">
  <div class="container">
    <h2>{{ get_the_title() }} </h2>
    <div class="row plan-personal-row">
      <div class="plan-personal-image-container col-md-6 col-sm-12 d-none d-md-block">
        <img src="@asset('images/fiipregatit_planpersonal_colaj_v1.png')" class="plan-personal-image" />
      </div>
      <div class="col col-md-6 col-sm-12">
        <p>
          {!! $plan['kit_description'] !!}
        </p>
        <div id="accordion">
          @foreach ($plan['items'] as $item)
            <div class="card">
              <div class="card-header" id="heading{{ $item['index'] }}">
                <h5 class="mb-0">
                  <button
                    class="btn btn-link @if ($item['collapsed']) collapsed @endif"
                    data-toggle="collapse"
                    data-target="#collapse{{ $item['index'] }}"
                    aria-expanded="true"
                    aria-controls="collapse{{ $item['index'] }}">
                    {{ $item['title'] }}
                    <i class="fa fa-chevron-down pull-right"></i>
                  </button>
                </h5>
              </div>
              <div
                id="collapse{{ $item['index'] }}"
                class="collapse @if (!$item['collapsed']) show @endif"
                aria-labelledby="heading{{ $item['index'] }}"
                data-parent="#accordion">
                <div class="card-body">
                  {!! $item['content'] !!}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row plan-personal-row">
      <div class="col col-md-6 col-sm-12">
        <p>
          {!! $plan['table_description'] !!}
        </p>

        @if ($plan['pdf_table'])
          <div class="download-tabel">
            <a href="{{ $plan['pdf_table'] }}" target="_blank">
              <i class="far fa-file-pdf pdf-icon"></i>
              <strong>Planul familiei în caz de urgență</strong>
              @if ($plan['pdf_size'])
                (PDF, {{ $plan['pdf_size'] }})
              @endif
            </a>
          </div>
        @endif
      </div>
      <div class="plan-personal-image-container col-md-6 col-sm-12 d-none d-md-block">
        <img src="@asset('images/fiipregatit_tabel_trusasupravietuire.jpg')" class="plan-personal-image" alt="Planul familiei în caz de urgență"/>
      </div>
    </div>
  </div>
</div>
