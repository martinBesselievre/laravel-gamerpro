<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GamerHorizon') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/gamerhorizon.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Khand:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body onLoad='onLoadTasks()'>
    <div id="app">
        <!-- Header -->
        <header>
            <nav role='navigation' class='nav-bar'>
                <div class="brand">
                    <a href="/">
                        <i class="fas fa-gamepad"></i>Gamer<span class='brand-right'>Horizon</span> 
                    </a>
                </div>
                <div class="navbar-items">
                    <!-- Authentication Links -->
                    @guest
                    <div class="nav-item">
                        <a href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                     </div> 
                     <div class="nav-item">
                         <a href="{{ route('register') }}">
                             {{ __('Register') }}
                         </a>
                     </div>
                     @else
                     @if (Session::has('cart'))
                     <div class="nav-item cart">
                         <a href="{{ route('cart.show') }}" class="nav-link white">
                             <i class="fas fa-shopping-cart"></i>
                         </a>
                         <div class="in-cart">
                             {{ $cart->count() }}
                         </div>
                     </div>
                     @endif
                     <div class="nav-item dropdown">
                         <input type="checkbox" id="checkbox_toggle">
                         <label for="checkbox_toggle">
                             {{Auth::user()->name}} <i class="fas fa-caret-down"></i>
                         </label>
                         <div class="logout-dropdown">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: block;">
                                {{ csrf_field() }}
                                <input type='submit' value='{{ __('Logout') }}'></input>
                            </form>
                         </div>
                     </div>
                     @endguest

                </div>
                <div class="toggle-menu">
                    <label for="menu-toggle"><i class="fas fa-bars"></i></label>
                    <input type="checkbox" id="menu-toggle"/>
                </div>
            </nav>
        </header>
        <div class="row message">
           @if (Session::has('message')) 
           <div class="col-9 {{session('alert')}}">
               {{ session('message') }}
           </div>
           @endisset 
        </div>
        <!-- Content --!> 
        <main class="main">
            @yield('content')
        </main>
        <!-- Footer --!>
        <footer>
            <div class="footer-icons">
                <i class="fab fa-twitter"></i>
                <i class="fab fa-facebook-f"></i>
            </div>
        </footer>
    </div>
</body>
</html>
