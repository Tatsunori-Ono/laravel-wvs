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

<div style="--overlay-color:#F0665C;" class="box">
    <div class="box-info">
        <h2>{{ __('contact.create') }}</h2>
        {!! __('external-contact.inquiry_message') !!}
        <div class="py-4">
            <div class="bg-white">
                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf
                        <div class="lg:w-1/2 mx-auto">
                            <div class="w-full p-2">
                                <div class="relative">
                                    <label for="name" class="required leading-7 text-sm text-gray-600">{{ __('contact.name') }}</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="email" class="required leading-7 text-sm text-gray-600">{{ __('contact.email') }}</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <div class="relative text-sm">
                                    <label class="required leading-7 text-sm text-gray-600">{{ __('contact.warwick') }}</label><br>
                                    <input type="radio" name="non_warwick_student" value="0" style="margin-right: .5rem;" {{ old('non_warwick_student') == '0' ? 'checked' : '' }}>{{ __('contact.warwick-student') }}<br>
                                    <input type="radio" name="non_warwick_student" value="1" style="margin-right: .5rem;" {{ old('non_warwick_student') == '1' ? 'checked' : '' }}>{{ __('contact.non-warwick-student') }}
                                    <x-input-error :messages="$errors->get('non_warwick_student')" class="mt-2" />
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="subject" class="required leading-7 text-sm text-gray-600">{{ __('contact.subject') }}</label>
                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="contact" class="required leading-7 text-sm text-gray-600">{{ __('contact.content') }}</label>
                                    <textarea id="contact" name="contact" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('contact') }}</textarea>
                                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <div class="relative text-sm">
                                    <input type="checkbox" id="caution" name="caution" style="margin-right: .2rem;" {{ old('caution') ? 'checked' : '' }}>
                                    <label for="caution" class="required">{{ __('contact.warning') }}</label>
                                    <x-input-error :messages="$errors->get('caution')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Required Note -->
                            <div class="mt-4 text-red-400 text-sm">
                                {{ __('register.required') }}
                            </div>

                            <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-sm">{{ __('contact.submit') }}</button>
                            </div>

                            <div class="p-1 w-full pt-5 mt-5 border-t border-gray-200 text-center text-sm">
                                <a class="text-pink-500">warwickvocaloid@gmail.com</a>
                                <p class="leading-normal my-5">Warwick Vocaloid Society
                                    <br>University of Warwick CV4 7AL
                                </p>
                            </div>
                        </div>   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
