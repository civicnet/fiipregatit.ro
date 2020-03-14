<div class="container-fluid" id="campaign-section">
  <div class="container">
    <h2>Campanii</h2>
    <div class="row">
      @foreach (Campanii::get($show_count) as $campaign)
        @if ($campaign)
          @include('partials/components/campaign-box', [ 'campaign' => $campaign ])
        @endif
      @endforeach
    </div>
    @if ($show_button)
      <div class="text-center campaign-content">
        <a href="/campanii" rel="button" class="btn btn-secondary all-button">
          Vezi toate campaniile
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </div>
    @endif
  </div>
</div>
