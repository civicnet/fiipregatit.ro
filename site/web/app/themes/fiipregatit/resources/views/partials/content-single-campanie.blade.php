<div class="container-fluid" id="campaign-content">
  <div class="container">
    <h2>{{ $campaign['title'] }}</h2>
    <div class="row campaign-row justify-content-center">
      <div class="campaign-image-container col-lg-6 col-md-8 col-sm-12">
        <img src="{{ $campaign['image']['sizes']['large'] }}" class="campaign-image" alt="{{ $campaign['title'] }}" />
      </div>
    </div>
    <div class="row campaign-row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        {!! $campaign['content'] !!}
        @if ($campaign['attachments'] || $campaign['videos'])
          <p>
            <a
              class="btn campaign-info"
              data-toggle="collapse"
              href="#collapseCampaignInfo"
              role="button"
              aria-expanded="true"
              aria-controls="collapseCampaignInfo">
              Vezi materiale de informare
              <i class="fa fa-chevron-down pull-right"></i>
            </a>
          </p>
          <div class="collapse show" id="collapseCampaignInfo">
            <div class="card card-body">
              <ul>
                @foreach ($campaign['attachments'] as $attachment)
                  <li>
                    <i class="fas {{ $attachment['icon_class'] }}"></i>
                    <a
                      target="_blank"
                      href="{{ $attachment['url'] }}"
                      @if ($attachment['has_lightbox'])
                        data-toggle="lightbox"
                        data-title="{{ $attachment['name'] }}"
                      @endif>
                      {{ $attachment['name'] }}
                    </a>
                  </li>
                @endforeach
               @foreach ($campaign['videos'] as $video)
                  <li>
                    <i class="fab fa-youtube"></i>
                    <a
                      target="_blank"
                      href="{{ $video['url'] }}"
                      data-toggle="lightbox"
                      data-title="{{ $video['title'] }}">
                      {{ $video['title'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@include('partials.guide-section', [
  'show_count' => 4,
  'show_button' => false,
  'title' => 'COVID-19',
  'bg' => '#e4e4e4',
  'category' => 'covid-19',
])

@include('partials.guide-section', [
  'show_count' => 4,
  'show_button' => false,
  'title' => 'Alte Situații',
  'bg' => '#fff',
  'category' => null,
])
