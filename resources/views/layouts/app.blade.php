<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Link esterni -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="@yield('ext-cdn')">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .wrapper,
            .row:not(.not){
                height: 100%;
                width: 100%;
            }
            .container,
            .container-fluid{
                width: 100%;
            }
            /*ScrollBar*/
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }
            ::-webkit-scrollbar {
                width: 10px;
                background-color: #F5F5F5;
            }
            ::-webkit-scrollbar-thumb {

                background-color: #0ae;
                background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(.5, rgba(255, 255, 255, .2)), color-stop(.5, transparent), to(transparent));
            }
            /*Stile Aggiuntivo*/
            @yield('style')
        </style>
    </head>
    <body class="alert-primary overflow-hidden">
        <div id="app" class="d-flex" style="height:100vh;width:100vw">

            @include('admin.partials.aside')

            <main class="w-100" style="height: 100vh;">
                <nav style="top:0;z-index:99" class="position-fixed w-100 navbar navbar-expand-md navbar-light bg-white shadow">
                    <div class="container-fluid">
                        @guest
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Home
                            </a>
                        @endguest
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    <!-- Lato SX Navbar -->
                        <!-- Guest -->
                        @guest
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                <!-- Authentication Links -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endguest
                    <!-- Auth-->
                        @auth
                            <div class="d-flex justify-content-between align-items-center" style="width: calc(100% - 15vw)">
                                <!-- Left Side Of Navbar -->
                                <div>
                                    <input type="text" name="search" id="search" placeholder="Cerca"/>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav">
                                    <li>
                                        <a href="" class="btn">
                                            <i class="fa-solid fa-bell"></i>
                                            Notifiche
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </nav>
            <!-- Main -->
                <div class="wrapper overflow-auto py-5">
                    @if (session('status'))
                            <div class="container-fluid">
                                <div class="alert alert-success my-5 mx-auto col-9">
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif

                    @if ($errors->any())
                            <div class="alert alert-danger my-5 mx-auto col-9">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
