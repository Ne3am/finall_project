<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="swiper-bundle.min.css" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Orders</title>
</head>
<body>
@if((session()->get('message'))!== null)
        <div class="message">
        <span>{{session()->get('message')}}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        @endif
    <header>
        <nav>
        <a class="logo" id="notification">yum yum 😋</a>
            <a href="{{url('/dashboard')}}">Home</a>
            <a href="{{url('about')}}">About</a>
            <a href="{{url('menu')}}">Menu</a>
            <a href="{{route('sale.create')}}">Sales </a>
            <a href="{{url('orders')}}">Orders</a>
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
    <div class="detail">
                        <p class="notification_num">num of notification : {{Auth()->user()->unreadNotifications->count()}}</p>
                        <a href="{{url('MarkAsRead_all')}}">set read all</a>
                        <p class="notification_details">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        - {{$notification->data['title']}} By {{$notification->data['user']}} {{$notification->created_at}}
                        </br></br>
                        @endforeach
                        </p>
    </div>
    <section class="orders">
        <h1 class="title-orders">your orders  😋</h1>
        @if(count($orders)>0)
        <div class="box-container">
        @foreach($orders as $order)
            <div class="box">
                <p>placed on :<span>{{date('d/m/Y',strtotime($order['created_at']))}}</span></p>
                <p>name :<span>{{$order['name']}}</span></p>
                <p>number :<span>{{$order['number']}}</span></p>
                <p>email:<span>{{$order['email']}}</span></p>
                <p>address:<span>{{$address['area']}}/{{$address['street']}}/{{$address['building']}}/{{$address['flat']}}</span></p>
                <p>total price:<span>{{$order['total_price']}}</span></p>
                <p>your orders:<span>{{$order['opt_products']}}</span></p>
                <p>payment method :<span>{{$order['method']}}</span></p>
                <p>order status :<span style="color: var(--color-danger); background-color: var(--yellow);
                padding: 1.3rem;">{{$order['payment_status']}}</span></p>
            </div>
            @endforeach
        </div>
        @endif
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




<script src="swiper-bundle.min.js"></script>
<script src="script.js"></script>
<script>
        let details  = document.querySelector('.detail');

        document.querySelector('#notification').onclick = () =>{
            details.classList.toggle('active');
    }

    window.onscroll = () =>{
        details.classList.remove('active');
    }
    </script>
</body>
</html>