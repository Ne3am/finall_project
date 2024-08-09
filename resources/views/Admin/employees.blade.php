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
            <strong style="font-size:1.8rem">Customer's Orders</strong>
            <a href="{{route('admins.create')}}" class="Add_employee">Add employee</a>
        </section>
        <section class="table_body">
        
            <table>
                <thead>
                        <tr>
                            <th>id</th>
                            <th>Employees</th>
                            <th>Number</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>    </th>
                        </tr>
                </thead>
                @if(count($employees) > 0)
                @foreach($employees as $employee)
                <tbody>
                    <tr>
                        <td>{{$employee['id']}}</td>
                        <td class="td-img"><img src="images/{{$employee['img']}}"><p>{{$employee['name']}}</p></td>
                        <td>{{$employee['number']}}</td>
                        <td>{{$employee['address']}}</td>
                        <td>{{$employee['email']}}</td>
                        <td><p class="status delivered">{{$employee['role']}}</p></td>
                        <td><a href="{{route('admins.edit' , $employee['id' ])}}" style="color:green" class="">Edit</a>
                        <form action="{{route('admins.destroy' , $employee['id']  )}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" style="color:red" >Delete</button>
                        </form></td>
                    </tr>
                </tbody>
                @endforeach
@else
<p>There are no employees to display </p>

    </div>
    @endif
            </table>
        </section>
    </main>
</body>
</html>