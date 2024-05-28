@extends('layouts.base')

@section('title', 'About')

@section('about_nav')
<a href="{{ url('/about') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">ABOUT</a>
@endsection

@section('content')
<div style="--overlay-color: #aae5e0;" class="sticker-box">
    <div class="box-info">
        <h2>Welcome</h2>
        <p>
            Warwick Vocaloid Society (WVS) is Warwick's student-run society for anyone with an interest in vocaloid. The
            society is for anyone who would like to meet others who share these interests, or who just want to join us
            for one of the many events we run each academic year.
        </p>
        <p>
            Most of our society communications are made through our <a
                href="https://www.instagram.com/warwick_vocaloid/">instagram</a> or our <a
                href="https://discord.gg/NXYVdzZpr5">discord server</a>. Our discord is also a great place to meet and
            discuss vocaloid with other members of the society.
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/everyone.png') }}">
</div>
<br>

<div style="--overlay-color: #fcf8a8;" class="sticker-box">
    <div class="box-info">
        <h2>Socials</h2>
        <p>
            We regularly host social events in B2.02 (Sci Conc), starting at 19:00 every Monday during term time. With
            vocaloid in the background, they're an excellent opportunity to meet others and have fun. In addition to
            this, we also hold many other social events across the year.
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/social.png') }}">
</div>
<br>

<div style="--overlay-color: #ffb3b3;" class="sticker-box">
    <div class="box-info">
        <h2>Tutorials and Projects</h2>

        <p>
            We occasionally host tutorials for those interested in producing vocaloid themselves. We welcome all range
            of producers from beginners to experts, so please feel free join us! We also occasionally host collaborative
            and individual projects where you can implement the skills you have developed.
        </p>
    </div>

    <img class="sticker" src="{{ asset('images/luka.png') }}">
</div>
<br>
@endsection
