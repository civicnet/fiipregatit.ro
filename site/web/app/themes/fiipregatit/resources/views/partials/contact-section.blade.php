<div class="container-fluid" id="contact-section">
  <div class="container contact-info">
    <h2>
      VREI SĂ NE TRANSMIȚI UN MESAJ?
    </h2>
    <div class="row">
      <div class="contact-info-text col-md-6 col-xs-12">
        <div>
          Adresă:
          <a
            href="https://maps.google.com?q=Piața+Revoluției+nr.1+A+sector+1+București"
            rel="nofollow"
            target="_blank">
            Piața Revoluției, nr.1 A, sector 1, București
          </a><br/>
          Telefon <strong><a href="tel:021.312.25.47">021.312.25.47</a></strong><br/>
          Centrala <a href="tel:021.303.70.80">021.303.70.80</a><br/><br/>

          Fax: 021.313.71.55/021.264.86.46<br/>
          E-mail: <strong><a href="mailto:dsu@mai.gov.ro">dsu@mai.gov.ro</a></strong><br/>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        {!! do_shortcode('[pirate_forms]') !!}
      </div>
    </div>
  </div>
  <h2>
    Unde ne găsești
  </h2>
  <div class="row">
    <div id="map"></div>
  </div>
</div>


<script>
  function initMap() {
    var marker_location = { lat: 44.4386238, lng: 26.0985546 };
    // Styles a map in night mode.
    var map = new google.maps.Map(document.getElementById('map'), {
      center: marker_location,
      zoom: 17,
      styles: [{elementType:"geometry",stylers:[{color:"#242f3e"}]},{elementType:"labels.text.fill",stylers:[{color:"#746855"}]},{elementType:"labels.text.stroke",stylers:[{color:"#242f3e"}]},{featureType:"administrative.locality",elementType:"labels.text.fill",stylers:[{color:"#d59563"}]},{featureType:"poi",elementType:"labels.text.fill",stylers:[{color:"#d59563"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#263c3f"}]},{featureType:"poi.park",elementType:"labels.text.fill",stylers:[{color:"#6b9a76"}]},{featureType:"road",elementType:"geometry",stylers:[{color:"#38414e"}]},{featureType:"road",elementType:"geometry.stroke",stylers:[{color:"#212a37"}]},{featureType:"road",elementType:"labels.text.fill",stylers:[{color:"#9ca5b3"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#746855"}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#1f2835"}]},{featureType:"road.highway",elementType:"labels.text.fill",stylers:[{color:"#f3d19c"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#2f3948"}]},{featureType:"transit.station",elementType:"labels.text.fill",stylers:[{color:"#d59563"}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#17263c"}]},{featureType:"water",elementType:"labels.text.fill",stylers:[{color:"#515c6d"}]},{featureType:"water",elementType:"labels.text.stroke",stylers:[{color:"#17263c"}]}]
    });
    var marker = new google.maps.Marker({
      position: marker_location,
      map: map
    });
  }
</script>

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9EqyM2PGMOg7caE5rJlN1xJ2tTQm7HjQ&callback=initMap"
  async
  defer>
</script>
