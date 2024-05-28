@extends('layouts.base')

@section('title', 'Showcase')

@section('showcase_nav')
<a href="{{ url('/showcase') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">SHOWCASE</a>
@endsection

@section('content')

<div style="--overlay-color: #ff9292;" class="sticker-box">
    <div class="box-info">
        <h2>Showcase</h2>

        <p>
            A showcase of amazing vocaloid-related works made by our members.
        </p>
    </div>

    <img class="sticker" title="Kenny's BRILLIANT Matlab animation" alt="Kenny's Matlab animation" src="{{ asset('images/kenny-matlab.gif') }}">
</div>
<br>

<div style="--overlay-color: #fcb5dc" class="box">
  <h2> World is Mine Orchestra with WVSloids </h2>
  <iframe width="1905" height="769" src="https://www.youtube.com/embed/KW6xktv2mz8" title="World is Mine Orchestra with WVSloids" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<br>
@endsection
