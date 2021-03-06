<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <script language="JavaScript" type="text/JavaScript">
            function ShowLength( str ) {
            str=str.replace(/\n/g, ""); 
            document.getElementById("inputlength").innerHTML = "入力文字数"+ str.length ;
            }
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/user.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header>
                {{-- 画面上部に表示するナビゲーションバーです。 --}}
                <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img src="{{asset('images/logo.png')}}" alt="写真" width="71" height="40">
                            {{ config('app.name', 'Family') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
    
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">

                            <!-- Authentication Links -->
                            {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                                </li>
                                @endif
                            {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                </nav>
            </header>
            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
            <footer>
                <p class="copyright">(C) 2022 Takahashi</p>
            </footer>
        </div>
    </body>
</html>