@extends('layouts.base')

@section('title', __('showcase.title'))

@section('showcase_nav')
<a href="{{ url('/showcase') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('showcase.showcase_nav') }}</a>
@endsection

@section('content')

<div style="--overlay-color: #ff9292;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('showcase.showcase_heading') }}</h2>
        {{ __('showcase.showcase_message') }}
    </div>
    <img class="sticker" title="Kenny's BRILLIANT Matlab animation" alt="Kenny's Matlab animation" src="{{ asset('images/kenny-matlab.gif') }}">
</div>
<br>


<div style="--overlay-color: #fcb5dc;" class="box">
  <h2 class="text-3xl">{{ __('showcase.world_is_mine_heading') }}</h2>
  <iframe width="826" height="693" src="https://www.youtube.com/embed/KW6xktv2mz8" title="World is Mine Orchestra with WVSloids" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<br>

@php
    $pastelColors = ['#aae5e0', '#fcf8a8', '#ffb3b3', '#ff9292', '#b6d3fc'];
    $colorIndex = 0;
@endphp

@foreach($showcaseItems as $item)
    @php
        $currentColor = $pastelColors[$colorIndex];
        $colorIndex = ($colorIndex + 1) % count($pastelColors);
    @endphp
    <div style="--overlay-color: {{ $currentColor }};" class="box" >
        <h3 class="text-3xl font-bold">{{ $item->title }}</h3>
        <h3 class="text-xl font-bold">By {{ $item->name }}</h3>
        <p class="mt-2">{{ $item->description }}</p>
        <p class="mt-2 text-sm">Posted on {{ $item->created_at }}</p>
        @foreach($item->works as $work)
            @if (str_contains($work->file_path, 'jpeg') || str_contains($work->file_path, 'png') || str_contains($work->file_path, 'jpg') || str_contains($work->file_path, 'gif') || str_contains($work->file_path, 'svg'))
                <img src="{{ asset('storage/' . $work->file_path) }}" alt="{{ $item->title }}" class="w-full h-auto mt-2">
            @elseif (str_contains($work->file_path, 'mp3') || str_contains($work->file_path, 'mp4'))
                <audio controls class="w-full">
                    <source src="{{ asset('storage/' . $work->file_path) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            @endif
        @endforeach
    </div>
    <br>
@endforeach

@endsection