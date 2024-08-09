<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{url('css/style.css')}}">
    </head>
    <body>
        <div>
            <div class="hello">
            <div class="image">
                    <img src={{url("photos/home-img-2.png")}} alt="">
            </div>
            @if (Route::has('login'))
                <div class="dash">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="reg_and_log">Dashboard</a>
                    @else
                        <div><a href="{{url('auth/google')}}" class="reg_and_log google"><strong>
                        Sign in with Google</strong></a></div>
                        <div class="one">
                        <a href="{{ route('login') }}" class="reg_and_log">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="reg_and_log">Register</a>
                        </div>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
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
    </body>
</html>
