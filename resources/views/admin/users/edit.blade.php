<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('user-control.edit-title') }}
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
                    <!-- ユーザー編集フォーム -->
                    <form action="{{ route('admin.users.update', $user) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <!-- バリデーションエラーメッセージの表示 -->
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- 名前入力フィールド -->
                        <div class="mb-4">
                            <label for="name" class="required leading-7 text-base text-gray-600 dark:text-gray-200">{{ __('user-control.name') }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <!-- メール入力フィールド -->
                        <div class="mb-4">
                            <label for="email" class="required leading-7 text-base text-gray-600 dark:text-gray-200">{{ __('user-control.email') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <!-- Warwick ID入力フィールド -->
                        <div class="mb-4">
                            <label for="warwick_id" class="required leading-7 text-base text-gray-600 dark:text-gray-200">{{ __('user-control.warwick-id') }}</label>
                            <input type="text" id="warwick_id" name="warwick_id" value="{{ old('warwick_id', $user->warwick_id) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <!-- 権限の種類入力フィールド -->
                        <div class="mb-4">
                            <label for="role" class="required leading-7 text-base text-gray-600 dark:text-gray-200">{{ __('user-control.role') }}</label>
                            <input type="text" id="role" name="role" value="{{ old('role', $user->role) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <!-- 必須項目の注意書き -->
                        <div class="mt-4 text-red-400 text-base mb-3">
                            {{__('register.required')}}
                        </div>

                        <!-- 保存ボタン -->
                        <div>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">{{ __('user-control.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
