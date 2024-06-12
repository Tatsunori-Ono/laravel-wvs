<!-- resources/views/privacy_policy.blade.php -->

@extends('layouts.base')

@section('title', __('privacy-policy.title'))

@section('privacy-policy_nav')
<a href="{{ url('/privacy-policy') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('nav.privacy-policy') }}</a>
@endsection

@section('content')
<div style="--overlay-color: #aae5e0;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('privacy-policy.title') }}</h2>
        <p>{{ __('privacy-policy.intro') }}</p>
        <ol>
            <li>{{ __('privacy-policy.item1') }}</li>
            <li>{{ __('privacy-policy.item2') }}</li>
            <li>{{ __('privacy-policy.item3') }}</li>
        </ol>
        <p>{{ __('privacy-policy.additional_info') }}</p>
        <p>{{ __('privacy-policy.contact_info') }}</p>
    </div>
</div>
<br>
@endsection
