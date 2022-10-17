<aside class="shadow {{(Route::currentRouteName() == 'login') || (Route::currentRouteName() == 'register')?'d-none':''}}" style="height: 100vh; width: 15vw;">
    <nav class="bg-white shadow-sm h-100">
        <div class="container">
            <ul class="navbar-nav ml-auto pt-2" >
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item" >
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item" >
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" style="margin-bottom:0; padding-bottom: 0" class="nav-link h5 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-circle-user"></i>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="margin-bottom:0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <hr/>
            <ul class="navbar-nav mr-auto">
                @auth
                    <li>
                        <a class="nav-link font-weight-bold" href="{{route('admin.home')}}">
                            Home Amministrazione
                        </a>
                    </li>
                    <li>
                        <a class="nav-link font-weight-bold" href="{{ url('/') }}">
                            HomePage Front
                        </a>
                    </li>
                    <li>
                        <button class="navbar-toggler px-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="text-primary font-weight-bold">Operazioni Post:</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto pl-3">
                                <li>
                                    <a href="{{route('admin.posts.index')}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Gestisci Post
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.posts.create')}}">
                                        <i class="fa-solid fa-plus"></i>
                                        Crea Post
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="">
                        <a class="nav-link font-weight-bold" href="{{route('admin.categories.index')}}">
                            Gesitisci Categorie
                        </a>
                    </li>
                    <li>
                        <a class="nav-link font-weight-bold" href="{{route('admin.tags.index')}}">
                            Gesitisci Tag
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</aside>
