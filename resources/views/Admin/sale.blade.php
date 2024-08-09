<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Sale</title>
</head>
<body>
<header>
        <nav>
        <a href="{{url('Admin-home')}}">Dashboard</a>
            <a href="{{url('products')}}">Product</a>
            <a href="{{url('Meals')}}">More</a>
            <a href="{{url('users')}}">Users</a>
            <a href="{{url('order')}}">Orders</a>
            <a href="{{url('profits')}}">Reports</a>
            <a href="{{url('sale')}}">Sale</a>
            <a href="{{url('admins')}}">Admins</a>
            <a href="{{url('messages')}}">Message</a>
            <span></span>
        </nav>
    </header>
    <section class="sale">
    @if(count($products) > 0)
    <form action="{{route('sale.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="sale_products">
    <div class="sale_main_dish">
        <h1> Main Dish </h1>
        </br>
        @foreach($products as $product)
            @if($product['category'] == 'main dish')
                <input id="{{$product['name']}}" type="checkbox" value="{{$product['name']}}" name="sale[]">
                <label for="{{$product['name']}}">{{$product['name']}}</label>
                </br></br>
            @endif
        @endforeach
    </div>
    <div class="sale_fast_food">
        <h1> Fast Food </h1>
        </br>
        @foreach($products as $product)
        @if($product['category'] == 'fast food')
            <input id="{{$product['name']}}" type="checkbox" value="{{$product['name']}}" name="sale[]">
                <label for="{{$product['name']}}">{{$product['name']}}</label>
                </br></br>
            @endif
        @endforeach
    </div>
    <div class="sale_drinks">
        <h1> Drinks </h1>
        </br>
        @foreach($products as $product)
        @if($product['category'] == 'drinks')
            <input id="{{$product['name']}}" type="checkbox" value="{{$product['name']}}" name="sale[]">
                <label for="{{$product['name']}}">{{$product['name']}}</label>
                </br></br>
            @endif
        @endforeach
    </div>
        <br/>
        <br/>
    <div class="sale_desserts">
        <h1> Desserts </h1>
        </br>
        @foreach($products as $product)
        @if($product['category'] == 'desserts')
            <input id="{{$product['name']}}" type="checkbox" value="{{$product['name']}}" name="sale[]">
                <label for="{{$product['name']}}">{{$product['name']}}</label>
                </br></br>
            @endif
        @endforeach
    </div>
    </div>
    <div class="sale_input">
        <div>
        <label>Discount : </label>
        <input type="number" class="sale_input_1" required min="0" max="9999999999" placeholder="enter discount rate" name="discount" value="">
        </div>
        <div>
        <label>Date of finish the sale : </label>
        <input type="date" class="sale_input_1" required name="date" >
        </div>
        <input type="submit" value="add sale" name="add-sale" class="btn">
    </div>
    </form>
    @endif
    </section>
    <div class="frequentItemSet">
        <h1>Recommendations for sales</h1>
        <div class="items">
        <div class="head">
            <p>we recommend adding a discount on the following products because of their frequent purchase together</p> 
        </div>
        <div class="item">
    @foreach($frequentItemSets as $frequentItemSet)
            <p class="sets"> => {{$frequentItemSet}} </p>
            </br></br>
    @endforeach
        </div>
        </div>
    </div>
</body>
</html>