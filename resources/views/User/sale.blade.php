<!-- <!DOCTYPE html>
<html>
<head>
    <title>صفحة الإعلانات والحسومات</title>
    <style>
        /* قم بتعديل التنسيق حسب الاحتياجات */
        .advertisement {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }
        .advertisement h2 {
            color: #333;
        }
        .advertisement p {
            color: #666;
        }
        .advertisement .discount {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="advertisements-container">
        
    </div>

    <script>
        // قم بتعريف البيانات الخاصة بالإعلانات
        var advertisements = [
            {
                title: "عرض خاص!",
                description: "احصل على خصم 20% على جميع الوجبات",
                discount: true
            },
            {
                title: "توصيل مجاني!",
                description: "توصيل مجاني على الطلبات التي تزيد عن 100 دولار",
                discount: false
            },
            {
                title: "عرض الغداء",
                description: "وجبة غداء بسعر 10 دولارات فقط",
                discount: true
            }
        ];

        // قم بإنشاء عناصر الإعلانات وإضافتها إلى الصفحة
        var advertisementsContainer = document.getElementById("advertisements-container");

        advertisements.forEach(function(advertisement) {
            var adElement = document.createElement("div");
            adElement.classList.add("advertisement");

            var titleElement = document.createElement("h2");
            titleElement.textContent = advertisement.title;
            adElement.appendChild(titleElement);

            var descriptionElement = document.createElement("p");
            descriptionElement.textContent = advertisement.description;
            adElement.appendChild(descriptionElement);

            if (advertisement.discount) {
                var discountElement = document.createElement("p");
                discountElement.classList.add("discount");
                discountElement.textContent = "تخفيض!";
                adElement.appendChild(discountElement);
            }

            advertisementsContainer.appendChild(adElement);
        });
    </script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Discount</title>
</head>
<body>
<header>
        <nav>
        <a href="{{url('/dashboard')}}" class="logo">yum-yum 😋</a>
            <a href="{{url('/dashboard')}}">Home</a>
            <a href="{{url('about')}}">About</a>
            <a href="{{url('menu')}}">Menu</a>
            <a href="{{route('sale.create')}}">Sales </a>
            <a href="{{url('orders')}}">Orders</a>
            <a href="{{url('contuct')}}">Contant us</a>
            <span></span>
            <div class="icons">
            <a href="{{url('search_product')}}"><i class="fas fa-search"></i></a>
                            <a href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i></a>
                            <a><div id="user-btn"><div>  {{ Auth::user()->name }} </div></div></a>
                            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
                        </div>
        </nav>
    </header>
    <div class="detail">
                        <p class="notification_num">num of notification : {{Auth()->user()->unreadNotifications->count()}}</p>
                        <a href="{{url('MarkAsRead_all')}}">set read all</a>
                        <p class="notification_details">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        - {{$notification->data['title']}} By {{$notification->data['user']}} {{$notification->created_at}}
                        </br></br>
                        @endforeach
                        </p>
    </div>
        <section class="products">
        @if(count($sales) > 0)
        <div class="box-container">
        @foreach($sales as $sale)
        <div  class="box">
                <p>Discount => <span>{{$sale['sale']}} % </span></br>on => <span>{{$sale['products']}}</span></p>
                <p>The sale finall => <span>{{$sale['finall_date']}}</span> </p>
        </div>
        @endforeach
        @else
        No sales yet
        @endif
    </section>
    <script>
        let details  = document.querySelector('.detail');

        document.querySelector('#notification').onclick = () =>{
            details.classList.toggle('active');
    }

    window.onscroll = () =>{
        details.classList.remove('active');
    }
    </script>
</body>
</html>