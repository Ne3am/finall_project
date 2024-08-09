<x-app-layout>
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- <link rel="stylesheet" href="swiper-bundle.min.css" /> -->
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="{{url('css/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" href="{{url('css/style.css')}}">
    <section class="home">
<div class="swiper home-slider">
    <div class="swiper-wrapper">

        <div class="swiper-slide slide">
        <div class="content">
            <span>order online</span>
            <h3>delicious food</h3>
        </div>
        <!-- <div class="image">
            <img src="photos/home-img-1.png" alt="">
        </div> -->
        <div>
            <video autoplay loop muted plays-inline class="back-video">
                <source src="photos/3015488-hd_1920_1080_24fps.mp4" type="video/mp4">
            </video>
        </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>
</section>
<section class="products">
        <h1 class="title"> the dishes</h1>
        @if(count($products) > 0)
        <div class="box-container">
        @foreach($products as $product)
                <form action="" class="box" method="post">
                <a href="{{route('products.show' , ['product' => $product['id'] ] )}}" class="fas fa-eye"></a> 
                    <img src="{{$product['image']}}" alt="" class="image">
                    <a href="category.html" class="cat"></a>
                    <div class="name">{{$product['name']}}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{$product['price']}}</div>
                        <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
                    </div>
                </form>
                @endforeach
@else
<p>There are no products to display </p>

    </div>
    @endif
    </section>
    <section class="reviews Chiefs ">
        <h1 class="title">Reviews the costumers</h1>
        @if(count($comments) > 0)
        <div class="container_review swiper">
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    @foreach($comments as $comment)
                    <div class="card swiper-slide">
                        <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                        <div class="profile-details">
                        <img src="{{$comment->user->img}}"  alt="" >
                        </div>
                        </div>
                        </div>
                    <div class="card-content">
                        <h2 class="name">{{$comment->user->name}}</h2>
                        <p class="description">{{$comment['Comment']}}</p>
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
@else
<p>There are no Comments to display </p>

    @endif
        <div class="contact">
        <h1 class="title">Share Your Comment With Public </h1>
                <form action="{{route('comment.store')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea name="msg" class="comment" cols="40" rows="5" required placeholder="enter your comment please"
                maxlength="600"></textarea>
                <input type="submit" class="comment-btn" name="send" value="send my comment">
                </form>
        </div>
    </section>
    <script src="{{url('js/swiper-bundle.min.js')}}"></script>
    <script src="{{url('js/script.js')}}"></script>
    <script>

var swiper = new Swiper(".slide-container", {
slidesPerView: 3,
spaceBetween: 20,
sliderPerGroup: 3,
loop: true,
centerSlide: "true",
fade: "true",
grabCursor: "true",
pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
},
navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
},

breakpoints: {
    0: {
    slidesPerView: 1,
    },
    520: {
    slidesPerView: 2,
    },
    768: {
    slidesPerView: 3,
    },
    1000: {
    slidesPerView: 4,
    },
},
});

</script>
    @include('script')
    @stack('js')
</x-app-layout>
