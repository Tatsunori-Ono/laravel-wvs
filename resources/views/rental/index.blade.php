<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('rental.create') }}" class="text-blue-500">
                        {{ __('rental.create') }}
                    </a>
                    
                    <form class="mb-8 mt-5" action="{{ route('rental.index') }}" method="get">
                        <!-- 検索バー -->
                        <input type="text" name="search" class="dark:text-black" placeholder="{{ __('rental.search') }}">
                        <button class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">{{ __('rental.search') }}</button>
                        
                        <!-- カテゴリ絞り -->
                        <select name="category" class="ml-5 dark:text-black">
                            <option value="">{{ __('rental.all-categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                        <button class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">{{ __('rental.filter') }}</button>
                    </form>

                    <a href="{{ route('rental.index', ['favorites' => 1]) }}" class="text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded">
                        {{ __('rental.favourites') }}
                    </a>

                    <a href="{{ route('cart.index') }}" class="ml-5 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-lg">
                        {{__('rental.go-to-cart')}} ({{ $cartItemCount }})
                    </a>

                    @if($equipmentItems->count())
                        <div class="container px-5 pt-19 mt-11 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @foreach ($equipmentItems as $item)
                                    @php
                                        $availableQuantity = $item->quantity - $item->rented_quantity;
                                    @endphp
                                    <div class="lg:w-1/4 p-3 w-full">
                                        <div class="relative">
                                            <!-- Slideshow container -->
                                            <div class="slideshow-container slideshow-container-{{ $item->id }}">
                                                <!-- Full-width images with number and caption text -->
                                                @foreach($item->images as $index => $image)
                                                    <div class="mySlides fade slideshow-{{ $item->id }}">
                                                        <div class="numbertext">{{ $index + 1 }} / {{ $item->images->count() }}</div>
                                                        <a href="{{ route('rental.show', ['id' => $item->id]) }}">
                                                            @if (str_contains($image->image_path, 'seed_images'))
                                                                <img src="{{ asset($image->image_path) }}" style="width:100%">
                                                            @else
                                                                <img src="{{ asset('storage/' . $image->image_path) }}" style="width:100%">
                                                            @endif
                                                            <div class="text">{{ $item->product_name }}</div>
                                                        </a>
                                                    </div>
                                                @endforeach

                                                <!-- Next and previous buttons -->
                                                <a class="prev" onclick="plusSlides(-1, {{ $item->id }})">&#10094;</a>
                                                <a class="next" onclick="plusSlides(1, {{ $item->id }})">&#10095;</a>
                                            </div>
                                            <br>

                                            <!-- The dots/circles -->
                                            <div class="dots-container">
                                                @foreach($item->images as $index => $image)
                                                    <span class="dot dot-{{ $item->id }}" onclick="currentSlide({{ $index + 1 }}, {{ $item->id }})"></span>
                                                @endforeach
                                            </div>

                                            <div class="mt-1 mb-4">
                                                <h3 class="text-gray-500 dark:text-gray-300 text-xs tracking-widest title-font mb-1">{{ $item->category }}</h3>
                                                <h2 class="text-gray-900 dark:text-gray-100 title-font text-lg font-medium">{{ $item->product_name }}</h2>
                                                <h3 class="text-gray-900 dark:text-gray-100 text-sm tracking-widest title-font mb-1">{{ $item->product_type }}</h3>
                                                @if ($availableQuantity > 0)
                                                    <p class="mt-1 text-green-500 font-bold">{{ $availableQuantity }} {{__('rental.status-available')}}</p>
                                                @else
                                                    <p class="mt-1 text-red-500 font-bold">{{__('rental.status-rented')}}</p>
                                                @endif
                                                <a class="text-blue-500" href="{{ route('rental.show', ['id' => $item->id]) }}">{{ __('rental.details') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        let slideIndex{{ $item->id }} = 1;
                                        showSlides(slideIndex{{ $item->id }}, {{ $item->id }});

                                        function plusSlides(n, id) {
                                            showSlides(slideIndex{{ $item->id }} += n, id);
                                        }

                                        function currentSlide(n, id) {
                                            showSlides(slideIndex{{ $item->id }} = n, id);
                                        }

                                        function showSlides(n, id) {
                                            let i;
                                            let slides = document.querySelectorAll('.slideshow-' + id);
                                            let dots = document.querySelectorAll('.dot-' + id);
                                            if (n > slides.length) {slideIndex{{ $item->id }} = 1}
                                            if (n < 1) {slideIndex{{ $item->id }} = slides.length}
                                            for (i = 0; i < slides.length; i++) {
                                                slides[i].style.display = "none";
                                            }
                                            for (i = 0; i < dots.length; i++) {
                                                dots[i].className = dots[i].className.replace(" active", "");
                                            }
                                            slides[slideIndex{{ $item->id }}-1].style.display = "block";
                                            dots[slideIndex{{ $item->id }}-1].className += " active";
                                        }
                                    </script>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pagination -->
                        {{ $equipmentItems->links() }}
                    @else
                        <p>{{ __('rental.no_items') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        * {box-sizing: border-box}

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            top: 18px;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 9px;
            width: 9px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        /* Dots section */
        .dots-container {
            text-align: center;
        }
    </style>
</x-app-layout>
