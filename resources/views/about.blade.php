@extends('layouts.base')

@section('title', __('about.title'))

@section('about_nav')
<a href="{{ url('/about') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('about.about_nav') }}</a>
@endsection

@section('content')
<div style="--overlay-color: #aae5e0;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('about.welcome') }}</h2>
        <p>
            {!! __('about.welcome_message') !!}
        </p>
        <p>
            {!! __('about.communications') !!}
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/everyone.png') }}">
</div>
<br>

<div style="--overlay-color: #fcf8a8;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('about.socials') }}</h2>
        <p>
            {!! __('about.socials_message') !!}
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/social.png') }}">
</div>
<br>

<div style="--overlay-color: #ffb3b3;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('about.tutorials_projects') }}</h2>

        <p>
            {!! __('about.tutorials_projects_message') !!}
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/luka.png') }}">
</div>
<br>
@endsection
