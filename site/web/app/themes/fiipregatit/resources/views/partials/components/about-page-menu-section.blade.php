<a
  class="nav-link {{ array_key_exists('is_active', $section) ? $section['is_active'] : '' }}"
  id="{{ $section['slug'] }}-tab"
  data-toggle="pill"
  href="#{{ $section['slug'] }}"
  role="tab"
  aria-controls="{{ $section['slug'] }}"
  aria-selected="true">
  <i class="fas fa-chevron-right"></i>
  {{ $section['name'] }}
</a>
