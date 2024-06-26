<x-guest-layout>
    <!-- セッションのステータス -->
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="grid grid-cols-1 gap-16">
        @php
            $qrCodeUrl = Google2FA::getQRCodeInline(config('app.name'), Auth::user()->email, Auth::user()->google2fa_secret);
        @endphp
        <div class="flex items-center justify-center">
            {!! $qrCodeUrl !!}
        </div>
        <div class="mt-2">
            <p>{{__('google2fa.instruction')}}</p>
        </div>
        <div class="flex items-center justify-center gap-4 mt-4">
            <div>
                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=ja&gl=US">GooglePlay</a>
            </div>
            <div>
                <a href="https://apps.apple.com/jp/app/google-authenticator/id388497605">AppStore</a>
            </div>
        </div>
        <div class="mt-2">
            <p class="text-sm mb-2">{{__('google2fa.onetimepass')}}</p>
        </div>
        <form method="POST" action="{{ route('2fa') }}">
            @csrf
            <div class="mt-2">
                <input type="text" id="one_time_password" name="one_time_password" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <!-- 入力エラー -->
            <!-- Validation Errors -->
            @if ($errors->any())
                <x-input-error :messages="$errors->first()" />
            @endif

            <div class="mt-2 flex items-center justify-end">
                <div>
                    <x-primary-button>
                        {{ __('google2fa.login') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
        <div class="mt-4 flex items-center justify-start">
            <div>
                <!-- ログアウトフォーム -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                        {{ __('google2fa.logout') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
