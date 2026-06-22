<div class="container mx-auto px-5 py-5   justify-center flex" x-data="{ mobileMenuOpen: false, currentPath: window.location.pathname }">
    <!-- Hamburger Button -->
    <button @click="mobileMenuOpen = true"
        class="mobile-menu-button fixed top-5 right-5 z-30 p-2 text-black transition-all duration-200 hover:scale-105 lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="flex gap-5 w-full items-start sticky">
        <!-- Desktop Sidebar -->
        <aside
            class="desktop-sidebar w-64 bg-white rounded-sm  hover:shadow-md transition-shadow duration-300 border border-mist-200">
            <!-- Navigation Menu -->
            <div class="py-5" wire:navigate>
                <!-- Dashboard -->
                <a href="/admin/" class="menu-item flex items-center gap-3 px-4 py-3"
                    :class="currentPath == ('/admin/') ? 'bg-amber-50 text-amber-600 border-r-3' :
                        'text-gray-600 hover:bg-amber-50 hover:text-amber-600'"
                    wire:navigate>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="">داشبورد</span>
                </a>

                <!-- Orders -->
                <a href="/admin/orders" class="menu-item flex items-center gap-3 px-4 py-3"
                    :class="currentPath == ('/admin/orders') ? 'bg-amber-50 text-amber-600 border-r-3' :
                        'text-gray-600 hover:bg-amber-50 hover:text-amber-600'"
                    wire:navigate>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>سفارشات</span>
                    {{-- <span class="mr-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        12
                    </span> --}}
                </a>

                <!-- Products -->
                <a href="/admin/services" class="menu-item flex items-center gap-3 px-4 py-3"
                    :class="currentPath == ('/admin/services') ? 'bg-amber-50 text-amber-600 border-r-3' :
                        'text-gray-600 hover:bg-amber-50 hover:text-amber-600'"
                    wire:navigate>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>محصولات</span>
                </a>

                <!-- Users -->
                <a href="/admin/users" class="menu-item flex items-center gap-3 px-4 py-3"
                    :class="currentPath == ('/admin/users') ? 'bg-amber-50 text-amber-600 border-r-3' :
                        'text-gray-600 hover:bg-amber-50 hover:text-amber-600'"
                    wire:navigate>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span>کاربران</span>
                </a>

                <!-- Reports -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3  text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span>گزارشات</span>
                </a>

                <!-- Settings -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3  text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>تنظیمات</span>
                </a>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 "></div>

            <form method="POST" action="{{ route('admin.logout') }}"">
                @csrf
                <button type="submit"
                    class="menu-item flex items-center gap-3 px-4 py-3  text-red-600 hover:bg-red-50 w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    خروج

                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>

    <!-- Overlay -->
    <div x-show="mobileMenuOpen" x-cloak @click="mobileMenuOpen = false" x-transition.opacity.duration.300ms
        class="mobile-menu-overlay">
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transform transition duration-300 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition duration-300 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" class="mobile-menu shadow-2xl">
        <!-- <div class="p-4">
            <button @click="mobileMenuOpen = false"
                class="mb-4 p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200">
                ✕ بستن
            </button>
        </div> -->
        <aside class=" bg-white transition-shadow duration-300 flex flex-col justify-between h-full pt-20">

            <div class="p-0">
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 bg-amber-50 text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="">داشبورد</span>
                </a>

                <!-- Orders -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>سفارشات</span>
                    <span class="mr-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        12
                    </span>
                </a>

                <!-- Products -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>محصولات</span>
                </a>

                <!-- Users -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span>کاربران</span>
                </a>

                <!-- Reports -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span>گزارشات</span>
                </a>

                <!-- Settings -->
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>تنظیمات</span>
                </a>
            </div>
            <div>
                <div class="border-t border-gray-200"></div>
                <a href="#"
                    class="menu-item flex flex-1 items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>خروج</span>
                </a>
            </div>



        </aside>
    </div>
</div>

<style>
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 40;
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        width: 280px;
        background-color: white;
        z-index: 50;
        overflow-y: auto;
    }

    /* Required for transitions */
    .transform {
        transform: translateX(var(--tw-translate-x));
    }

    .translate-x-0 {
        --tw-translate-x: 0px;
    }

    .translate-x-full {
        --tw-translate-x: 100%;
    }

    .transition {
        transition-property: transform, opacity;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    @media (max-width: 1023px) {
        .desktop-sidebar {
            display: none;
        }
    }

    @media (min-width: 1024px) {

        .mobile-menu-button,
        .mobile-menu-overlay,
        .mobile-menu {
            display: none !important;
        }
    }

    [x-cloak] {
        display: none !important;
    }

    active-menu {
        border: 1px solid #000 !important
    }


    .desktop-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 20px;
        align-self: flex-start;
        /* Critical for flex children */
    }
</style>
