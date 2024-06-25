<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('contact.create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600 dark:text-white">{{ __('contact.name') }}</label>
                                            <div class="w-full rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 dark:text-gray-300 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $contact->name }}</div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="email" class="leading-7 text-sm text-gray-600 dark:text-white">{{ __('contact.email') }}</label>
                                            <div class="w-full rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 dark:text-gray-300 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $contact->email }}</div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label class="leading-7 text-sm text-gray-600 dark:text-white">{{ __('contact.warwick') }}</label><br>
                                            <div class="w-full rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 dark:text-gray-300 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $non_warwick_student }}</div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="subject" class="leading-7 text-sm text-gray-600 dark:text-white">{{ __('contact.subject') }}</label>
                                            <div class="w-full rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 dark:text-gray-300 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $contact->subject }}</div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="contact" class="leading-7 text-sm text-gray-600 dark:text-white">{{ __('contact.content') }}</label>
                                            <textarea class="w-full rounded border border-gray-300 dark:bg-transparent focus:border-pink-500 focus:ring-2 focus:ring-pink-200 h-32 text-base outline-none text-gray-700 dark:text-gray-300 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $contact->contact }}</textarea>
                                        </div>
                                    </div>
                                    
                                    @if (Auth::user()->role === 'admin')
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <form action="{{ route('contacts.edit', ['id' => $contact->id]) }}" method="get">
                                                    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ __('contact.edit') }}</button>
                                                </form>
                                            </div>
                                        </div>

                                        <form id="delete_{{ $contact->id }}" action="{{ route('contacts.destroy', ['id' => $contact->id]) }}" method="post">
                                            @csrf
                                            <div class="p-2 w-full flex justify-center">
                                                <a href="#" data-id="{{ $contact->id }}" onclick="deletePost(this)" class="flex text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">
                                                    {{ __('contact.destroy') }}
                                                </a>
                                            </div>
                                        </form>
                                    @endif

                                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                                        <a class="text-pink-500">warwickvocaloid@gmail.com</a>
                                        <p class="leading-normal my-5 dark:text-white">Warwick Vocaloid Society
                                            <br>University of Warwick CV4 7AL
                                        </p>
                                        <span class="inline-flex">
                                            <a href="https://www.instagram.com/warwick_vocaloid/" class="ml-4 text-gray-500">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation message for deletion -->
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('{{ __('contact.confirm-delete') }}')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
