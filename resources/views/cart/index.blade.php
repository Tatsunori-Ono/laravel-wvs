<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($cartItems->count())
                        <!-- カートアイテムがある場合 -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{__('rental.item')}}</th>
                                        <th class="px-4 py-2">{{__('rental.quantity')}}</th>
                                        <th class="px-4 py-2">{{__('rental.rental_days')}}</th>
                                        <th class="px-4 py-2">{{__('rental.remove')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $cartItem)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $cartItem->equipmentItem->product_name }}</td>
                                            <td class="border px-4 py-2">{{ $cartItem->quantity }}</td>
                                            <td class="border px-4 py-2">
                                                <!-- レンタル日数更新フォーム -->
                                                <form action="{{ route('cart.update', $cartItem->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="number" class="text-gray-900 dark:text-gray-900" name="rental_days" value="{{ $cartItem->rental_days }}" min="1" max="{{ $cartItem->equipmentItem->max_rental_days }}">
                                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{__('rental.update')}}</button>
                                                </form>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <!-- アイテム削除フォーム -->
                                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">{{__('rental.remove')}}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- ボタン -->
                        <div class="mt-4 flex justify-between">
                            <!-- カタログへ戻るリンク -->
                            <a href="{{ route('rental.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                < {{__('rental.back-to-catalogue')}}
                            </a>
                            <!-- チェックアウトへ進むリンク -->
                            <a href="{{ route('checkout.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">{{__('rental.checkout-next')}}</a>
                        </div>
                    @else
                        <!-- カートが空の場合 -->
                        <p>{{__('rental.empty')}}</p>
                        <!-- カタログへ戻るリンク -->
                        <a href="{{ route('rental.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            < {{__('rental.back-to-catalogue')}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
