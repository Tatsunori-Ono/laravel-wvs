<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('platform.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg">

                    <!-- ユーザーにレンタルアイテムがあるかどうかを確認 -->
                    @if($rentals->count())
                        <h3 class="mt-4 mb-2">{{__('dashboard.your-rental')}}</h3>
                        
                        <ul>
                            <!-- アプリの言語が日本語の場合のレンタル情報の表示 -->
                            @if(app()->getLocale() == 'ja')
                                @foreach($rentals as $rental)
                                    <li>
                                        <span class="font-bold underline">{{ $rental->equipmentItem->product_name }}</span> 
                                        を
                                        <span class="font-bold text-green-500">{{ $rental->return_by }}</span>
                                        までにご返却ください。
                                        （残り
                                        <span class="countdown font-bold" data-return-by="{{ $rental->return_by }}"></span>
                                        ）
                                    </li>
                                @endforeach
                            <!-- アプリの言語が英語の場合のレンタル情報の表示 -->
                            @else
                                @foreach($rentals as $rental)
                                    <li>
                                        Please return 
                                        <span class="font-bold underline">{{ $rental->equipmentItem->product_name }}</span> 
                                        by 
                                        <span class="font-bold text-green-500">{{ $rental->return_by }}</span>
                                        (
                                        <span class="countdown font-bold" data-return-by="{{ $rental->return_by }}"></span>
                                        left)
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    <!-- ユーザーにレンタルアイテムがない場合のメッセージ -->
                    @else
                        <p>{{__('rental.no-rental')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElements = document.querySelectorAll('.countdown');

            countdownElements.forEach(function(element) {
                const returnBy = new Date(element.dataset.returnBy).getTime();
                console.log('Return By:', element.dataset.returnBy, returnBy);

                const updateCountdown = () => {
                    const now = new Date().getTime();
                    const distance = returnBy - now;

                    if (distance < 0) {
                        element.innerHTML = "Expired";
                    } else {
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        element.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    }
                };

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        });
    </script>
</x-app-layout>
