<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Cart</title>
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
                            <a href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i></a>
                            <a><div id="user-btn"><div>  {{ Auth::user()->name }} </div></div></a>
                            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
                        </div>
        </nav>
    </header>
    <div class="products">
        <h1 class="title-orders">your cart  😋</h1>
        @if(count($carts) > 0)
        <div class="box-container">
        <input type="hidden" name="total" value="{{$totals= 0 }}"/>
        <?php $products = array() ?>
        @foreach($carts as $cart)
            <?php $products[] = $cart['name'] ?>
            <form action="{{route('cart.update', $cart['id'] )}}" class="box" method="post" enctype="multipart/form-data" >
            @csrf
            @method('put') 
                    <input type="hidden" value="{{$cart['image']}}" name="image">
                    <input type="hidden" value="{{$cart['component']}}" name="category">
                    <input type="hidden" value="{{$cart['name']}}" name="name">
                    <input type="hidden" value="{{$cart['price']}}" name="price">
                    <input type="hidden" value="{{$cart['pid']}}" name="pid">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                <a href="{{route('cart.edit' , $cart['id'] )}}" class="fas fa-times" name="delete-item" ></a>
                <img src="{{$cart['image']}}" alt="">
                <a href="#" class="cat">{{$cart['name']}}</a>
                <div class="flex">
                    <div class="price"><span>$</span>{{$cart['price']}}</div>
                    <input type="number" name="qty" class="qty" min="1" max="99"
                    value="{{$cart['quantity']}}" onkeypress="if(this.value.length==2) return false" >
                    <a class=" fas fa-edit" ><input type="submit" value="update" name="update_info"></a>
                </div>
                <input type="hidden" name="cart_total" value="{{$totals+=$cart['quantity']*$cart['price']}}">
                <div class="sub-total">sub-total :
                        <span>$</span>{{$total=$cart['quantity']*$cart['price']}}</div>
            </form>
            @endforeach        
                </div>
                <?php
                $sale = 0 ;
                // الوظيفة لتوليد جميع الفرعيات لمجموعة معينة
                function generateSubsets($set) {
                    $subsets = array();
                    $numElements = count($set);

                    for ($i = 1; $i < (1 << $numElements); $i++) {
                            $subset = array();

                    for ($j = 0; $j < $numElements; $j++) {
                            if ($i & (1 << $j)) {
                            $subset[] = $set[$j];
            }
        }
        $subsets[] = $subset;
    }

    return $subsets;
} 
                $sets =  generateSubsets($products);
                
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

                <div class="cart-total">
                @if($sale == 0)
            <p>cart total : <span>{{$totals}}</span></p>
            @endif
            @if($sale != 0)
            <p>cart total :  {{$totals}} => <mark><span>{{$totals - ($totals*$sale)/100}}</span></mark></p>
            @endif
            <a href="{{url('checkout')}}" class="btn">proceed to checkout</a>
            </div>
            <div class="more-btn">
            <form action="{{route('cart.destroy',Auth::user()->id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="delete-btn" name="delete">delete all</button>
            </form>
            </div>
            @else
                    <p>There are no products to display </p>
                @endif
    </div>
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
    <script src="script.js"></script>
</body>
</html>