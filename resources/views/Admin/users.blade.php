<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Users</title>
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
    <main class="table">
        <section class="table_header">
            <h1>Customer's Orders</h1>
        </section>
        <section class="table_body">
            <table>
                <thead>
                        <tr>
                            <th>id</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Balance</th>
                            <th>Num Order</th>
                            <th>Send Offer</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                </thead>
                <tbody>
                @if(count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td class="td-img"><img src="{{$user['img']}}"><p>{{$user['name']}}</p></td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['number']}}</td>
                        <td>{{$user['balance']}}</td>
                        <td>
                            @foreach($numOfOrders as $numOfOrder)
                            @if( $numOfOrder['user_id'] == $user['id'] )
                            {{$numOfOrder['num_orders']}} 
                            @endif
                            @endforeach
                        </td>
                        <td><a href="{{route('sendmail.show' , $user['id'])}}" style="color:green" class="">Send</a></td>
                        <td>
                        <form action="{{route('users.destroy' , $user['id']  )}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" style="color:red" >Delete</button>
                        </form></td>
                        <td><a href="{{route('users.edit' , $user['id' ])}}" style="color:green" class="">Edit</a></td>
                    </tr>
                @endforeach
                
                </tbody> 
            </table>
        </section>
    </main>
                @else
                    <p>There are no products to display </p>
                @endif
</body>
</html>