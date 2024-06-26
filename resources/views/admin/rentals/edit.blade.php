<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.edit-log') }}
        </h2>

        <style>
            /* 必須項目のスタイリング */
            .required:after {
                content: '*';
                color: red;
                padding-left: 1px;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.rental.update', $rental->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- ユーザー名の表示 -->
                        <div class="mb-4">
                            <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('rental.user') }}</label>
                            <input type="text" name="user_name" id="user_name" value="{{ $rental->user->name }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- アイテム名の表示 -->
                        <div class="mb-4">
                            <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('rental.item') }}</label>
                            <input type="text" name="item_name" id="item_name" value="{{ $rental->equipmentItem->product_name }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- 数量の入力 -->
                        <div class="mb-4">
                            <label for="quantity" class="required block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('rental.quantity') }}</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $rental->quantity) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($errors->has('quantity'))
                                <span class="text-red-500 text-sm">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>

                        <!-- 返却日入力 -->
                        <div class="mb-4">
                            <label for="return_by" class="required block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('rental.return-by') }}</label>
                            <input type="datetime-local" name="return_by" id="return_by" value="{{ old('return_by', $rental->return_by) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($errors->has('return_by'))
                                <span class="text-red-500 text-sm">{{ $errors->first('return_by') }}</span>
                            @endif
                        </div>

                        <!-- 必須項目の注意書き -->
                        <div class="mt-4 text-red-400 text-base">
                            {{__('register.required')}}
                        </div>

                        <!-- 更新ボタン -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('rental.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
