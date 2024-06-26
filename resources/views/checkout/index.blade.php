<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($cartItems->count())
                        <!-- カートにアイテムがある場合 -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{__('rental.item')}}</th>
                                        <th class="px-4 py-2">{{__('rental.quantity')}}</th>
                                        <th class="px-4 py-2">{{__('rental.rental_days')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $cartItem)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $cartItem->equipmentItem->product_name }}</td>
                                            <td class="border px-4 py-2">{{ $cartItem->quantity }}</td>
                                            <td class="border px-4 py-2">{{ $cartItem->rental_days }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- チェックアウト処理フォーム -->
                        <div class="mt-4">
                            <form action="{{ route('checkout.process') }}" method="post">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">{{__('rental.confirm')}}</button>
                            </form>
                        </div>
                    @else
                        <!-- カートが空の場合 -->
                        <p>Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
