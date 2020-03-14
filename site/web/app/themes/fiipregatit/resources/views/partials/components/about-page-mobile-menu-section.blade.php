<a
  class="nav-link {{ array_key_exists('is_active', $section) ? $section['is_active'] : '' }}"
  id="{{ $section['slug'] }}-tab-mobile"
  data-toggle="pill"
  href="#{{ $section['slug'] }}"
  role="tab"
  aria-controls="{{ $section['slug'] }}"
  aria-selected="true">
  {{ $section['name'] }}
</a>
