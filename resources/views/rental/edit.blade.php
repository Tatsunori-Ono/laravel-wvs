<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.editing-page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font relative">
                        <form action="{{ route('rental.update', ['id' => $equipmentItem->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="product_name" class="required leading-7 text-sm text-gray-600">{{__('rental.product_name')}}</label>
                                                <input type="text" id="product_name" name="product_name" value="{{ $equipmentItem->product_name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="product_type" class="required leading-7 text-sm text-gray-600">{{__('rental.product_type')}}</label>
                                                <input type="text" id="product_type" name="product_type" value="{{ $equipmentItem->product_type }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="manufacturer" class="leading-7 text-sm text-gray-600">{{__('rental.manufacturer')}}</label>
                                                <input type="text" id="manufacturer" name="manufacturer" value="{{ $equipmentItem->manufacturer }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="category" class="required leading-7 text-sm text-gray-600">{{__('rental.category')}}</label>
                                                <input type="text" id="category" name="category" value="{{ $equipmentItem->category }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="location_stored" class="required leading-7 text-sm text-gray-600">{{__('rental.location_stored')}}</label>
                                                <input type="text" id="location_stored" name="location_stored" value="{{ $equipmentItem->location_stored }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="description" class="leading-7 text-sm text-gray-600">{{__('rental.description')}}</label>
                                                <textarea id="description" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $equipmentItem->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="purchase_date" class="leading-7 text-sm text-gray-600">{{__('rental.purchase_date')}}</label>
                                                <input type="date" id="purchase_date" name="purchase_date" value="{{ $equipmentItem->purchase_date }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="quantity" class="required leading-7 text-sm text-gray-600">{{__('rental.quantity')}}</label>
                                                <input type="number" id="quantity" name="quantity" value="{{ $equipmentItem->quantity }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="max_rental_days" class="required leading-7 text-sm text-gray-600">{{__('rental.max_rental_days')}}</label>
                                                <input type="number" id="max_rental_days" name="max_rental_days" value="{{ $equipmentItem->max_rental_days }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="price" class="required leading-7 text-sm text-gray-600">{{__('rental.price')}}</label>
                                                <input type="number" step="0.01" id="price" name="price" value="{{ $equipmentItem->price }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="images" class="leading-7 text-sm text-gray-600">{{__('rental.images')}}</label>
                                                <input type="file" id="images" name="images[]" multiple class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">{{__('rental.update')}}</button>
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
