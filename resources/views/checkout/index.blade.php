<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($cartItems->count())
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Item</th>
                                        <th class="px-4 py-2">Quantity</th>
                                        <th class="px-4 py-2">Rental Days</th>
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
                        <div class="mt-4">
                            <form action="{{ route('checkout.process') }}" method="post">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Confirm Checkout</button>
                            </form>
                        </div>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
