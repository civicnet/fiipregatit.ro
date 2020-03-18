@extends('layouts.app')

@section('content')
  @include('partials.jumbotron',
  ['show_header' => false, 'isSearchPage' => true])

<div class="container" id="search-page-section">
  <div class="row justify-content-center">
  	<div id="ais-wrapper" class="col-lg-8 col-sm-12">
  		<main id="ais-main">
        <div id="algolia-stats"></div>
  			<div id="algolia-hits">
        </div>
  			<div id="algolia-pagination"></div>
  		</main>
  	</div>
  </div>
</div>

<script type="text/html" id="tmpl-instantsearch-blank">
  @include('partials.404-section')
</script>

@verbatim
  <script type="text/html" id="tmpl-instantsearch-hit">
      <div class="ais-hits--content">
        <h4 itemprop="name headline">
          <a
            href="{{ data.permalink }}"
            title="{{ data.title }}"
            itemprop="url"
            style="display:block; margin-bottom: 8px;">
            {{{ data._highlightResult.title.value }}}
          </a>
          <div class="content-label badge">
            Ghid
          </div>
        </h4>
        <div class="excerpt">
          <p>
          <# if (data._snippetResult['content']) { #>
            <span class="suggestion-post-content">{{{ data._snippetResult['content'].value }}}</span>
          <# } #>
          </p>
        </div>
      </div>
      <div class="ais-clearfix"></div>
    </script>
  @endverbatim

@endsection
