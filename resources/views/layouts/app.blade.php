<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>
    <div id="app">
      <div class="menu">

      	<!-- Search -->
      	<div class="menu_search">
      		<form action="#" id="menu_search_form" class="menu_search_form">
      			<input type="text" class="search_input" placeholder="Search Item" required="required">
      			<button class="menu_search_button">
              <img src="images/search.png" alt="">
            </button>
      		</form>
      	</div>
      	<!-- Navigation -->
      	<div class="menu_nav">
      		<ul>
      			<li><a href="#">Women</a></li>
      			<li><a href="#">Men</a></li>
      			<li><a href="#">Kids</a></li>
      			<li><a href="#">Home Deco</a></li>
      			<li><a href="#">Contact</a></li>
            @guest
                <li>
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                {{-- <li class="nav-item dropdown"> --}}
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    {{-- </div> --}}
                {{-- </li> --}}
            @endguest
      		</ul>
      	</div>
      	<!-- Contact Info -->
      	<div class="menu_contact">
      		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
      			<div><div><img src="images/phone.svg" alt="https://www.flaticon.com/authors/freepik"></div></div>
      			<div>+1 912-252-7350</div>
      		</div>
      		<div class="menu_social">
      			<ul class="menu_social_list d-flex flex-row align-items-start justify-content-start">
      				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
      				<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
      				<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
      				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
      			</ul>
      		</div>
      	</div>
      </div>
        <!-- @{{ message }} -->
        {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    Ecommerce Master
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                          <a href="{{url('/carrito')}}" class="nav-link">
                            Mi Carrito  <span class="circle-shopping-cart">{{ $productsCount }}</span>
                          </a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <header class="header">
          <div class="header_overlay"></div>
          <div class="header_content d-flex flex-row align-items-center justify-content-start">
            <div class="logo">
              <a href="{{ url('/') }}">
                <div class="d-flex flex-row align-items-center justify-content-start">
                  <div><img src="images/logo_1.png" alt=""></div>
                  <div>Ecommerce - Little Closet</div>
                </div>
              </a>
            </div>
            <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
            <nav class="main_nav">
              <ul class="d-flex flex-row align-items-start justify-content-start">
                <li class="active"><a href="#">Women</a></li>
                <li><a href="#">Men</a></li>
                <li><a href="#">Kids</a></li>
                <li><a href="#">Home Deco</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </nav>
            <div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
              <!-- Search -->
              <div class="header_search">
                <form action="#" id="header_search_form">
                  <input type="text" class="search_input" placeholder="Buscar Producto" required="required">
                  <button class="header_search_button"><img src="images/search.png" alt=""></button>
                </form>
              </div>
              <!-- User -->
               @guest
               @else
                 <div class="user"><a href="user.html"><div><img class="svg" src="images/user.svg" alt="https://www.flaticon.com/authors/freepik"><div>{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div></div></a></div>
               @endguest
              <div class="user"><a href="cart.html"><div><img class="svg" src="images/cart.svg" alt="https://www.flaticon.com/authors/freepik"><div>{{ $productsCount }}</div></div></a></div>
              <!-- Cart -->
              {{-- <div class="cart"><a href="cart.html"><div><img class="svg" src="images/cart.svg" alt="https://www.flaticon.com/authors/freepik"></div></a></div> --}}
              <!-- Phone -->
              <div class="header_phone d-flex flex-row align-items-center justify-content-start">
                <div><div><img src="images/phone.svg" alt="https://www.flaticon.com/authors/freepik"></div></div>
                <div>+1 912-252-7350</div>
              </div>
            </div>
          </div>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    {{-- <script src="{{ url('/js/jquery-3.3.1.min.js') }}" ></script> --}}
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="js/jquery-3.2.1.min.js"></script> --}}
    <script src="styles/bootstrap-4.1.2/popper.js"></script>
    <script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
    <script src="plugins/greensock/TweenMax.min.js"></script>
    <script src="plugins/greensock/TimelineMax.min.js"></script>
    <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="plugins/greensock/animation.gsap.min.js"></script>
    <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/progressbar/progressbar.min.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ url('/js/app.js') }}"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
</body>
</html>
