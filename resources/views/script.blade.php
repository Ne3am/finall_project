        @push('js')
    <script src="{{url('js/swiper-bundle.min.js')}}"></script>
    <script src="{{url('js/script.js')}}"></script>
    
    <script>
    var swiper = new Swiper(".home-slider", {
    loop:true,
    grabCursor:true,
    effect: "flip",
    pagination: {
        el: ".swiper-pagination",
        clickable:true,
    },
    });

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


    let navbar = document.querySelector('.head .header_flex .navbar');
    let profile = document.querySelector('.profile');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

function loader(){
    document.querySelector('.loader').style.display = 'none';
}

function fadeOut(){
    setInterval(loader, 2000);
}

window.onload = fadeOut;
</script>
@endpush