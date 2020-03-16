<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NovelToon</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Styles -->
    <!-- <style>
        body {
            background-color: #e6ffff;
        }
    </style> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel bg-primary">
              <div class="container">
                <div class="">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="navbar-brand" href="{{ url('/') }}"><i class='fa fa-home'></i>Home</a>

                    </li>
                    <li class="nav-item active">
                      <a class="navbar-brand" href="{{ url('/allnovels') }}"><i class='fa fa-book'></i> Novel</a>
                    </li>
                    <li class="nav-item active">
                      <a class="navbar-brand" href="{{ url('/mangasall') }}">Manga</a>
                    </li>
                  </ul>
                </div>
                <div class="float-right">
                  <ul class="navbar-nav ml-auto">

                    <li class="nav-item active">
                      @if (Route::has('login'))
                              @auth
                                <a class="navbar-brand" href="{{ route('mynovels') }}"><i class='fa fa-plus'></i> Novel</a>
                              @endauth
                      @endif
                    </li>

                    <li class="nav-item active  ml-auto">
                      @if (Route::has('login'))
                        @auth
                            @if( Auth::user()->admin == true)
                              <a class="navbar-brand" href="{{ route('mangasadmin') }}"><i class='fa fa-plus'></i> Manga</a>
                            @endif
                        @endauth
                      @endif
                    </li>

                    <form class="form-inline my-2 my-lg-0" action="/search" method="POST" role="search">
                      {{ csrf_field() }}
                      <input class="form-control mr-sm-2" type="text" name="q" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-light" type="submit">Search</button>

                    </form>
                      <!-- Authentication Links -->
                      @guest
                          <li class="nav-item">
                              <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                      @else

                          <li class="nav-item dropdown">

                              <a id="navbarDropdown" class="nav-link dropdown dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position:relative; padding-top:15px; padding-left:50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                <i class="text-light">{{ Auth::user()->name }} </i><i class="text-light caret"></i>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="/profile">
                                      User Profile
                                  </a>
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
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <div id="bottom-menu" style="position: fixed; bottom: 10px; right: 10px;">
        <button id="btnScrollDown" class="btn btn-primary btn-sm" onclick="scrollPage('down')"><i class="fas fa-arrow-down"></i></button>
        <button id="btnScrollUp" class="btn btn-primary btn-sm" onclick="scrollPage('up')"><i class="fas fa-arrow-up"></i></button>
        <button class="btn btn-primary btn-sm" onclick="scrollPage('top')">Top</button>

    </div>

    <script>
        function scrollPage(direction) {
            var viewportHeight = $(window).height();
            var st = $(this).scrollTop();


            if(direction === "up") {
                $('html, body').animate({scrollTop: st - (viewportHeight - 100)}, 500);
            } else if(direction === 'down') {
                $('html, body').animate({scrollTop: st + (viewportHeight - 100)}, 500);
            }else { //Top
                $('html, body').animate({scrollTop: 0}, 500);
            }
        }
    </script>
</body>
</html>
