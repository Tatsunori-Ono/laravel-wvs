<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Rental Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.rental.update', $rental->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('User') }}</label>
                            <input type="text" name="user_name" id="user_name" value="{{ $rental->user->name }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Item') }}</label>
                            <input type="text" name="item_name" id="item_name" value="{{ $rental->equipmentItem->product_name }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Quantity') }}</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $rental->quantity) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($errors->has('quantity'))
                                <span class="text-red-500 text-sm">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="return_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Return By') }}</label>
                            <input type="datetime-local" name="return_by" id="return_by" value="{{ old('return_by', $rental->return_by) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($errors->has('return_by'))
                                <span class="text-red-500 text-sm">{{ $errors->first('return_by') }}</span>
                            @endif
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>