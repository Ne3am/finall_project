<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="swiper-bundle.min.css" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Quick View</title>
</head>
<body>
<h1 class="title-orders">Details of this meal  😋</h1>
<section class="products">
<div class="quick_view">
<div class="box-container">
<div  class="box">
                <form action="{{route('cart.store')}}" method="post">
                @csrf
                    <input type="hidden" value="{{$product['category']}}" name="category">
                    <input type="hidden" value="{{$product['name']}}" name="name">
                    <input type="hidden" value="{{$product['price']}}" name="price">
                    <input type="hidden" value="{{$product['id']}}" name="pid">
                    <input type="hidden" value="{{$product['image']}}" name="image">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                    <img src="{{$product['image']}}" alt="" class="image">
                    </br></br>
                    <a href="category.html" class="cat">Category : {{$product['category']}}</a>
                    <div class="name">Name : {{$product['name']}}</div>
                    <div class="flex">
                        <div class="price">The Price : {{$product['price']}}<span>$</span></div>
                        <input type="submit" name="addtocart" class="fas fa-shopping-cart">
                    </div>
                    </br></br>
                    - <span class="details">Calories => {{$product['calories']}} </span>
                    - <span class="details">Free Gluten  => {{$product['gluten']}} </span>
                    </br></br>
                    - <span class="details">Vegetarian  => {{$product['Vegetarian']}} </span>
                    - <span class="details">Kidney_friendly => {{$product['Kidney_friendly']}}</span>
                    </br></br>
                    - <span class="details">quantity_Carbohydrate => {{$product['quantity_Carbohydrate']}}</span> 
                    </br></br>
                    </br></br>
                    <p>component => {{$product['component']}}</p> 
                    </br></br>
                    <div class="flex">
                        <p style ="font-size: 2rem;">Quantity: </p>
                    <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                    </div>
                    </br></br>
                </form>
                <div class="flex-btn">
        <a href="{{url('menu')}}" class="option-btn option2">Go Back</a>
    </div>
</div></div></div>
</section>
</body>
</html>