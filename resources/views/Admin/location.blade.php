<?php 
        use App\Events\TrackingDelivery;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Geolocation</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

	<style>
		body {
			margin: 0;
			padding: 0;
		}
	</style>

</head>

<body>
	<form action="" method="post">
	@csrf
		<input type="hidden" id="lat" value="{{$address['latitude']}}">
		<input type="hidden" id="lng" value="{{$address['longitude']}}">
		<input type="hidden" id="delivery" value="{{ $i = Auth::user()->id}} ">
		<input type="hidden" id="latForDelivery" name="latForDelivery" value="">
		<input type="hidden" id="longForDelivery" name="longForDelivery" value="">
	</form>
	<div id="map" style="width:100%; height: 100vh"></div>
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<script>
        
		var lat = document.getElementById("lat").value ;
		var lng = document.getElementById("lng").value ;

		var latForDelivery = document.getElementById("latForDelivery") ;
		var longForDelivery = document.getElementById("longForDelivery") ;

		var map = L.map('map').setView([-73.9846, 40.7483], 11);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',
		{ attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);

		var taxiIcon = L.icon({
			iconUrl: '{{url('photos/step-2.png')}}',
			iconSize: [70, 70]
		})
		
		var marker = L.marker([-73.9846, 40.7483]).addTo(map);
		var newMarker = L.marker([lat, lng]).addTo(map);

		L.Routing.control({
				waypoints: [
					L.latLng(-73.9846,40.7483),
					L.latLng(lat,lng)
				]
			}).addTo(map);

    if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition)
        }, 10000);
    }

    var m, c;

    function getPosition(position){
        // console.log(position)
        var latit = position.coords.latitude
        var longit = position.coords.longitude
        var accuracy = position.coords.accuracy

        if(m) {
            map.removeLayer(m)
        }

        if(c) {
            map.removeLayer(c)
        }

        m = L.marker([latit, longit])
        c = L.circle([latit, longit], {radius: accuracy})

        //var featureGroup = L.featureGroup([m, c]).addTo(map)

        //map.fitBounds(featureGroup.getBounds())
		console.log("Your coordinate is: Lat: "+ latit +" Long: "+ longit+ " Accuracy: "+ accuracy)

		document.getElementById("latForDelivery").value = latit ;
		document.getElementById("longForDelivery").value= longit ; 

	
    }

</script>

</body>

</html>