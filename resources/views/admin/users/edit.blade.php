<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.users.update', $user) }}" method="post">
                        @csrf
                        @method('PATCH')

                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="name" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{ __('Email') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="warwick_id" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{ __('Warwick ID') }}</label>
                            <input type="text" id="warwick_id" name="warwick_id" value="{{ old('warwick_id', $user->warwick_id) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{ __('Role') }}</label>
                            <input type="text" id="role" name="role" value="{{ old('role', $user->role) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <div>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">{{ __('Save Changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
