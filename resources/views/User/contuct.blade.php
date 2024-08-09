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
    <title>Contuct us</title>
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
    <section class="contact">
        <div class="row">
            <div class="image">
                <img src="photos/contact-img.svg" alt="">
            </div>
            <form action="{{route('contuct.store')}}" method="post">
            @csrf
                <h3>tell us what the problem!!!</h3>
                <input type="text" class="box" name="name" maxlength="50" placeholder="enter your name" required>
                @error('name')
                        <div class="error">
                                    {{$message}}
                        </div>
                @enderror
                <input type="number" class="box" name="number" min="0" max="9999999999"
                    placeholder="enter your number" required >
                    @error('number')
                                        <div class="error">
                                                {{$message}}
                                        </div>
                    @enderror
                <input type="email" class="box" name="email" maxlength="50" placeholder="enter your email" required>
                @error('email')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                @enderror
                <textarea name="msg" class="box" cols="30" rows="10" required placeholder="enter your message"
                maxlength="600"></textarea>
                @error('msg')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                @enderror
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="submit" class="btn" name="send" value="send your message">
            </form>
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