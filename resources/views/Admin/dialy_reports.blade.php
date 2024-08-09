<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Document</title>
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
            <a href="{{url('admins')}}">Admins</a>
            <a href="{{url('messages')}}">Message</a>
            <span></span>
        </nav>
    </header>
    <p>the price of food</p>
<input type="hidden" value="{{$profit=0}}">
<input type="hidden" value="{{$i=1}}">
<ul>
@foreach($orders as $order)
@if(strtotime(date('Y-m-d',strtotime($order['created_at']))) == strtotime(date('Y-m-d')) )
The price {{$i++}}<li>
{{$order['total_price']}} </li>
<input type="hidden" name="profits" value="{{$profit+=$order['total_price']}}">
<br/>
@endif
@endforeach
</ul>
<p>the dialy sales <b>{{$profit}}</b> for this day</p>
</body>
</html>
