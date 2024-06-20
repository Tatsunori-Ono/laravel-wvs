@extends('layouts.base')

<x-guest-layout>

    <style>
        /* 必須項目のスタイリング */
        .required:after{ 
            content:'*'; 
            color:red;
            padding-left:1px;
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('register.name')" class="required"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Warwick ID -->
        <div class="mt-4">
            <x-input-label for="warwick_id" :value="__('register.warwick-id')" />
            <x-text-input id="warwick_id" class="block mt-1 w-full" type="text" name="warwick_id" :value="old('warwick_id')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('warwick_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('register.email')" class="required"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('register.password')" class="required"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('register.confirm-password')" class="required"/>

            <x-text-input id="password_confirmation" class="required block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- is Enable Google2fa -->
        <div class="block mt-4">
            <label for="is_enable_google2fa" class="inline-flex items-center">
                <input id="is_enable_google2fa" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_enable_google2fa" value="1">
                <span class="ml-2 text-sm text-gray-600">{{ __('Enable Google 2fa') }}</span>
            </label>
        </div>

        <!-- 必須項目の注意書き -->
        <div class="mt-4 text-red-400 text-base">
            {{__('register.required')}}
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('register.already-registered') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('register.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
