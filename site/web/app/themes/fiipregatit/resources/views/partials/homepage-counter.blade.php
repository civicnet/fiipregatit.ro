<div class="container-fluid" id="summary-section">
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="/ghiduri">
          <i class="far fa-file-alt icon"></i>
          <div class="count">
            <span>{{ $guide_count || 0 }}</span> ghiduri educative
          </div>
        </a>
      </div>
      <div class="col">
        <a href="/galerie-foto">
          <i class="far fa-image icon"></i>
          <div class="count">
            <span>{{ $image_count || 0 }}</span> imagini si ilustrații
          </div>
        </a>
      </div>
      <div class="col">
        <a href="/galerie-video">
          <i class="fa fa-film icon"></i>
          <div class="count">
            <span>{{ $video_count || 0 }}</span> video instrucțiuni
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
