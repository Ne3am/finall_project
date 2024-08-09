<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>About</title>
</head>
<body>
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
    <section class="about">
        <h1 class="title-orders">about us</h1>
        <div class="row">
            <div class="image">
                <img src="photos/about-img.svg" alt="">
            </div>
            <div class="content">
                <h3>best food in the country</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, tempora sequi esse fuga consectetur corporis accusamus nam ducimus aut odio asperiores. Odio sed assumenda rem ullam nisi rerum minus nulla.</p>
                <div class="icons-container">
                    <div class="icons">
                        <i class="fas fa-shipping-fast"></i>
                        <span>free delivery</span>
                    </div>
                    <div class="icons">
                        <i class="fas fa-dollar-sign"></i>
                        <span>easy payments</span>
                    </div>
                    <div class="icons">
                        <i class="fas fa-headset"></i>
                        <span>24/7 service</span>
                    </div>
                </div>
                <a href="menu.php" class="btn">our menu</a>
            </div>
        </div>
    </section>
    <section class="steps">
        <h1 class="title">Three steps to get the food</h1>
        <div class="box-container">
            <div class="box">
                <img src="photos/step-1.png" alt="">
                <h3>choose order</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.a praesentium distinctio?</p>
            </div>
            <div class="box">
                <img src="photos/step-2.png" alt="">
                <h3>fast delivery</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.a praesentium distinctio?</p>
            </div>
            <div class="box">
                <img src="photos/step-3.png" alt="">
                <h3>enjoy food</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.  a praesentium distinctio?</p>
            </div>
        </div>
    </section>
    <section class="team">
        <h1 class="title">Our team</h1>
        <div class="team_box">
            @if(count($chiefs) > 0)
                @foreach($chiefs as $chief)
                    <div class="profile">
                        <img src="images/{{$chief['img']}}"  alt="">
                    <div class="info">
                    <h2 class="name">Chife {{$chief['name']}}</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    </div>
                    </div>
                    @endforeach
                @else
                <p>There are no chiefs to display </p>
                @endif
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
        <div class="credit">created by <span>Ne3am And Noura</span></div>
    </section>
    @include('script')
    @stack('js')
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