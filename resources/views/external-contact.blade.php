@extends('layouts.base')

@section('title', __('external-contact.title'))

@section('contact_nav')
<a href="{{ url('/external-contact') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('external-contact.contact_nav') }}</a>
@endsection

@section('content')
<div style="--overlay-color:#9bcbbf;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('external-contact.contact_us') }}</h2>
        {!! __('external-contact.contact_message') !!}
    </div>

    <img class="sticker" src="{{ asset('images/hello.png') }}">
</div>
<br>
@endsection
