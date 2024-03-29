
<!DOCTYPE html>
<html>
<head>
  <title></title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


  <script src="https://maps.googleapis.com/maps/api/js?key='YOUR OWN API KEY'&libraries=places&callback=initMap" async defer></script>
  <style type="text/css">
    
    #map {
    width: 100%;
    height: 400px;
}
.controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
#searchInput {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 50%;
}
#searchInput:focus {
    border-color: #4d90fe;
}

  </style>
</head>
<body>
<div class="container">
<input id="searchInput" class="controls" type="text" placeholder="Enter a location">
<div id="map"></div>

<ul id="geoData">
<br> <br>
    <form method="post" action="insert.php">
    <div class="form-group">
      <label for="email">Location</label>
      <input type="email" class="form-control" id="location" name="location" readonly>
    </div>


    <div class="form-group">
      <label for="pwd">Postal Code</label>
      <input type="password" class="form-control" id="postal_code" name="postal_code" readonly>
    </div>

    <div class="form-group">
      <label for="email">Country</label>
      <input type="email" class="form-control" id="country" name="country" readonly>
    </div>
    <div class="form-group">
      <label for="pwd">Latitude</label>
      <input type="password" class="form-control" id="lat" name="lat" readonly>
    </div>
    <div class="form-group">
      <label for="pwd">Longitude</label>
      <input type="password" class="form-control" id="lon" name="lon" readonly>
    </div>

    <div class="form-group">
      <label for="pwd">Month</label>
      <input type="month" class="form-control" id="start" name="start" min="2019-09" value="2019-09">
    </div>

    <div class="form-group">
      <label for="pwd">Time(HH:MM)</label>
      <input type="time" class="form-control" id="appt" name="appt" min="00:00"required>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

    <!-- <li>Full Address: <span id="location"></span></li>
    <li>Postal Code: <span id="postal_code"></span></li>
    <li>Country: <span id="country"></span></li>
    <li>Latitude: <span id="lat"></span></li>
    <li>Longitude: <span id="lon"></span></li> -->
</ul>
</div>
</body>
</html>


<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
    });
}
</script>

