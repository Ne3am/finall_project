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
    <title>Checkout</title>
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
    <h1 class="title-orders">checkout your order   😋</h1>
    <section class="check">
        <form action="{{route('orders.store')}}" method="post">
            @csrf
        <div class="bord">
        <input type="hidden" name="total" value="{{$total=0}}"/>
        <input type="hidden" name="product" value="{{$products=''}}"/>
        <input type="hidden" name="name" value="{{Auth::user()->name}}"/>
        <input type="hidden" name="number" value="{{Auth::user()->number}}"/>
        <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
        <input type="hidden" name="component" value="bla bla"/>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
        <div class="cart-items">
            <h3>cart items</h3>
            <?php $product = array() ?>
        @foreach($carts as $cart)
            <?php $product[] = $cart['name'] ?>
            <input type="hidden" name="cart_total" value="{{$total+=$cart['quantity']*$cart['price']}}">
            <p><span class="name">{{$cart['name']}} x {{$cart['quantity']}}</span>
            <span class="price">
            {{$cart['price']}}
            </span></p>
            <input type="hidden" name="products"
                value="{{$products = $products .
                    $cart['name'] . 
                    ' (' . $cart['quantity'] .
                        ' x ' . $cart['price'] . ') '}}"/>
            @endforeach

            <?php
                $sale = 0 ;
                // الوظيفة لتوليد جميع الفرعيات لمجموعة معينة
                function Subsets($set) {
                    $subsets = array();
                    $numElements = count($set);

                    for ($x = 1; $x < (1 << $numElements); $x++) {
                            $subset = array();

                    for ($y = 0; $y < $numElements; $y++) {
                            if ($x & (1 << $y)) {
                            $subset[] = $set[$y];
            }
        }
        $subsets[] = $subset;
    }

    return $subsets;
} 
                $sets = Subsets($product);
                
                foreach($sales as $s){
                    $sale_arr = explode("," , $s['products']) ;
                    foreach($sets as $set){
                            if($set == $sale_arr ){
                                $sale = $s['sale'];
                                break;
                            }
                    }
                }
                ?>
                @if($sale == 0)
            <p><span class="grand-total">grand total:</span>
            <span class="total-price">{{$total}}$</span></p>
            @endif
            @if($sale != 0)
            <p>cart total :  {{$total}} => <mark><span>{{$total - ($total*$sale)/100}}</span></mark></p>
            @endif
            <a class="btn" type="submit" href="cart.html" >view cart</a>
            </div>
            <div class="info">
            <h3>your info</h3>
            <p><i class="fas fa-user"></i><span>{{Auth::user()->name}}</span></p>
            <p><i class="fas fa-phone"></i><span>{{Auth::user()->number}}</span></p>
            <p><i class="fas fa-envelope"></i><span>{{Auth::user()->email}}</span></p>
            <a href="{{route('profile.edit')}}" class="btn">update your information</a>
            <p class="address"><i class="fas fa-map-marker-alt"></i>
            @if(isset($address))
            @foreach($address as $addr)
            <span>{{$addr['area']}}/{{$addr['street']}}/{{$addr['building']}}/{{$addr['flat']}}</span>
            @break
            @endforeach
            @endif
            @if($address == '[]')
            <span>Please enter your Address</span>
            @endif
            </p>
            <a class="btn" href="{{url('address')}}">update your address</a>
            </div>
            <select name="method" class="box" required>
                <option value="" selected disabled>select payment method</option>
                <option value="cash" onclick="pay('cash_on_delevery')">cash on delevery</option>
                <a href="https://My.syriatel.sy"><option value="cash_syriatel" onclick="pay('cash_syriatel')">cash syriatel</option></a>
                <option value="Balance" onclick="pay('Balance')">Balance</option>
            </select>
            <input type="hidden" name="opt_products" value="{{$products}}"/>
            <input type="hidden" name="total_price" value="{{$total}}"/>
            <input type="hidden" name="payment_status" value="pending"/>
            <a href="https://My.syriatel.sy">syr</a>
            <input type="submit" name="submit" value="place order" class="btn" style=" margin: 3rem;">
            </div>
            </form>
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
        function pay(gover){
    alert('You choose : ' + gover + ' !!!!!')
    }
        let toggleMenu = document.querySelector('.toggleMenu');
        let navigation = document.querySelector('.navigation-profits');
        toggleMenu.onclick = function(){
            navigation.classList.toggle('active');
        }
    </script>
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