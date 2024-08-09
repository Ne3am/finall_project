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
	<form action="" method="">
		<input type="hidden" id="lat" value="{{$address['latitude']}}">
		<input type="hidden" id="lng" value="{{$address['longitude']}}">
	</form>
	<div id="map" style="width:100%; height: 100vh"></div>
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


	<script>
        
		var lat = document.getElementById("lat").value ;
		var lng = document.getElementById("lng").value ;
		var map = L.map('map').setView([33.749888, 36.3245184], 11);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);

		var taxiIcon = L.icon({
			iconUrl: '{{url('photos/step-2.png')}}',
			iconSize: [70, 70]
		})
		
		var marker = L.marker([33.749888, 36.3245184],{ icon: taxiIcon }).addTo(map);
		var newMarker = L.marker([lat, lng]).addTo(map);

		L.Routing.control({
				waypoints: [
					L.latLng(33.749888, 36.3245184),
					L.latLng(lat,lng)
				]
			}).on('routesfound', function (e) {

		var routes = e.routes;
		console.log(routes);

		e.routes[0].coordinates.forEach(function (coord, index) {
			setTimeout(function () {
				marker.setLatLng([coord.lat, coord.lng]);
			}, 100 * index)
		})

	}).addTo(map);

	</script>


</body>

</html>