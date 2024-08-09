<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>
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
<section class="messages">
@if(count($messages) > 0)
    <div class="box-container">
    @foreach($messages as $message)
    <div class="box">
        <p> name : <span>{{$message['name']}}</span> </p>
        <p> number : <span>{{$message['number']}}</span> </p>
        <p> email : <span>{{$message['email']}}</span> </p>
        <p> message : <span>{{$message['letter']}}</span> </p>
        <form action="{{route('messages.destroy' , ['message' => $message['id'] ] )}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="delete-btn" >delete</button>
            </form>
    </div>
    </div>
    @endforeach
@else
<p>There are no message to display </p>
</section>
@endif
</body>
</html>