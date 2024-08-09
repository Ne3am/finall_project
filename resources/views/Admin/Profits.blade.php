<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Navigation</title>
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
    <div class="accordian">
    <div class="card">
    <input type="hidden" value="{{$profit=0}}">
    <input type="hidden" value="{{$pending=0}}">
    @foreach($orders as $order)
    @if(strtotime(date('Y-m-d',strtotime($order['created_at']))) == strtotime(date('Y-m-d')) && $order['payment_status']=="completed")
    <input type="hidden" name="profits" value="{{$profit+=$order['total_price']}}">
    @elseif(strtotime(date('Y-m-d',strtotime($order['created_at']))) == strtotime(date('Y-m-d')) && $order['payment_status']=="pending")
    <input type="hidden" name="pending" value="{{$pending+=$order['total_price']}}">
    @endif
    @endforeach
        <div class="card-header">
                    <h3>Orders sold for the day i.e. completed orders</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><b>@if($profit >0) 
        {{$profit}}
        @else
            <p> No completed orders yet </p>
            @endif
        </b></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
                    <h3>Quantity still on hold i.e. pending orders</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><b>@if($pending >0) 
        {{$pending}}
        @else
            <p> No pending orders yet</p>
            @endif
    </b></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
                    <h3> Quantity sold for aspecific day</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
        <form action="{{route('profits.store')}}" method="POST">
        @csrf
            <p><input type="date" name="date" value="{{date('Y-m-d')}}" placeholder="enter the date"></p>
            <input type="submit" value="Enter" name="add_product">
            </form>
            <input type="hidden" value="{{$dialy_date=0}}">
            @if($orders_dialy != '[]' && $orders_dialy != '&')
            @foreach($orders_dialy as $order)
            <input type="hidden" name="dialy_date" value="{{$dialy_date+=$order['total_price']}}">
            @endforeach
            {{$dialy_date}}
            @endif
            @if($orders_dialy == '[]')
            no orders for this day
            @endif
        </div>
    </div>
    <div class="card">
    <input type="hidden" value="{{$profit_month=0}}">
    @foreach($orders as $order)
    @if(strtotime(date('Y-m',strtotime($order['created_at']))) == strtotime(date('Y-m')) && $order['payment_status']=="completed" )
    <input type="hidden" name="profit_month" value="{{$profit_month+=$order['total_price']}}">
    @endif
    @endforeach
        <div class="card-header">
                    <h3>Quantity sold this month</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><b>@if($profit_month >0) 
        {{$profit_month}}
        @else
            <p>No completed orders this month</p>
            @endif
    </b></p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                    <h3>Quantity sold for a specific month</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <form action="{{route('insure_meal.store')}}" method="POST">
        @csrf
            <p><input type="date" value="{{date('Y-m-d')}}" placeholder="enter the month"></p>
            <input type="submit" value="Enter" name="add_product">
            </form>
            
            @if($orders_monthly != [] && $orders_monthly != '&' )
            <input type="hidden" value="{{$monthly_date=0}}">
            @foreach($orders_monthly as $order)
            <input type="hidden" name="monthly_date" value="{{$monthly_date+=$order['total_price']}}">
            @endforeach
            {{$monthly_date}}
            @endif
            @if($orders_monthly == [])
            no orders for this month
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                    <h3> Users are ranked according to the number of Orders from largest to smallest </h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><ul>
    @foreach($users as $user)
        <li>{{$user->user->name}}</li>
        <li>{{$user->num_orders}}</li>
    @endforeach
    </ul> </p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                    <h3>the user who has the largest number of Orders</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><ul>
    @foreach($users as $user)
        <li>{{$user->user->name}}</li>
        <li>{{$user->num_orders}}</li>
        @break;
    @endforeach
    </ul></p>
        </div>
    </div>
    <div class="card">
    <input type="hidden" value="{{$num=0}}">
    @foreach($menu as $m)
    <input type="hidden" value="{{$num+=1}}">
    @endforeach
        <div class="card-header">
        <input type="hidden" value="{{$fast=0}}">
    <input type="hidden" value="{{$fast_food =''}}">
    <input type="hidden" value="{{$quantity = 0 }}">
    <input type="hidden" value="{{$quantity_name = '' }}">
    @if(count($eva_fast) > 0)
    @foreach($eva_fast as $m)
        @if($m->evaluation > $fast)
        <input type="hidden" value="{{$fast= $m->evaluation}}">
        <input type="hidden" value="{{$fast_food = $m->name}}">
        @endif
        @if($m->quantity_sell > $quantity )
            <input type="hidden" value="{{$quantity = $m->quantity_sell }}">
            <input type="hidden" value="{{$quantity_name = $m->name }}">
        @endif
    @endforeach
    @endif
    <input type="hidden" value="{{$main = 0}}">
    <input type="hidden" value="{{$main_food =''}}">
    <input type="hidden" value="{{$quantity_main = 0 }}">
    <input type="hidden" value="{{$quantity_name_main = '' }}">
    @if(count($eva_main) > 0)
    @foreach($eva_main as $m)
        @if($m->evaluation > $main)
        <input type="hidden" value="{{$main = $m->evaluation}}">
        <input type="hidden" value="{{$main_food = $m->name}}">
        @endif
        @if($m->quantity_sell > $quantity_main )
            <input type="hidden" value="{{$quantity_main = $m->quantity_sell }}">
            <input type="hidden" value="{{$quantity_name_main = $m->name }}">
        @endif
    @endforeach
    @endif
    <input type="hidden" value="{{$drink=0}}">
    <input type="hidden" value="{{$drink_name =''}}">
    <input type="hidden" value="{{$quantity_drink = 0 }}">
    <input type="hidden" value="{{$quantity_name_drink = '' }}">
    @if(count($eva_drink) > 0)
    @foreach($eva_drink as $m)
        @if($m->evaluation > $drink )
        <input type="hidden" value="{{$drink= $m->evaluation}}">
        <input type="hidden" value="{{$drink_name = $m->name}}">
        @endif
        @if($m->quantity_sell > $quantity_drink )
            <input type="hidden" value="{{$quantity_drink = $m->quantity_sell }}">
            <input type="hidden" value="{{$quantity_name_drink = $m->name }}">
        @endif
    @endforeach
    @endif
    <input type="hidden" value="{{$dessert=0}}">
    <input type="hidden" value="{{$dessert_name =''}}">
    <input type="hidden" value="{{$quantity_dessert = 0 }}">
    <input type="hidden" value="{{$quantity_name_dessert = '' }}">
    @if(count($eva_dessert) > 0)
    @foreach($eva_dessert as $m)
        @if($m->evaluation > $dessert)
        <input type="hidden" value="{{$dessert= $m->evaluation}}">
        <input type="hidden" value="{{$dessert_name = $m->name}}">
        @endif
        @if($m->quantity_sell > $quantity_dessert )
            <input type="hidden" value="{{$quantity_dessert = $m->quantity_sell }}">
            <input type="hidden" value="{{$quantity_name_dessert = $m->name }}">
        @endif
    @endforeach
    @endif
                    <h3>top rated products from each category</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><ul>Fast Food
        <li>{{$fast_food}}</li>
        <li>{{$fast}}</li>
    </ul>
    <ul>Main Dish
        <li>{{$main_food}}</li>
        <li>{{$main}}</li>
    </ul>
    <ul>Drinks
        <li>{{$drink_name}}</li>
        <li>{{$drink}}</li>
    </ul>
    <ul>Desserts
        <li>{{$dessert_name}}</li>
        <li>{{$dessert}}</li>
    </ul></p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                    <h3>Number of products added so far</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p>{{$num}}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                    <h3>The products of which the largest quantity of each category has been sold</h3>
                    <span class="fa fa-minus"></span>
        </div>
        <div class="card-body active">
            <p><ul>Fast Food
        <li>{{$quantity_name}}</li>
        <li>{{$quantity}}</li>
    </ul>
    <ul>Main Food
        <li>{{$quantity_name_main}}</li>
        <li>{{$quantity_main}}</li>
    </ul>
    <ul>Drinks
        <li>{{$quantity_name_drink}}</li>
        <li>{{$quantity_drink}}</li>
    </ul>
    <ul>Desserts
        <li>{{$quantity_name_dessert}}</li>
        <li>{{$quantity_dessert}}</li>
    </ul></p>
        </div>
    </div>
    </div>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
	$(document).ready(function(){
	$(".card-header").click(function(){
       // self clicking close
    if($(this).next(".card-body").hasClass("active")){
        $(this).next(".card-body").removeClass("active").slideUp()
        $(this).children("span").removeClass("fa-minus").addClass("fa-plus")	
        }
        else{
	$(".card .card-body").removeClass("active").slideUp()
	$(".card .card-header span").removeClass("fa-minus").addClass("fa-plus");
    $(this).next(".card-body").addClass("active").slideDown()
        $(this).children("span").removeClass("fa-plus").addClass("fa-minus")
    }
	})
	})

</script>
    

</body>
</html>
