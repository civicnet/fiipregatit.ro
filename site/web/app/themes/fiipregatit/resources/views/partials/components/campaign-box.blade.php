<div
  class="campaign-box col-lg-4 col-md-6 col-sm-12 col-xs-12">
  <div class="campaign-content">
    <h3>
      <a href="{{ $campaign['permalink'] }}" class="title">
        {{ $campaign['title'] }}
      </a>
    </h3>
    <a
      href="{{ $campaign['permalink'] }}"
      class="d-block mx-auto mt-3 mb-3 border campaign-photo"
      style="background-image: url({{ $campaign['image']['sizes']['large'] }})">
    </a>
    <div class="campaign-extras">
      {{ $campaign['extras'] }}
    </div>
    <a
      href="{{ $campaign['permalink'] }}"
      role="button"
      class="outline-button btn btn-outline-secondary rounded-0 campaign-button">
      Citește
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </a>
  </div>
</div>
