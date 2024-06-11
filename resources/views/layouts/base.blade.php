<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags and other head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ViteでコンパイルしたCSSとJSファイルを読み込む -->
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/navbar.js'])

    <!-- Title -->
    <title>@yield('title')</title>
</head>

<body>
    <!-- Navbar -->
    <nav id="navbar">
        <a href="{{ url('/about') }}" id="navbar-logo"><img src="{{ asset('images/logo.webp') }}" alt="WVS Logo"></a>
        <ul class="nav-list">
            <li class="nav-list-item">
                @section('about_nav')
                <a href="{{ url('/about') }}" class="nav-link">{{ __('nav.about') }}</a>
                @show
            </li>
            <li class="nav-list-item">
                @section('events_nav')
                <a href="{{ url('/events') }}" class="nav-link">{{ __('nav.events') }}</a>
                @show
            </li>
            <li class="nav-list-item">
                @section('contact_nav')
                <a href="{{ url('/contact') }}" class="nav-link">{{ __('nav.contact') }}</a>
                @show
            </li>
            <li class="nav-list-item">
                @section('showcase_nav')
                <a href="{{ url('/showcase') }}" class="nav-link">{{ __('nav.showcase') }}</a>
                @show
            </li>
            <li class="nav-list-item">
                <a href="{{ route('login') }}" class="nav-link"> {{ __('nav.login') }} </>
            </li>
            <li class="nav-list-item">
                <a href="{{ route('register') }}" class="nav-link"> {{ __('nav.register') }} </>
            </li>
            <li class="nav-list-item">
                <!-- 言語切り替えボタン -->
                <span>{{ __('nav.language') }}</span>
                <a href="{{ route('change_language', ['locale' => 'en']) }}">EN</a> /
                <a href="{{ route('change_language', ['locale' => 'ja']) }}">JA</a>
            </li>
        </ul>
        
        | <br> <h1>{{ __('messages.welcome') }}</h1> <br>
        
    </nav>

    <!-- Content -->
    <div id="content">
        @yield('content')
    </div>
    <br>

    <!-- Scripts -->
</body>

</html>
