<link rel="stylesheet" href="{{url('css/stylesh.css')}}">
<header>
        <nav>
        <a href="{{url('delivery')}}">Profile</a>
            <a href="{{url('active')}}"> Active</a>
            <a href="{{url('completed')}}"> Completed</a>
            <a href="{{url('pending')}}"> Pending</a>
            
        </nav>
    </header>
    <section class="placed-orders">
@if(count($orders) > 0)
    <div class="box-container">
    @foreach($orders as $order)
    <div class="box completed">
        <p> user id : <span>{{$order['user_id']}}</span> </p>
        <p> placed on : <span>{{$order['created_at']}}</span> </p>
        <p> name : <span>{{$order['name']}}</span> </p>
        <p> email : <span>{{$order['email']}}</span> </p>
        <p> number : <span>0{{$order['number']}}</span> </p>
        <p> address : <span>
        @foreach($address as $addr)
            @if( $addr['user_id'] == $order['user_id'])
            
            {{$addr['area']}}/{{$addr['street']}}/{{$addr['building']}}/{{$addr['flat']}}
            @break
            @endif
        @endforeach
        </span> </p>
        <p> total products : <span>{{$order['opt_products']}}</span> </p>
        <p> total price : <span>${{$order['total_price']}}</span> </p>
        <p> payment method : <span>{{$order['method']}}</span> </p>
        <form action="{{route('order.destroy' , ['order' => $order['id'] ] )}}" method="POST">
            @csrf
            @method('delete')
            <select name="payment_status" class="drop-down">
            <option value="" selected disabled>completed</option>
            </select>
            <div class="flex-btn">
            <a href="{{route('address.show',$order['user_id'])}}" class="btn">View the location</a>
            <button type="submit" class="delete-btn" >delete</button>
            </div>
        </form>
    </div>
    @endforeach
@else
<p>There are no products to display </p>

    </div>
    @endif
</section>