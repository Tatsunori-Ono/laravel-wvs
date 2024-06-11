@extends('layouts.base')

@section('title', __('events.title'))

@section('events_nav')
<a href="{{ url('/events') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('events.events_nav') }}</a>
@endsection

@section('content')
<div style="--overlay-color: #b6d3fc;" class="box">
    <h2>{{ __('events.timetable') }}</h2>
    <p>{{ __('events.timetable_message') }}</p>
    <img alt="Timetable for Warwick Vocaloid Society" src="{{ asset('images/timetable.webp') }}">
</div>

<br>
<div style="--overlay-color: #fcb5dc" class="box">
    <h2>{{ __('events.upcoming_events') }}</h2>
    <p>{!! __('events.upcoming_events_message') !!}</p>
    <iframe id="instagram-iframe" src="https://www.instagram.com/warwick_vocaloid/embed" allowfullscreen scrolling="no"></iframe>
    <script src="https://www.instagram.com/embed.js"></script>
</div>
@endsection
