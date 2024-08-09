<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <style>
        #check{
    display: none;
}
.switch{
    width:100%;
    height: 100%;
    background-color: gray ;
    border-radius: 0.6rem;
    cursor: pointer;
    position: relative;
}
.switch::before{
    position: absolute;
    content: '';
    background-color:#fff;
    width: 15px;
    height: 15px;
    border-radius: 60px;
    margin: 4px;
    transition: 0.2s;
}
#check:checked + .switch{
    background-color: #2a2185;
}
#check:checked + .switch::before{
    transform: translateX(35px);
}
    </style>
    <title>Responsive Dashboard</title>
</head>
<body>
    <div class="container">
            <aside>
                <div class="toggle">
                    <div class="close" id="close-btn">
                        <span class="material-icons-sharp">close</span>
                    </div>
                </div>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="{{url('Admin-home')}}">
                            <span class="icon">
                                <ion-icon name="logo-apple"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('products')}}">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Products</span>
                        </a>
                    </li>
    
                    <li>
                        <a href="{{url('users')}}">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admins')}}">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Admins</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('messages')}}">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Messages</span>
                        </a>
                    </li>
    
                    <li>
                        <a href="{{url('order')}}">
                            <span class="icon">
                                <ion-icon name="help-outline"></ion-icon>
                            </span>
                            <span class="title">Orders</span>
                        </a>
                    </li>
    
                    <li>
                        <a href="{{url('profits')}}">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="title">Reports</span>
                        </a>
                    </li>
    
                    <li>
                        <a href="{{url('Meals')}}">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <span class="title">More</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
            <main>
                <h1>Analytics</h1>
                <div class="analyse">
                    
                    <div class="sales">
                        <div class="status">
                        @if(count($pending) > 0)
                            <div class="info">
                                <h3>Orders Pending</h3>
                                <h1>{{count($pending)}}</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+81%</p>
                                </div>
                            </div>
                        @else
                        <div class="info">
                                <h3>Orders Pending</h3>
                                <h1>0.0</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>0%</p>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="visits">
                        <div class="status">
                        @if(count($users) > 0)
                            <div class="info">
                                <h3>Num Users </h3>
                                <h1>{{count($users)}}</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>-48%</p>
                                </div>
                            </div>
                        @else 
                        <div class="info">
                                <h3>Num Users </h3>
                                <h1>0.0</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>0%</p>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                        @if(count($menu) > 0)
                            <div class="info">
                                <h3>Num Product </h3>
                                <h1>{{count($menu)}}</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>+21%</p>
                                </div>
                            </div>
                        @else 
                        <div class="info">
                                <h3>Num Product </h3>
                                <h1>0.0</h1>
                            </div>
                            <div class="progresss">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="percentage">
                                    <p>0%</p>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="new-users">
                    <h2>Employees</h2>
                    <div class="user-list">
                    @if(count($employees) > 0)
                        @foreach($employees as $employee)
                        <div class="user">
                            <img src="images/{{$employee['img']}}" alt="">
                            <h2>{{$employee['name']}}</h2>
                            <p>{{$employee['role']}}</p>
                        </div>
                        @endforeach
                    @else
                    <div class="user">
                            <img src="photos/pic-1.png" alt="">
                            <h2>Jack</h2>
                            <p>54 Min Ago</p>
                        </div>
                        <div class="user">
                            <img src="photos/pic-2.png" alt="">
                            <h2>Dana</h2>
                            <p>23 Min Ago</p>
                        </div>
                        <div class="user">
                            <img src="photos/pic-3.png" alt="">
                            <h2>Gourje</h2>
                            <p>35 Min Ago</p>
                        </div>
                        <div class="user">
                            <img src="photos/pic-4.png" alt="">
                            <h2>hala</h2>
                            <p>40 Min Ago</p>
                        </div>
                    @endif
                    </div>
                </div>
                <div class="recent-orders">
                    <h2>Recent Orders</h2>
                    @if(count($orders) > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Name </th>
                                <th>Total Price</th>
                                <th>Method Payment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($orders as $order)
                        <tbody>
                            <tr>
                                <td>{{$order['name']}}</td>
                                <td>{{$order['total_price']}}</td>
                                <td>{{$order['method']}}</td>
                                <td class="yellow">Pending</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <a href="{{url('order')}}">Show All</a>
                    @else
                        There are no orders yet
                    @endif
                </div>
            </main>
            <div class="right-section">
                <div class="nav">
                <div class="reminders" id="notification">
                    <div class="header">
                        <span class="material-icons-sharp">notifications_none</span>
                    </div>
                </div>
                    <p id="notification" class="material-icons-sharp"></p>
                    <div class="details">
                        <p class="notification_num">num of notification : {{Auth()->user()->unreadNotifications->count()}}</p>
                        <a href="{{url('MarkAsRead_all')}}">set read all</a>
                        <p class="notification_details">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        - {{$notification->data['title']}} By {{$notification->data['user']}} {{$notification->created_at}}
                        </br></br>
                        @endforeach
                        </p>
                    </div>
                    <button id="menu-btn">
                        <span class="material-icons-sharp">menu</span>
                    </button>
                    @include('Admin/light_dark')
                </div>
                <div class="user-profile">
                    <div class="logo">
                        <img src="photos/map-icon.png">
                        <h2>Ne3am Deeb</h2>
                        <p>Fullstack Developer</p>
                    </div>
                </div>
                <div class="reminders">
                    <div class="header">
                        <h2>Notifications</h2>
                        <span class="material-icons-sharp">notifications_none</span>
                    </div>
                    <div class="notification">
                        <div class="icon">
                            <span class="material-icons-sharp">volume_up</span>        
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Workshop</h3>
                                <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span class="material-icons-sharp">more_vert</span>
                        </div>
                    </div>
                    <div class="notification add-reminder">
                        <div >
                                <span class="material-icons-sharp">add</span>
                                <a href="{{url('sendmail')}}"><h3 class="add">Send Offers</h3></a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
    <script src="js/script.js"></script>
    <script>
        let details  = document.querySelector('.nav .details');

        document.querySelector('#notification').onclick = () =>{
            details.classList.toggle('active');
    }

    window.onscroll = () =>{
        details.classList.remove('active');
    }
    // setInterval(() => {
        
    //     document.getElementById('notification_count').reload(window.location.href +"#notification_count");
    //     document.getElementById('unreadNotifications').reload(window.location.href +"#unreadNotifications");
    //     console.log('hello');
    // },5000 );
    </script>
</body>
</html>