@extends('layouts.base')

<x-guest-layout>
    <!-- メッセージ -->
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('verify-email.message') }}
    </div>

    <!-- リンク送信確認メッセージ -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('verify-email.sent') }}
        </div>
    @endif

    <!-- ボタンとログアウトフォーム -->
    <div class="mt-4 flex items-center justify-between">
        <!-- リンク送信フォーム -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('verify-email.resend') }}
                </x-primary-button>
            </div>
        </form>

        <!-- ログアウトフォーム -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('verify-email.logout') }}
            </button>
        </form>
    </div>
</x-guest-layout>
