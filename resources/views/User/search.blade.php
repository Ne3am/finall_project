<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Search</title>
</head>
<body>
<header>
        <nav>
        <a href="{{url('/dashboard')}}" class="logo">yum yum 😋</a>
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
<section class="search-form">
        <form action="{{url('search_product')}}" method="get">
            <input type="text" name="search" class="box" placeholder="search now....">
            <button type="submit" name="search_now" class="fas fa-search"></button>
        </form>
</section>
<section class="products">
        <h1 class="title"> the dishes</h1>
        @if(count($products) > 0)
        <div class="box-container">
        @foreach($products as $product)
                <form action="" class="box" method="post">
                    <a href="{{url('quick_view')}}" class="fas fa-eye"></a>
                    <button type="submit" name="addtocart" class="fas fa-shopping-cart">add</button>
                    <img src="{{$product['image']}}" alt="" class="image">
                    <a href="category.html" class="cat"></a>
                    <div class="name">{{$product['name']}}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{$product['price']}}</div>
                        <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                    </div>
                </form>
                @endforeach
@else
<p>There are no products to display </p>

    </div>
    @endif
    </section>
</body>
</html>