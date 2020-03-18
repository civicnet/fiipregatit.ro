<footer>
  <div class="container content-info">
    <div class="row">
      <div class="col page-list col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <ul>
          <li>
            <a href="/" class="header">
              Acasă
            </a>
          </li>
          <?php
            $pages = get_pages();
            foreach ($pages as $page) {
              if ($page->post_title === 'Homepage') {
                continue;
              }
          ?>
            <li>
              <a href="<?=get_permalink($page->ID);?>" class="mobile-block-link">
                <?=$page->post_title;?>
              </a>
            </li>
          <?php
            }
          ?>
        </ul>
      </div>

      <div class="col link-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="header">
          Legături utile
        </div>
        <ul>
          @foreach (App::links() as $link)
            @if ($link)
              <li>
                <a href="{{ $link['target'] }}" class="mobile-block-link"  rel="nofollow">
                  {{ $link['title'] }}
                </a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>

      <div class="col contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="header">
          COVID-19
        </div>
        <div class="footer-address">
          <div style="color: #fc0">doar pentru informații și recomandări</div>
          România <strong><a href="tel:0800800358">0800 800 358</a></strong><br/>
          Diaspora <strong><a href="tel:0040213202020">+40 21 320 20 20</a></strong><br/> (tarif normal în orice rețea) <br/><br/>

          <span>Departamentul pentru Situații de Urgență</span><br/>
          Telefon <strong><a href="tel:021.312.25.47">021.312.25.47</a></strong><br/>
          Centrala <strong><a href="tel:021.303.70.80">021.303.70.80</a></strong><br/>
          E-mail: <strong><a href="mailto:dsu@mai.gov.ro">dsu@mai.gov.ro</a></strong><br/>
        </div>
      </div>

      <div class="col social-media col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="header">
          Social Media
        </div>
        <ul class="social-media-mobile-block">
          <li>
            <a href="https://www.facebook.com/departamenturgente"  rel="nofollow" target="_blank">
              <i class="fab fa-facebook-square"></i>
              Facebook
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com/channel/UC5qTBf9rEFj2UdxNEQOzlxA"  rel="nofollow" target="_blank">
              <i class="fab fa-youtube-square"></i>
              YouTube
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="bottom container-fluid">
    <div class="row align-middle logos-row justify-content-center">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 logo-box">
        <a href="http://www.dsu.mai.gov.ro/" target="_blank">
          <ul>
            <li class="sq-logo">
              <img src="@asset('images/Logo_DSU.svg')" alt="Logo DSU"/>
            </li>
            <li>
              <div class="copyright">
                <h4>Departamentul pentru Situații de Urgență</h4>
                <div class="sub">
                  Toate drepturile rezervate &copy; 2017 - 2020
                </div>
              </div>
            </li>
          </ul>
        </a>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 logo-box">
        <a href="https://www.igsu.ro/" target="_blank">
          <ul>
            <li class="sq-logo">
              <img src="@asset('images/Stema_IGSU_color.png')" alt="Stema IGSU"/>
            </li>
            <li>
              <div class="copyright">
                <h4>Inspectoratul General pentru Situații de Urgență</h4>
              </div>
            </li>
          </ul>
        </a>
      </div>
      <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 logo-box" style="">
          <span
            class="coffee"
            style="text-transform: capitalise; font-size: 12px; width: 150px; margin: 0 auto; display: block">
            Creat cu
            <i class="fas fa-heart" style="margin: 0 4px"></i>
            si
            <i class="fas fa-coffee" style="margin: 0 4px"></i>
            de
          </span>
          <a href="https://civicnet.ro/" class="civicnet" target="_blank">
            <img src="@asset('images/CivicNetLogoNegative.svg')" alt="Logo CivicNet" style="margin: 0 auto" />
          </a>
          <a
            href="https://github.com/civicnet/fiipregatit.ro"
            target="_blank"
            class="contribute"
            style="text-transform: capitalise; font-size: 12px; width: 150px; margin: 0 auto; display: block">
            <i class="fab fa-github"></i>
            Contribuie si tu
          </a>
        </div>
    </div>
  </div>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script>
  jQuery(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      jQuery(this).ekkoLightbox({
        alwaysShowClose: true,
        strings: {
          close: 'Închide',
          fail: 'Momentan nu putem afișa conținutul, vă rugăm încercați mai târziu',
          type: 'Nu am putut detecta tipul conținutului'
        }
      });
  });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114659863-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114659863-2');
</script>
