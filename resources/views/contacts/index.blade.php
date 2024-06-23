<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('contact.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('contacts.create') }}" class="text-blue-500">{{ __('contact.create') }}</a>
                    
                    <form class="mb-8" action="{{ route('contacts.index') }}" method="get">
                        <input type="text" name="search" placeholder="{{ __('contact.search') }}">
                        <button class="text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">{{ __('contact.search') }}</button>
                    </form>

                    @if($contacts->count())
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">{{ __('contact.id') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('contact.name') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('contact.subject') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('contact.date') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('contact.details-title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $contact->id }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $contact->name }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $contact->subject }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $contact->created_at }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3"><a class="text-blue-500" href="{{ route('contacts.show', ['id' => $contact->id]) }}">{{ __('contact.details') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{ $contacts->links() }}
                    @else
                        <p>{{ __('contact.no_inquiries') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
