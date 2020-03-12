<div class="container-fluid">
  <div class="row">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
          <h1>Fii pregătit</h1>
          <h3>pentru</h3>
          <h1 class="subtitle">situații de urgență</h1>
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
