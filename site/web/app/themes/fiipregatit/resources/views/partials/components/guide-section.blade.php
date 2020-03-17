<div class="card">
  <div class="card-header" id="heading{{ $id }}">
    <h5 class="mb-0">
      <button
        class="btn btn-link @if (!$isCollapsed) collapsed @endif"
        data-toggle="collapse"
        data-target="#collapse{{ $id }}"
        aria-expanded="@if ($isCollapsed) true @else false @endif"
        aria-controls="collapse{{ $id }}">
        {{ $title }}
        <i class="fa fa-chevron-down pull-right"></i>
      </button>
    </h5>
  </div>
  <div
    id="collapse{{ $id }}"
    class="collapse @if ($isCollapsed) show @endif">
    <div class="card-body">
      {!! $content !!}
    </div>
  </div>
</div>
