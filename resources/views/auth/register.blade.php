<x-guest-layout>
<link rel="stylesheet" href="{{url('css/style.css')}}">
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
    <section class="register">
        <div class="box">
            <div class="container">
                <div class="box1 form-box">
                    <header>REGISTER NOW</header>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="field input">
            <label for="name">Username</label>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="field input" >
            <label for="email">Email</label>
            <x-text-input id="email"  type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')"  />
        </div>

        <!-- Email Address -->
        <div class="field input">
            <label for="number">Number</label>
            <x-text-input id="number" type="number" name="number" :value="old('number')" required autocomplete="number" />
            <x-input-error :messages="$errors->get('number')"  />
        </div>
            <!-- Email Address -->
            <!-- <div class="field input" >
            <label for="role">Role</label>
            <x-text-input id="role" type="role" name="role" :value="old('role')" required autocomplete="role" />
            <x-input-error :messages="$errors->get('role')"/>
        </div> -->
        <!-- Password -->
        <div class="field input">
            
            <label for="password">Password</label>
            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="field input" >
            <label for="password_confirmation">Confirm Password</label>
            <x-text-input id="password_confirmation" 
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')"  />
        </div>
        <div >
            <a  href="{{ route('login') }}" class="links">
                {{ __('Already registered?') }}Login
            </a>
            <x-primary-button >
            
                        {{ __('Register') }}
            
            </x-primary-button>
        </div>
    </form>
                </div>
            </div>
        </div>
    </section>
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
