<nav x-data="{ open: false }" class="p-3 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-6 sm:flex">
                    
                    @if(Auth::user()->role === 'admin')
                        <!-- ルートがrental何々, cart何々, checkout何々だったら全てnavbarでEquipment Rentalがactive -->
                        <x-nav-link :href="route('rental.index')" :active="request()->routeIs(['rental.*', 'cart.*', 'checkout.*'])">
                            {{ __('platform.rental') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.rental.log')" :active="request()->routeIs('admin.rental.log')">
                            {{ __('platform.rental_log') }}
                        </x-nav-link>
                        <x-nav-link :href="route('jukebox.admin')" :active="request()->routeIs(['jukebox.admin', 'jukebox.index'])">
                            {{ __('platform.jukebox') }}
                        </x-nav-link>
                        <x-nav-link :href="route('showcase.admin')" :active="request()->routeIs('showcase.admin')">
                            {{ __('platform.admin_showcase') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('platform.dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('rental.index')" :active="request()->routeIs(['rental.*', 'cart.*', 'checkout.*'])">
                            {{ __('platform.rental') }}
                        </x-nav-link>
                        <x-nav-link :href="route('jukebox.index')" :active="request()->routeIs('jukebox.index')">
                            {{ __('platform.jukebox') }}
                        </x-nav-link>
                        <x-nav-link :href="route('showcase.create')" :active="request()->routeIs('showcase.create')">
                            {{ __('platform.submit_work') }}
                        </x-nav-link>
                    @endif
                    
                    <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.*')">
                        {{ __('platform.contact') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('platform.user_control') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('donate')" :active="request()->routeIs('donate')">
                            {{ __('platform.donate') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="url('/about')" :active="request()->is('about')">
                        {{ __('platform.main') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings, Dark Mode Toggle, and Language Switcher -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- Language Switcher -->
                <div class="language-switcher inline-flex items-center ms-4">
                    <a href="{{ route('change_language', ['locale' => 'en']) }}" class="px-3 py-2 text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">EN</a>
                    <span class="dark:text-gray-200">/</span>
                    <a href="{{ route('change_language', ['locale' => 'ja']) }}" class="px-3 py-2 text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">JA</a>
                </div>

                <!-- Dark Mode Toggle Button -->
                <button id="dark-mode-toggle" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <img id="dark-mode-icon" src="/images/icons/moon.svg" alt="Toggle Dark Mode" class="h-6 w-6">
                </button>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Photo" class="h-8 w-8 rounded-full object-cover me-2">
                            @else
                                <img src="{{ asset('images/user_icon.png') }}" alt="Default Profile Photo" class="h-8 w-8 rounded-full object-cover me-2">
                            @endif
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('platform.profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('platform.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('rental.index')" :active="request()->routeIs(['rental.*', 'cart.*', 'checkout.*'])">
                    {{ __('platform.rental') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.rental.log')" :active="request()->routeIs('admin.rental.log')">
                    {{ __('platform.rental_log') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('jukebox.admin')" :active="request()->routeIs(['jukebox.admin', 'jukebox.index'])">
                    {{ __('platform.jukebox') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('showcase.admin')" :active="request()->routeIs('showcase.admin')">
                    {{ __('platform.admin_showcase') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('platform.dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rental.index')" :active="request()->routeIs(['rental.*', 'cart.*', 'checkout.*'])">
                    {{ __('platform.rental') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('jukebox.index')" :active="request()->routeIs('jukebox.index')">
                    {{ __('platform.jukebox') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('showcase.create')" :active="request()->routeIs('showcase.create')">
                    {{ __('platform.submit_work') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')">
                {{ __('platform.contact') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                    {{ __('platform.user_control') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('donate')" :active="request()->routeIs('donate')">
                    {{ __('platform.donate') }}
                </x-responsive-nav-link>
            @endif
            
            <x-responsive-nav-link :href="url('/about')" :active="request()->is('about')">
                {{ __('platform.main') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Dark Mode Toggle and Language Switcher -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex justify-between items-center">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Photo" class="h-8 w-8 rounded-full object-cover me-2">
                @else
                    <img src="{{ asset('images/user_icon.png') }}" alt="Default Profile Photo" class="h-8 w-8 rounded-full object-cover me-2">
                @endif
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <button id="responsive-dark-mode-toggle" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <img id="responsive-dark-mode-icon" src="/images/icons/moon.svg" alt="Toggle Dark Mode" class="h-6 w-6">
                </button>
            </div>
            <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            <div class="language-switcher flex mt-3">
                <a href="{{ route('change_language', ['locale' => 'en']) }}" class="px-3 py-2 text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">EN</a>
                <span class="dark:text-gray-400">/</span>
                <a href="{{ route('change_language', ['locale' => 'ja']) }}" class="px-3 py-2 text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">JA</a>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('platform.profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('platform.logout') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>

<!-- JavaScript to handle the dark mode toggle and persistence -->
<script>
    // Function to apply dark mode based on localStorage value
    function applyDarkMode() {
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
            document.getElementById('dark-mode-icon').src = '/images/icons/sun.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/sun.svg';
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('dark-mode-icon').src = '/images/icons/moon.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/moon.svg';
        }
    }

    // Apply dark mode on initial load
    applyDarkMode();

    // Toggle dark mode and save preference to localStorage
    document.getElementById('dark-mode-toggle').addEventListener('click', () => {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('dark-mode', 'disabled');
            document.getElementById('dark-mode-icon').src = '/images/icons/moon.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/moon.svg';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('dark-mode', 'enabled');
            document.getElementById('dark-mode-icon').src = '/images/icons/sun.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/sun.svg';
        }
    });

    document.getElementById('responsive-dark-mode-toggle').addEventListener('click', () => {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('dark-mode', 'disabled');
            document.getElementById('dark-mode-icon').src = '/images/icons/moon.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/moon.svg';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('dark-mode', 'enabled');
            document.getElementById('dark-mode-icon').src = '/images/icons/sun.svg';
            document.getElementById('responsive-dark-mode-icon').src = '/images/icons/sun.svg';
        }
    });
</script>
