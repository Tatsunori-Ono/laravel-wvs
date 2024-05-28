@extends('layouts.base')

@section('title', 'Contact')

@section('contact_nav')
<a href="{{ url('/contact') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">CONTACT</a>
@endsection

@section('content')
<div style="--overlay-color:#9bcbbf;" class="sticker-box">
    <div class="box-info">
        <h1> Contact Us </h1>
        Send us any enquiries about the society through our email: <i>warwickvocaloid@gmail.com</i>
    </div>

    <img class="sticker" src="{{ asset('images/hello.png') }}">
</div>
<br>
@endsection
