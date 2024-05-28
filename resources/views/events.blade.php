@extends('layouts.base')

@section('title', 'Events')

@section('events_nav')
<a href="{{ url('/events') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">EVENTS</a>
@endsection

@section('content')
<div style="--overlay-color: #b6d3fc;" class="box">
    <h2> Timetable</h2>
    <p>A timetable of all the events we're hosting this term.</p>
    <img src="{{ asset('images/timetable.webp') }}">
</div>

<br>
<div style="--overlay-color: #fcb5dc" class="box">
    <h2> Upcoming Events </h2>
    <p>Find more detailed information about our upcoming events via our <a href="https://www.instagram.com/warwick_vocaloid/">instagram</a>.</p>
    <iframe id="instagram-iframe" src="https://www.instagram.com/warwick_vocaloid/embed" allowfullscreen scrolling="no"></iframe>
    <script src="https://www.instagram.com/embed.js"></script>
</div>
@endsection
