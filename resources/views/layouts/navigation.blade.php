<nav x-data="{ open: false }" >
    <!-- Primary Navigation Menu -->
    <header>
    <div >
        <div >
        <nav>
            <a href="{{url('/dashboard')}}" class="logo">yam yam 😋</a>
            <a href="{{url('/dashboard')}}">Home</a>
            <a href="{{url('about')}}">About</a>
            <a href="{{url('menu')}}">Menu</a>
            <a href="{{route('sale.create')}}">Sales </a>
            <a href="{{url('orders')}}">Orders</a>
            <a href="contuct">Contant us</a>
            <span></span>
            
            <!-- Settings Dropdown -->
            <div>
                <x-dropdown align="right" >
                    <x-slot name="trigger">
                        <button>
                        <div class="icons">
                            <a href="{{url('search_product')}}"><i class="fas fa-search"></i></a>
                            <a href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i></a>
                            <a><div id="user-btn"><div>  {{ Auth::user()->name }} </div></div></a>
                            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
                        </div>
                        
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                <div class="profile_user">
                        <x-dropdown-link :href="route('profile_user')" >
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                </div>
</x-slot>
                </x-dropdown>
            </div>

</nav>
<script>
    let profile = document.querySelector('.profile_user');
    document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
}
    </script>
