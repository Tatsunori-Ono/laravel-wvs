<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <a href="{{ route('rental.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-4 px-8 text-base rounded">
            < Back to Catalogue
        </a>
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <!-- Slideshow container for the product images -->
                <div class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded">
                    <div class="slideshow-container">
                        @foreach($equipmentItem->images as $index => $image)
                            <div class="mySlides fade">
                                <div class="numbertext">{{ $index + 1 }} / {{ $equipmentItem->images->count() }}</div>
                                @if (str_contains($image->image_path, 'seed_images'))
                                    <img src="{{ asset($image->image_path) }}" style="width:100%">
                                @else
                                    <img src="{{ asset('storage/' . $image->image_path) }}" style="width:100%">
                                @endif
                            </div>
                        @endforeach

                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                    <br>

                    <!-- The dots/circles -->
                    <div style="text-align:center">
                        @foreach($equipmentItem->images as $index => $image)
                            <span class="dot" onclick="currentSlide({{ $index + 1 }})"></span>
                        @endforeach
                    </div>
                </div>

                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 dark:text-gray-200 tracking-widest">{{ $equipmentItem->category }}</h2>
                    <h1 class="text-gray-900 dark:text-gray-200 text-3xl title-font font-medium mb-1">{{ $equipmentItem->product_name }}</h1>
                    <div class="flex mb-4">
                        <span class="flex items-center">
                            <!-- Display average rating using stars -->
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $equipmentItem->average_rating)
                                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-green-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                @else
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-green-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                @endif
                            @endfor
                            <span class="text-gray-600 dark:text-gray-200 ml-3">{{ $equipmentItem->rental_count }} Rentals</span>
                        </span>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                    <p class="leading-relaxed dark:text-gray-200">{{ $equipmentItem->description }}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                        <div class="flex ml-6 items-center">
                            <span class="mr-3 dark:text-gray-200">Location:</span>
                            <span class="text-gray-700 dark:text-gray-300">{{ $equipmentItem->location_stored }}</span>
                        </div>
                    </div>
                    <div class="flex">
                        @php
                            $availableQuantity = $equipmentItem->quantity - $equipmentItem->rented_quantity;
                        @endphp
                        <span class="title-font font-medium text-2xl text-green-600 dark:text-green-200">{{ $availableQuantity }} Available</span>
                        
                        <form action="{{ route('cart.add') }}" method="post" class="ml-auto">
                            @csrf
                            <input type="hidden" name="equipment_item_id" value="{{ $equipmentItem->id }}">
                            <label for="quantity" class="dark:text-gray-200">Quantity:</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $equipmentItem->quantity - $equipmentItem->rented_quantity }}">
                            <label for="rental_days" class="dark:text-gray-200">Rental Days:</label>
                            <input type="number" name="rental_days" value="1" min="1" max="{{ $equipmentItem->max_rental_days }}">
                            <button type="submit" class="flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 mt-10 rounded">Add to Cart</button>
                        </form>

                        @if($isFavorited)
                            <form action="{{ route('rental.removeFavorite', $equipmentItem->id) }}" method="post">
                                @csrf
                                <button type="submit" class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-red-500 ml-4">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('rental.addFavorite', $equipmentItem->id) }}" method="post">
                                @csrf
                                <button type="submit" class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>

    <style>
        * {box-sizing:border-box}

        /* Slideshow container */
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
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
            height: 10px;
            width: 10px;
            margin: 0 2px;
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
    </style>
</x-app-layout>
