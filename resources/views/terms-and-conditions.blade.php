@extends('layouts.base')

@section('title', __('terms-and-conditions.title'))

@section('terms-and-conditions_nav')
<a href="{{ url('/terms-and-conditions') }}" style="text-shadow:0px 0px 1px black;" class="nav-link">{{ __('nav.terms-and-conditions') }}</a>
@endsection

@section('content')
<div style="--overlay-color: #aae5e0;" class="sticker-box">
    <div class="box-info">
        <h2>{{ __('terms-and-conditions.title') }}</h2>
        <p>{{ __('terms-and-conditions.intro') }}</p>
        <ol>
            <li>{{ __('terms-and-conditions.item1') }}</li>
            <li>{{ __('terms-and-conditions.item2') }}</li>
            <li>{{ __('terms-and-conditions.item3') }}</li>
        </ol>
        <p>{{ __('terms-and-conditions.additional_info') }}</p>
        <p>{{ __('terms-and-conditions.contact_info') }}</p>
    </div>
</div>
<br>
@endsection
