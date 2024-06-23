<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jukebox') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('jukebox.store') }}" method="POST" class="mb-8">
                        @csrf
                        <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('YouTube URL') }}</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <button type="submit" class="mt-4 text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">{{ __('Add to Queue') }}</button>
                    </form>

                    @if(session('success'))
                        <div class="mb-4 text-green-500">{{ session('success') }}</div>
                    @endif

                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">{{ __('Queue') }}</h2>
                    @if($jukeboxItems->count())
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto mt-4">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">{{ __('ID') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('YouTube URL') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('Added At') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jukeboxItems as $item)
                                        <tr>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->id }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->youtube_url }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>{{ __('No items in the queue.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
