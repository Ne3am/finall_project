<x-guest-layout>
<link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <header>
        <nav>
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
            <a href="menu.html">Menu</a>
            <a href="orders.html">Orders</a>
            <a href="contuct.html">Contant us</a>
            <span></span>
        </nav>
    </header>
    <div class="container-login">
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="input-box">
            
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <label>Email</label>
            <x-input-error :messages="$errors->get('email')"  />
        </div>

        <!-- Password -->
        <div class="input-box">
            

            <x-text-input id="password" 
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                            <label>Password</label>
            <x-input-error :messages="$errors->get('password')"  />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <p>{{ __('Remember me') }}</p>
            </label>
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forget-pass">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button  class="btn1" >
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <a href="{{ route('register') }}">Register</a>
    </form>
</div>
    <span style="--i:0;"></span>
    <span style="--i:1;"></span>
    <span style="--i:2;"></span>
    <span style="--i:3;"></span>
    <span style="--i:4;"></span>
    <span style="--i:5;"></span>
    <span style="--i:6;"></span>
    <span style="--i:7;"></span>
    <span style="--i:8;"></span>
    <span style="--i:9;"></span>
    <span style="--i:10;"></span>
    <span style="--i:11;"></span>
    <span style="--i:12;"></span>
    <span style="--i:13;"></span>
    <span style="--i:14;"></span>
    <span style="--i:15;"></span>
    <span style="--i:16;"></span>
    <span style="--i:17;"></span>
    <span style="--i:18;"></span>
    <span style="--i:19;"></span>
    <span style="--i:20;"></span>
    <span style="--i:21;"></span>
    <span style="--i:22;"></span>
    <span style="--i:23;"></span>
    <span style="--i:24;"></span>
    <span style="--i:25;"></span>
    <span style="--i:26;"></span>
    <span style="--i:27;"></span>
    <span style="--i:28;"></span>
    <span style="--i:29;"></span>
    <span style="--i:30;"></span>
    <span style="--i:31;"></span>
    <span style="--i:32;"></span>
    <span style="--i:33;"></span>
    <span style="--i:34;"></span>
    <span style="--i:35;"></span>
    <span style="--i:36;"></span>
    <span style="--i:37;"></span>
    <span style="--i:38;"></span>
    <span style="--i:39;"></span>
    <span style="--i:40;"></span>
    <span style="--i:41;"></span>
    <span style="--i:42;"></span>
    <span style="--i:43;"></span>
    <span style="--i:44;"></span>
    <span style="--i:45;"></span>
    <span style="--i:46;"></span>
    <span style="--i:47;"></span>
    <span style="--i:48;"></span>
    <span style="--i:49;"></span>
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
</x-guest-layout>
