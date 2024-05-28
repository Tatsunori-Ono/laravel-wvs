<!DOCTYPE html>
<html lang="en">

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
          <a href="{{ url('/about') }}" class="nav-link">ABOUT</a>
          @show
        </li>
        <li class="nav-list-item">
          @section('events_nav')
          <a href="{{ url('/events') }}" class="nav-link">EVENTS</a>
          @show
        </li>
        <li class="nav-list-item">
          @section('contact_nav')
          <a href="{{ url('/contact') }}" class="nav-link">CONTACT</a>
          @show
        </li>
        <li class="nav-list-item">
          @section('showcase_nav')
          <a href="{{ url('/showcase') }}" class="nav-link">SHOWCASE</a>
          @show
        </li>
      </ul>
  </nav>

  <!-- Content -->
  <div id="content">
    @yield('content')
  </div>
  <br>

  <!-- Scripts -->
</body>

</html>
