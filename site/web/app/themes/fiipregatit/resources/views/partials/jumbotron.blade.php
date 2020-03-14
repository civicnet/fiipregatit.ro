<div class="container-fluid">
  <div class="row">
    <div class="jumbotron jumbotron-fluid {{ !$show_header ? 'small-jumbotron' : '' }} ">
      <div class="container">
        @if ($show_header)
          <h1>Fii pregătit</h1>
          <h3>pentru</h3>
          <h1 class="subtitle">situații de urgență</h1>
        @endif
        <div class="align-self-center">
          @include('partials.search-form')
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function ($) {
    $('#search .search-field').focus(function() {
    	var ele = $(this);
      $('html, body').animate({
          scrollTop: ele.offset().top - 80
      }, 500);
    });
  }(jQuery))
</script>
