<div
  class="tab-pane fade {{ array_key_exists('is_active', $section) ? 'show active' : '' }}"
  id="{{ $section['slug'] }}"
  role="tabpanel"
  aria-labelledby="{{ $section['slug'] }}-tab">
  <h2>{{ $section['name'] }}</h2>
  @if (array_key_exists('is_partner_page', $section))
    <div class="row descriere-toti-partenerii">
      {{ $section['descriere_parteneri'] }}
    </div>
    @foreach ($section['parteneri'] as $partener)
      <div class="row despre-row-partener">
        <div class="col-lg-4 col-sm-12">
          <img src="{{ $partener['logo_partener'] }}" class="despre-logo-partener" alt="{{ $partener['name'] }}"/>
        </div>
        <div class="col-lg-8 col-sm-12">
          {{ $partener['descriere_partener'] }}
        </div>
      </div>
    @endforeach
  @else
    {!! $section['content'] !!}
  @endif
</div>
