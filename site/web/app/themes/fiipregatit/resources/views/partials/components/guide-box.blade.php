<div class="ghid-box col-lg-3 col-sm-6 col-xs-12">
  <a class="ghid-content" href={{ $guide['permalink'] }}>

    @if ($guide['count_videos'])
      <div class="guide-count count-videos">
        <i class="fab fa-youtube"></i> {{ $guide['count_videos'] }} video
      </div>
    @endif

    @if ($guide['count_photos'])
      <div class="guide-count count-foto">
        <i class="far fa-image"></i> {{ $guide['count_photo'] }} foto
      </div>
    @endif

    <div
      class="guide-icon"
      @if (!$guide['is_svg'])
        style="background-image: url({{ $guide['icon']['sizes']['thumbnail'] }})"
      @endif>
      @if ($guide['is_svg'])
        <object id="{{ $guide['id'] }}" type="image/svg+xml" data="{{ $guide['icon']['sizes']['thumbnail'] }}">
        </object>
      @endif
    </div>
    <h3>
      {{ $guide['title'] }}
    </h3>
    <span class="outline-button ghid-btn">
      Vezi Ghid
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </span>
  </a>
</div>
