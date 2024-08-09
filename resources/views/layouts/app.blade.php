<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="swiper-bundle.min.css" />
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="{{url('css/style.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>
    @if(Auth::user()->role == "user")
        <div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
            {{ $slot }}
            </main>
        </div>
        <section class="footer">
        <section class="grid">
            <div class="box">
                <img src="photos/email-icon.png" alt="">
                <h3>our email</h3>
                <a href="#">sara@gmail.com</a>
            </div>
            <div class="box">
                <img src="photos/clock-icon.png" alt="">
                <h3>opening hours</h3>
                <p>00:07am to 00:10pm</p>
            </div>
            <div class="box">
                <img src="photos/map-icon.png" alt="">
                <h3>our address</h3>
                <a href="#">syria , lattakia , zera3a street</a>
            </div>
            <div class="box">
                <img src="photos/phone-icon.png" alt="">
                <h3>our number</h3>
                <a href="#">123-456-7890</a>
                <a href="#">111-222-3333</a>
            </div>
        </section>
    </section>
    @endif
    <!--  @if(Auth::user()->role == "admin")
                <script>
                    location.assign("{{url('Admin-home')}}");
                </script>
        <a href="{{url('Admin-home')}}" class="admin_home">
            <img src="photos/logo.png" alt="" class="image_1"/>
            <p class="para_1">Click here to go to home admin please</p>
        </a>
        @include('Admin.home');
                
    @endif 
    @if(Auth::user()->role == "delivery")
                <script>
                    location.assign("{{url('delivery')}}");
                </script>
    @endif -->
    </body>
</html>
