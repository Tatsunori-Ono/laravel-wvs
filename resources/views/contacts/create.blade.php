<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('contact.create') }}
        </h2>

        <style>
            /* 必須項目のスタイリング */
            .required:after{ 
                content:'*'; 
                color:red;
                padding-left:1px;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font relative">

                        <form action="{{ route('contacts.store') }}" method="post">

                            @csrf

                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{__('contact.name')}}</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{__('contact.email')}}</label>
                                        <input type="email" id="email" name="email" value="{{old('email')}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{__('contact.warwick')}}</label><br>
                                        <input type="radio" name="non_warwick_student" value="0" style="margin-right: .5rem;" {{old('non_warwick_student') == '0' ? 'checked' : ''}}><span class="dark:text-gray-200">{{__('contact.warwick-student')}}</span><br>
                                        <input type="radio" name="non_warwick_student" value="1" style="margin-right: .5rem;" {{old('non_warwick_student') == '1' ? 'checked' : ''}}><span class="dark:text-gray-200">{{__('contact.non-warwick-student')}}</span>
                                        <x-input-error :messages="$errors->get('non_warwick_student')" class="mt-2" />
                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="subject" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{__('contact.subject')}}</label>
                                        <input type="text" id="subject" name="subject" value="{{old('subject')}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="contact" class="required leading-7 text-sm text-gray-600 dark:text-gray-200">{{__('contact.content')}}</label>
                                        <textarea id="contact" name="contact" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{old('contact')}}</textarea>
                                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <input type="checkbox" id="caution" name="caution" style="margin-right: .2rem;" >
                                        @if(app()->getLocale() == 'ja')
                                            <label class="required dark:text-gray-200"><a href="{{ url('/terms-and-conditions') }}" class="text-blue-500">{{ __('contact.terms-and-conditions') }}</a>{{ __('contact.agree') }}</label>
                                        @else
                                            <label class="required dark:text-gray-200">{{ __('contact.agree') }} <a href="{{ url('/terms-and-conditions') }}" class="text-blue-500">{{ __('contact.terms-and-conditions') }}</a>.</label>
                                        @endif
                                        <x-input-error :messages="$errors->get('caution')" class="mt-2" />
                                    </div>
                                    </div>

                                    <!-- 必須項目の注意書き -->
                                    <div class="mt-4 text-red-400 text-base">
                                        {{__('register.required')}}
                                    </div>
                                    
                                    <div class="p-2 w-full">
                                        <button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">{{__('contact.submit')}}</button>
                                    </div>

                                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                                    <a class="text-pink-500">warwickvocaloid@gmail.com</a>
                                    <p class="leading-normal my-5">Warwick Vocaloid Society
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
                        </form>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
