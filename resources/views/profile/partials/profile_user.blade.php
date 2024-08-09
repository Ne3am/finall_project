<link rel="stylesheet" href="{{url('css/style.css')}}">
<x-app-layout>
<section class="user-details">
        <form class="user">
            <div class="image-content">
            <div>
            <img src="{{url('photos/user-icon.png')}}" alt="">
            </div>
            </div>
            <p><i class="fas fa-user"></i><span>{{Auth::user()->name}}</span></p>
            <p><i class="fas fa-phone"></i><span>{{Auth::user()->number}}</span></p>
            <p><i class="fas fa-envelope"></i><span>{{Auth::user()->email}}</span></p>
            <a href="{{route('profile.edit')}}" class="btn">update your information</a>
            <p class="address"><i class="fas fa-map-marker-alt"></i><span>
                @if(count($address)> 0 )
                {{ $address['area'] . $address['street'] . $address['building'] . $address['flat']}}</span>
                @endif
                @if(count($address) == 0 )
                no address added yet</span>
                @endif
                </p>
            <a class="btn" href="{{url('address')}}">update your address</a>
        </form>
    </section>
    </x-app-layout>