<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('showcase.showcase_heading') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">{{ __('showcase.candidates') }}</h2>
                    <h3 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-4">{{ __('showcase.instruction') }}</h3>
                    @if($submissions->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($submissions as $submission)
                                <div class="p-4 border border-gray-200 rounded-lg shadow">
                                    <h3 class="text-lg font-bold">{{ $submission->title }}</h3>
                                    <h3 class="text-base font-bold">{{__('showcase.display_by')}} {{ $submission->name }}</h3>
                                    <p class="text-sm">{{ $submission->description }}</p>
                                    @foreach($submission->works as $work)
                                        @if (str_contains($work->file_path, 'showcase_seed'))
                                            @if (str_contains($work->file_path, 'jpeg') || str_contains($work->file_path, 'png') || str_contains($work->file_path, 'jpg') || str_contains($work->file_path, 'gif') || str_contains($work->file_path, 'svg'))
                                                <img src="{{ asset($work->file_path) }}" alt="{{ $submission->title }}" class="w-full h-auto mt-2">
                                            @elseif (str_contains($work->file_path, 'mp3') || str_contains($work->file_path, 'wav') || str_contains($work->file_path, 'mp4'))
                                                <audio controls class="mt-2 w-full">
                                                    <source src="{{ asset($work->file_path) }}" type="audio/mpeg">
                                                    {{ __('showcase.no-support') }}
                                                </audio>
                                            @endif
                                        @else
                                            @if (str_contains($work->file_path, 'jpeg') || str_contains($work->file_path, 'png') || str_contains($work->file_path, 'jpg') || str_contains($work->file_path, 'gif') || str_contains($work->file_path, 'svg'))
                                                <img src="{{ asset('storage/' . $work->file_path) }}" alt="{{ $submission->title }}" class="w-full h-auto mt-2">
                                            @elseif (str_contains($work->file_path, 'mp3') || str_contains($work->file_path, 'wav') || str_contains($work->file_path, 'mp4'))
                                                <audio controls class="mt-2 w-full">
                                                    <source src="{{ asset('storage/' . $work->file_path) }}" type="audio/mpeg">
                                                    {{ __('showcase.no-support') }}
                                                </audio>
                                            @endif
                                        @endif
                                    @endforeach
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <form action="{{ route('showcase.approve', $submission->id) }}" method="post">
                                            @csrf
                                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('showcase.approve') }}</button>
                                        </form>
                                        <form action="{{ route('showcase.reject', $submission->id) }}" method="post">
                                            @csrf
                                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('showcase.reject') }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-red-500">{{ __('showcase.no_submissions') }}</p>
                    @endif

                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6 mb-4">{{ __('showcase.showcase-edit') }}</h2>
                    @if($approvedSubmissions->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($approvedSubmissions as $approvedSubmission)
                                <div class="p-4 border border-gray-200 rounded-lg shadow">
                                    <h3 class="text-lg font-bold">{{ $approvedSubmission->title }}</h3>
                                    <h3 class="text-base font-bold">{{__('showcase.display_by')}} {{ $approvedSubmission->name }}</h3>
                                    <p class="text-sm">{{ $approvedSubmission->description }}</p>
                                    @foreach($approvedSubmission->works as $work)
                                        @if (str_contains($work->file_path, 'showcase_seed'))
                                            @if (str_contains($work->file_path, 'jpeg') || str_contains($work->file_path, 'png') || str_contains($work->file_path, 'jpg') || str_contains($work->file_path, 'gif') || str_contains($work->file_path, 'svg'))
                                                <img src="{{ asset($work->file_path) }}" alt="{{ $approvedSubmission->title }}" class="w-full h-auto mt-2">
                                            @elseif (str_contains($work->file_path, 'mp3') || str_contains($work->file_path, 'wav') || str_contains($work->file_path, 'mp4'))
                                                <audio controls class="mt-2 w-full">
                                                    <source src="{{ asset($work->file_path) }}" type="audio/mpeg">
                                                    {{ __('showcase.no-support') }}
                                                </audio>
                                            @endif
                                        @else
                                            @if (str_contains($work->file_path, 'jpeg') || str_contains($work->file_path, 'png') || str_contains($work->file_path, 'jpg') || str_contains($work->file_path, 'gif') || str_contains($work->file_path, 'svg'))
                                                <img src="{{ asset('storage/' . $work->file_path) }}" alt="{{ $approvedSubmission->title }}" class="w-full h-auto mt-2">
                                            @elseif (str_contains($work->file_path, 'mp3') || str_contains($work->file_path, 'wav') || str_contains($work->file_path, 'mp4'))
                                                <audio controls class="mt-2 w-full">
                                                    <source src="{{ asset('storage/' . $work->file_path) }}" type="audio/mpeg">
                                                    {{ __('showcase.no-support') }}
                                                </audio>
                                            @endif
                                        @endif
                                    @endforeach
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <a href="{{ route('showcase.edit', $approvedSubmission->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 font-bold rounded">{{ __('showcase.edit') }}</button>
                                        </a>
                                        <form action="{{ route('showcase.destroy', $approvedSubmission->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                {{ __('showcase.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-red-500">{{ __('showcase.no_approved_submissions') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
