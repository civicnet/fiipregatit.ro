<div
  class="container-fluid"
  id="ghiduri-section">
  <div class="container">
    <h2>
        Ghiduri
    </h2>
    <div class="row ghid-row justify-content-center">
      @foreach (FrontPage::guides() as $guide)
        @if ($guide)
          @include('partials/components/guide-box', [ 'guide' => $guide ])
        @endif
      @endforeach
    </div>
        <div class="text-center">
          <a href="/ghiduri" rel="button" class="btn btn-secondary all-button">
            Vezi toate ghidurile
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
