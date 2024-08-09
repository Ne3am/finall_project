<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="swiper-bundle.min.css" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Address</title>
</head>
<body>
<header>
        <nav>
        <a href="" class="logo">yum-yum 😋</a>
            <a href="{{url('/dashboard')}}">Home</a>
            <a href="{{url('about')}}">About</a>
            <a href="{{url('menu')}}">Menu</a>
            <a href="{{route('sale.create')}}">Sales </a>
            <a href="{{url('order')}}">Orders</a>
            <a href="{{url('contuct')}}">Contant us</a>
            <span></span>
            <div class="icons">
            <a href="{{url('search_product')}}"><i class="fas fa-search"></i></a>
                            <a href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i><span>(3)</span></a>
                            <a><div id="user-btn"><div>  {{ Auth::user()->name }} </div></div></a>
                            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
                        </div>
        </nav>
    </header>
    <section class="register">
    <div class="box">
    <div class="container">
        <div class="box1 form-box">
            <header>YOUR ADDRESS</header>
            @if(isset($address))
            @foreach($address as $addr)
            <form action="{{route('address.store')}}" method="post">
                @csrf
                
                <div class="field input">
                    <input type="text" value="{{$addr['area']}}" name="area" 
                    id="area" required maxlength="50" placeholder="area name">
                </div>
                <div class="field input">
                    <input type="text" value="{{$addr['street']}}" name="street"
                    id="street" required maxlength="50" placeholder="street name">
                </div>
                <div class="field input">
                    <input type="text" value="{{$addr['building']}}" name="building" 
                    id="building" required maxlength="50" placeholder="building number">
                </div>
                <div class="field input">
                    <input type="text" value="{{$addr['flat']}}" name="flat" 
                    id="flat" required maxlength="50" placeholder="flat number">
                </div>
                <input type="hidden" value="{{Auth::user()->id}}" name="id_user">
                <input type="hidden" value="" name="distance" id="distance">
                <input type="hidden" value="" name="cost" id="cost">
                <input type="hidden" value=""  id="lang" name="lang" required >
                <input type="hidden" value=""  id="lati" name="lati" required >
                <input type="hidden" value="-73.9848"  id="langForRest" name="langForRest">
                <input type="hidden" value="40.7483"  id="latiForRest" name="latiForRest">
                <div class="field">
                    <input type="submit" value="Save Address" class="btn" name="submit" 
                    id="username" required>
                </div>
            </form>
            @break
            @endforeach
            @endif
            @if($address == '[]')
            <form action="{{route('address.store')}}" method="post">
            @csrf
                <div class="field input">
                    <input type="text" name="area" id="area" required maxlength="50" 
                    placeholder="area name">
                </div>
                <div class="field input">
                    <input type="text" name="street" id="street" required maxlength="50" 
                    placeholder="street name">
                </div>
                <div class="field input">
                    <input type="text" name="building" id="building" required maxlength="50" 
                    placeholder="building number">
                </div>
                <div class="field input">
                    <input type="text" name="flat" id="flat" required maxlength="50" 
                    placeholder="flat number">
                </div>
                
                
                <input type="hidden" value="{{Auth::user()->id}}" name="id_user">
                <input type="hidden" value="" name="distance" id="distance">
                <input type="hidden" value="" name="cost" id="cost">
                <input type="hidden" value=""  id="lang" name="lang" required>
                <input type="hidden" value=""  id="lati" name="lati" required>
                <input type="hidden" value="-73.9848"  id="langForRest" name="langForRest">
                <input type="hidden" value="40.7483"  id="latiForRest" name="latiForRest">
                <div class="field">
                    <input type="submit" value="Save Address" class="btn" name="submit" 
                    id="username" required>
                </div>
            </form>
            @endif
        </div>
    </div>
    </div>
    </section>
    <section class="footer">
        <section class="grid">
            <div class="box">
                <img src="photos/email-icon.png" alt="">
                <h3>our email</h3>
                <a href="#">sara@gmail.com</a>
            </div>
            <div class="box">
                <img src="photos/clock-icon.png" alt="">
                <h3>opening hours</h3>
                <p>00:07am to 00:10pm</p>
            </div>
            <div class="box">
                <img src="photos/map-icon.png" alt="">
                <h3>our address</h3>
                <a href="#">syria , lattakia , zera3a street</a>
            </div>
            <div class="box">
                <img src="photos/phone-icon.png" alt="">
                <h3>our number</h3>
                <a href="#">123-456-7890</a>
                <a href="#">111-222-3333</a>
            </div>
        </section>
    </section>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
    if(navigator.geolocation){
        navigator.geolocation.watchPosition(function(position){
            console.log(position)
            document.getElementById("lang").value = position.coords.longitude
            document.getElementById("lati").value = position.coords.latitude
    },
        function(error){
            console.log(error)
        })
    }

/*var map = L.map('map').setView([35.749888, 51.3245184], 11);
mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);

var taxiIcon = L.icon({
    iconUrl: 'img/step-2.png',
    iconSize: [70, 70]
})

var marker = L.marker([35.749888, 51.3245184], { icon: taxiIcon }).addTo(map);

map.on('click', function (e) {
    console.log(e)
    var newMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
    L.Routing.control({
        waypoints: [
            L.latLng(35.749888, 51.3245184),
            L.latLng(e.latlng.lat, e.latlng.lng)
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
});
*/

</script>
</body>
</html>