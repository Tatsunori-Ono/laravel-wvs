<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags and other head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ViteでコンパイルしたCSSとJSファイルを読み込む -->
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/css/loader.css', 'resources/js/navbar.js'])

    <!--jQuery for Loader-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Title -->
    <title>@yield('title')</title>
</head>

<body>
    <!--Loader-->
    <div class="loader-wrapper">
        <img class="image" src="/images/wvs-chan-little.png" alt="">
    </div>
    <script>
        $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
        });
    </script>

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
                @section('showcase_nav')
                <a href="{{ url('/showcase') }}" class="nav-link">{{ __('nav.showcase') }}</a>
                @show
            </li>
            <li class="nav-list-item">
                @section('contact_nav')
                <a href="{{ url('/external-contact') }}" class="nav-link">{{ __('nav.contact') }}</a>
                @show
            </li>
            @if (auth()->check())
                <li class="nav-list-item">
                    <span class="nav-link">{{ __('nav.welcome') }} {{ auth()->user()->name }}</span>
                </li>
                @if(Auth::user()->profile_photo_path)
                    <li class="nav-list-profile">
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Photo" class="h-8 w-8 rounded-full object-cover me-2 custom-img">
                    </li>
                @else
                    <li class="nav-list-profile">
                        <img src="{{ asset('images/user_icon.png') }}" alt="Default Profile Photo" class="h-8 w-8 rounded-full object-cover me-2 custom-img">
                    </li>
                @endif
                <li class="nav-list-item">
                    <a href="{{ route('dashboard') }}" class="nav-link-blue">{{ __('nav.platform') }}</a>
                </li>
                <li class="nav-list-item">
                    <a href="{{ route('logout') }}" class="nav-link-blue" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('nav.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="nav-list-item">
                    <a href="{{ route('login') }}" class="nav-link-blue">{{ __('nav.login') }}</a>
                </li>
                <li class="nav-list-item">
                    <a href="{{ route('register') }}" class="nav-link-blue">{{ __('nav.register') }}</a>
                </li>
            @endif
            <li class="nav-list-item">
                <!-- 言語切り替えボタン -->
                <span class="nav-link">{{ __('nav.language') }}</span>
                <a href="{{ route('change_language', ['locale' => 'en']) }}" class="text-blue-500">EN</a> /
                <a href="{{ route('change_language', ['locale' => 'ja']) }}" class="text-blue-500">JA</a>
            </li>
        </ul>
    </nav>

    <!-- Content -->
    <div id="content">
        @yield('content')
    </div>
    <br>

    <!-- Footer -->
    @include('layouts/footer')

    <!-- Scripts -->
</body>

</html>
