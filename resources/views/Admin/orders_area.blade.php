<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>placed orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
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
    
<section class="placed-orders">
@if(count($orders) > 0)
    <div class="box-container">
    <input type="hidden" name="" value="{{$i=0}}">
    @foreach($address as $addr)


    @foreach($addr as $add)

    @foreach($orders as $order)

    @if( $add['user_id'] == $order['user_id'])
    <div class="box">
        <p> user id : <span>{{$order['user_id']}}</span> </p>
        <p> placed on : <span>{{$order['created_at']}}</span> </p>
        <p> name : <span>{{$order['name']}}</span> </p>
        <p> email : <span>{{$order['email']}}</span> </p>
        <p> number : <span>0{{$order['number']}}</span> </p>
        <p> address : <span>
            {{$add['area']}}/{{$add['street']}}/{{$add['building']}}/{{$add['flat']}}
            
        </span> </p>
        <p> total products : <span>{{$order['opt_products']}}</span> </p>
        <p> total price : <span>${{$order['total_price']}}</span> </p>
        <p> payment method : <span>{{$order['method']}}</span> </p>
        <form action="{{route('order.destroy' , ['order' => $order['id'] ] )}}" method="POST">
            @csrf
            @method('delete')
            <p>order status :<span style="color: var(--color-danger);
                padding: 1.3rem;">{{$order['payment_status']}}</span></p>
            <div class="flex-btn">
            <a href="{{route('address.show',$order['user_id'])}}" class="btn">View the location</a>
            <button type="submit" class="delete-btn" >delete</button>            
            </div>
        </form>
    </div>
    @endif
        @endforeach
    @endforeach
    @endforeach
@else
<p>There are no products to display </p>

    </div>
    @endif
</section>
</body>
</html>