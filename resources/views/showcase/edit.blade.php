<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('showcase.edit_submission') }}
        </h2>

        <style>
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
                    <form method="post" action="{{ route('showcase.update', $submission->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="name" class="required block text-base font-medium text-gray-700 dark:text-gray-300">{{ __('showcase.name-admin') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $submission->name) }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="required block text-base font-medium text-gray-700 dark:text-gray-300">{{ __('showcase.showcase_name_admin') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $submission->title) }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-base font-medium text-gray-700 dark:text-gray-300">{{ __('showcase.description') }}</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('description', $submission->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="file" class="required block text-base font-medium text-gray-700 dark:text-gray-300">{{ __('showcase.file_admin') }}</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @if ($submission->works->isNotEmpty())
                                <div class="mt-2">
                                    <p class="text-base">{{ __('showcase.current-file') }}</p>
                                    @php
                                        $filePath = $submission->works->first()->file_path;
                                    @endphp
                                    @if (str_contains($filePath, 'jpeg') || str_contains($filePath, 'png') || str_contains($filePath, 'jpg') || str_contains($filePath, 'gif') || str_contains($filePath, 'svg'))
                                        <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $submission->title }}" class="w-full h-auto mt-2">
                                    @elseif (str_contains($filePath, 'mp3') || str_contains($filePath, 'wav') || str_contains($filePath, 'mp4'))
                                        <audio controls class="w-full mt-2">
                                            <source src="{{ asset('storage/' . $filePath) }}" type="audio/mpeg">
                                            {{ __('showcase.no-support') }}
                                        </audio>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- 必須項目の注意書き -->
                        <div class="mt-4 text-red-400 text-base mb-4">
                            {{__('register.required')}}
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                {{ __('showcase.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
