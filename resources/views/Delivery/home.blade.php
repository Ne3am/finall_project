<link rel="stylesheet" href="{{url('css/stylesh.css')}}">
<header>
        <nav>
        <a href="{{url('delivery')}}">Profile</a>
            <a href="{{url('active')}}"> Active</a>
            <a href="{{url('completed')}}"> Completed</a>
            <a href="{{url('pending')}}"> Pending</a>
            
        </nav>
    </header>
<section class="user-details">
        <form class="user">
            <div class="image-content">
            <div>
            <img src="{{url('photos/pic-3.png')}}" alt="">
            </div>
            </div>
            <p><i class="fas fa-user"></i><span>{{Auth::user()->name}}</span></p>
            <p><i class="fas fa-phone"></i><span>0{{Auth::user()->number}}</span></p>
            <p><i class="fas fa-envelope"></i><span>{{Auth::user()->email}}</span></p>
            <a class="btn" href=""><i class="fas fa-map-marker-alt"></i><span>
                Lattajia/Basil/5/4</span></a>
        </form>
    </section>