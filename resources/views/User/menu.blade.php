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
    @if((session()->get('message'))!==null)
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
                        <p class="notification_num" id="notification_count">num of notification : {{Auth()->user()->unreadNotifications->count()}}</p>
                        <a href="{{url('MarkAsRead_all')}}">set read all</a>
                        <p class="notification_details" id="unreadNotifications">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        - {{$notification->data['title']}} By {{$notification->data['user']}} {{$notification->created_at}}
                        </br></br>
                        @endforeach
                        </p>
    </div>
    <h1 class="title-orders">menu of the food  😋</h1>
    <section class="category">
        <div class="box-container">
            <a href="{{url('main_dish')}}" class="box">
                <img src="photos/cat-2.png" alt="">
                <h3>Main Dish</h3>
            </a>
            <a href="{{url('dessert')}}" class="box">
                <img src="photos/cat-4.png" alt="">
                <h3>Desserts</h3>
            </a>
            <a href="{{url('Vegetarian')}}" class="box">
                <img src="photos/cat-1.png" alt="">
                <h3>Vegetarian</h3>
            </a>
            <a href="{{url('Kidney_friendly')}}" class="box">
                <img src="photos/cat-3.png" alt="">
                <h3>Kidney friendly</h3>
            </a>
            <a href="{{url('gluten')}}" class="box">
                <img src="photos/Gluten.png" alt="">
                <h3>Gluten Free</h3>
            </a>
            <a href="{{url('diabetes')}}" class="box">
                <img src="photos/calories-1.jpg" alt="">
                <h3>Diabetes</h3>
            </a>
        </div>
    </section>
    <section class="products">
        <h1 class="title"> the dishes</h1>
        
        @if(count($products) > 0)
        <div class="box-container">
        <input type="hidden" value="{{$i=0}}" name="category">
        <input type="hidden" value="{{$V = '[]'}}" name="category">
        <input type="hidden" value="{{ $V =  Auth::user()->evaluat;}}" name="total_avaluat">
        @if(count($special) > 0)
        @foreach($products as $product)
        @if(in_array($product['name'],$special))
        <div  class="box">
                <form action="{{route('cart.store')}}" method="post">
                @csrf
                    <input type="hidden" value="{{$product['category']}}" name="category">
                    <input type="hidden" value="{{$product['name']}}" name="name">
                    <input type="hidden" value="{{$product['price']}}" name="price">
                    <input type="hidden" value="{{$product['id']}}" name="pid">
                    <input type="hidden" value="{{$product['image']}}" name="image">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <a href="{{route('products.show' , ['product' => $product['id'] ] )}}" class="fas fa-eye"></a>                 
                    <img src="{{$product['image']}}" alt="" class="image">
                    <a href="category.html" class="cat">{{$product['category']}}</a>
                    <div class="name">{{$product['name']}}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{$product['price']}}</div>
                        <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                        <input type="submit" name="addtocart" value="add" class="fas fa-shopping-cart">
                    </div>
                </form>
                <input type="hidden" value="{{$T = 0 }}">
                <form action="{{route('evaluation.store')}}" method="POST">             
                @if( $V != '[]')
                @foreach($V as $W)
                    @if($W['pid'] == $product['id'])
                    <input type="hidden" value="{{$T = 1 }}">
                    <input type="hidden" value="{{$n = $W['evaluat']}}">
                <input type="hidden" value="{{$m = 5 -$W['evaluat']}}">
                <div class="review review{{$i+=1}}">
                @for($x=0 ; $x < $n ; $x++)
                                <i class="far fa-star fas" onclick="Evaluation({{$i}})"></i>
                @endfor
                @for($y=0 ; $y < $m ; $y++)
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                @endfor
                </div>
                @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                    @break;
                    @endif
                @endforeach
                @endif
                @if($V != '[]' && $T == 0)
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                </div>
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                @if($V == '[]')
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                    </div>
                
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                </form>
                </div>
                @endif
                @endforeach
                @foreach($products as $product)
                @if(!in_array($product['name'],$special))

                <div  class="box">
                <form action="{{route('cart.store')}}" method="post">
                @csrf
                    <input type="hidden" value="{{$product['category']}}" name="category">
                    <input type="hidden" value="{{$product['name']}}" name="name">
                    <input type="hidden" value="{{$product['price']}}" name="price">
                    <input type="hidden" value="{{$product['id']}}" name="pid">
                    <input type="hidden" value="{{$product['image']}}" name="image">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <a href="{{route('products.show' , ['product' => $product['id'] ] )}}" class="fas fa-eye"></a>                    <img src="{{$product['image']}}" alt="" class="image">
                    <a href="category.html" class="cat">{{$product['category']}}</a>
                    <div class="name">{{$product['name']}}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{$product['price']}}</div>
                        <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                        <input type="submit" name="addtocart" class="fas fa-shopping-cart">
                    </div>
                </form>
                <input type="hidden" value="{{$T = 0 }}">
                <form action="{{route('evaluation.store')}}" method="POST">             
                @if( $V != '[]')
                @foreach($V as $W)
                    @if($W['pid'] == $product['id'])
                    <input type="hidden" value="{{$T = 1 }}">
                    <input type="hidden" value="{{$n = $W['evaluat']}}">
                <input type="hidden" value="{{$m = 5 -$W['evaluat']}}">
                <div class="review review{{$i+=1}}">
                @for($x=0 ; $x < $n ; $x++)
                                <i class="far fa-star fas" onclick="Evaluation({{$i}})"></i>
                @endfor
                @for($y=0 ; $y < $m ; $y++)
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                @endfor
                </div>
                @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                    @break;
                    @endif
                @endforeach
                @endif
                @if($V != '[]' && $T == 0)
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                </div>
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                @if($V == '[]')
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                    </div>
                
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                </form>
                </div>
        @endif
        @endforeach
        @else
        @foreach($products as $product)
        <div  class="box">
                <form action="{{route('cart.store')}}" method="post">
                @csrf
                    <input type="hidden" value="{{$product['category']}}" name="category">
                    <input type="hidden" value="{{$product['name']}}" name="name">
                    <input type="hidden" value="{{$product['price']}}" name="price">
                    <input type="hidden" value="{{$product['id']}}" name="pid">
                    <input type="hidden" value="{{$product['image']}}" name="image">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <a href="{{route('products.show' , ['product' => $product['id'] ] )}}" class="fas fa-eye"></a>                    <img src="{{$product['image']}}" alt="" class="image">
                    <a href="category.html" class="cat">{{$product['category']}}</a>
                    <div class="name">{{$product['name']}}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{$product['price']}}</div>
                        <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                        <input type="submit" name="addtocart" class="fas fa-shopping-cart">
                    </div>
                </form>
                <input type="hidden" value="{{$T = 0 }}">
                <form action="{{route('evaluation.store')}}" method="POST">             
                @if( $V != '[]')
                @foreach($V as $W)
                    @if($W['pid'] == $product['id'])
                    <input type="hidden" value="{{$T = 1 }}">
                    <input type="hidden" value="{{$n = $W['evaluat']}}">
                <input type="hidden" value="{{$m = 5 -$W['evaluat']}}">
                <div class="review review{{$i+=1}}">
                @for($x=0 ; $x < $n ; $x++)
                                <i class="far fa-star fas" onclick="Evaluation({{$i}})"></i>
                @endfor
                @for($y=0 ; $y < $m ; $y++)
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                @endfor
                </div>
                @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                    @break;
                    @endif
                @endforeach
                @endif
                @if($V != '[]' && $T == 0)
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                </div>
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                @if($V == '[]')
                <div class="review review{{$i+=1}}">
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                                <i class="far fa-star" onclick="Evaluation({{$i}})"></i>
                    </div>
                
                    @csrf
                    <input type="hidden" value="{{$product['id']}}" name="id_product" required>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required>
                    <input type="hidden" value="" name="evaluation" id="evaluation{{$i}}" required>
                    <div class="alert alert{{$i}}"></div>
                    <input type="submit" value="Evaluat" class="btn">
                @endif
                </form>
                </div>
                @endforeach
                @endif
                @else
                    <p>There are no products to display </p>
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
    <script>
        function Evaluation(j){
        const reviewStars = document.querySelectorAll(".review"+j +" i");
        const alert = document.querySelector(".alert"+j);
        const evaluet = document.getElementById("evaluation"+j);
        reviewStars.forEach((star,index) => {
        star.addEventListener("click",() => {
        reviewStars.forEach((el) => el.classList.remove("fas","checked"));

        for(let i=0 ; i <= index ; i++){
            reviewStars[i].classList.add("fas","checked");
        }

        const starsCount = document.querySelectorAll(".review"+j +" i.checked").length;

        alert.classList.add("active");

        alert.innerHTML = `${starsCount}`;
        evaluet.value = `${starsCount}`;
        setTimeout(()=>{
                alert.classList.remove("active");
        },2000);
    });
});
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
    // setInterval(() => {
        
    //     document.querySelector('#notification_count').load(window.location.href + " #notification_count");
    //     $('#unreadNotifications').load(window.location.href + " #unreadNotifications");
    // }, 5000);
    // console.log("hello");
    </script>
</body>
</html>
