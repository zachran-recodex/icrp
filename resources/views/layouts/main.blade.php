<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @yield('meta_tag')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
              integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">

            <!-- Static sidebar for desktop -->
            <div x-data="{ isExpanded: false, tentangOpen: false }" class="hidden lg:fixed lg:inset-y-0 lg:z-[99] lg:flex bg-background-sidebar"
                 :class="{ 'lg:w-64': isExpanded, 'lg:w-16': !isExpanded }">

                <div class="flex flex-col flex-grow w-full">
                    <!-- Logo dan Judul -->
                    <div class="px-5 py-6 space-y-1">
                        <button @click="isExpanded = !isExpanded"
                                class="flex items-center space-x-3 hover:text-white/80 transition-colors duration-200">
                            <i class="fa-solid fa-bars text-white/60 w-6 h-6"></i>
                        </button>
                        <h1 x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="text-white text-xl font-semibold leading-tight">
                            Indonesian<br>Conference<br>of Religion and<br>Peace
                        </h1>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 px-3 mt-3 space-y-1">
                        <!-- Beranda -->
                        <a href="{{ route('beranda') }}"
                           class="flex items-center space-x-3 px-3 py-2 text-white/60 hover:text-white rounded-lg
                            transition-colors duration-200">
                            <i class="fa-solid fa-house w-6 h-6"></i>
                            <span x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  class="text-sm">Beranda</span>
                        </a>

                        <!-- Tentang ICRP dengan Submenu -->
                        <div class="space-y-1">
                            <button @click="tentangOpen = !tentangOpen"
                                    class="flex items-center w-full px-3 py-2 text-white/60 hover:text-white rounded-lg
                                transition-colors duration-200">
                                <i class="fa-solid fa-circle-info w-6 h-6"></i>
                                <div x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                     class="flex items-center justify-between w-full ml-3">
                                    <span class="text-sm">Tentang ICRP</span>
                                    <i class="fa-solid" :class="tentangOpen ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
                                </div>
                            </button>

                            <!-- Submenu -->
                            <div x-show="isExpanded && tentangOpen"
                                 x-transition:enter="transition-all duration-200 ease-out"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0" class="pl-11 space-y-1">
                                <a href="{{ route('tentang') }}"
                                   class="block py-2 text-sm text-white/60 hover:text-white transition-colors
                                    duration-200">
                                    Siapa Kami
                                </a>
                                <a href="{{ route('pendiri') }}"
                                   class="block py-2 text-sm text-white/60 hover:text-white transition-colors
                                    duration-200">
                                    Profil Pendiri ICRP
                                </a>
                                <a href="{{ route('pengurus') }}"
                                   class="block py-2 text-sm text-white/60 hover:text-white transition-colors
                                    duration-200">
                                    Pengurus ICRP
                                </a>
                                <a href="{{ route('kontak') }}"
                                   class="block py-2 text-sm text-white/60 hover:text-white transition-colors
                                    duration-200">
                                    Kontak Kami
                                </a>
                            </div>
                        </div>

                        <!-- Sahabat ICRP -->
                        <a href="{{ route('sahabat') }}" class="flex items-center space-x-3 px-3 py-2 text-white/60
                        hover:text-white rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-users w-6 h-6"></i>
                            <span x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  class="text-sm">Sahabat ICRP</span>
                        </a>

                        <!-- Network -->
                        <a href="{{ route('jaringan') }}" class="flex items-center space-x-3 px-3 py-2 text-white/60
                        hover:text-white rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-network-wired w-6 h-6"></i>
                            <span x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  class="text-sm">Jaringan</span>
                        </a>

                        <!-- Berita -->
                        <a href="{{ route('berita') }}" class="flex items-center space-x-3 px-3 py-2 text-white/60
                        hover:text-white rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-newspaper w-6 h-6"></i>
                            <span x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  class="text-sm">Berita</span>
                        </a>

                        <!-- Pustaka -->
                        <a href="{{ route('pustaka') }}"
                           class="flex items-center space-x-3 px-3 py-2 text-white/60 hover:text-white rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-book w-6 h-6"></i>
                            <span x-show="isExpanded" x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  class="text-sm">Pustaka</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Content -->
            <div class="lg:pl-16">
                <header class="lg:pl-16 absolute top-0 right-0 left-0 bg-transparent z-50">
                    <div class="container mx-auto px-12 py-4">
                        <div class="flex items-center justify-center">
                            <img class="h-12" src="{{ asset('images/logo.png') }}" alt="Logo ICRP">
                        </div>
                    </div>
                </header>

                {{ $slot }}

                <!-- Footer -->
                <footer class="bg-background-footer text-white">
                    <!-- Main Footer -->
                    <div class="container mx-auto px-4 pt-16 pb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <!-- Organization Info -->
                            <div class="space-y-4">
                                <img class="h-12" src="{{ asset('images/logo.png') }}" alt="Logo ICRP">
                                <p class="text-gray-400">
                                    Indonesian Conference on Religion and Peace (ICRP) adalah organisasi yang
                                    berdedikasi untuk membangun dialog antar agama dan mempromosikan perdamaian di
                                    Indonesia.
                                </p>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-primary transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div>
                                <h4 class="text-lg font-semibold mb-6">Menu</h4>
                                <nav class="space-y-3">
                                    <a href="#"
                                       class="block text-gray-400 hover:text-primary transition">Beranda</a>
                                    <a href="#" class="block text-gray-400 hover:text-primary transition">Tentang
                                        ICRP</a>
                                    <a href="#" class="block text-gray-400 hover:text-primary transition">Sahabat
                                        ICRP</a>
                                    <a href="#"
                                       class="block text-gray-400 hover:text-primary transition">Network</a>
                                    <a href="#" class="block text-gray-400 hover:text-primary transition">Berita
                                        & Artikel</a>
                                    <a href="#"
                                       class="block text-gray-400 hover:text-primary transition">Pustaka</a>
                                </nav>
                            </div>

                            <!-- Contact Info -->
                            <div>
                                <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-primary mt-1" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-400">
                                            Jl. Pemuda No. 123<br>
                                            Jakarta Pusat, 10150<br>
                                            Indonesia
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span class="text-gray-400">+62 21 1234 5678</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-400">info@icrp.id</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Newsletter -->
                            <div>
                                <h4 class="text-lg font-semibold mb-6">Newsletter</h4>
                                <p class="text-gray-400 mb-4">Berlangganan newsletter kami untuk mendapatkan informasi
                                    terbaru.</p>
                                <form class="space-y-3">
                                    <div class="flex">
                                        <input type="email" placeholder="Alamat Email"
                                               class="flex-1 px-4 py-2 rounded-l-lg bg-background-footer border border-gray-700 text-white focus:outline-none focus:border-primary">
                                        <button type="submit"
                                                class="px-4 py-2 bg-primary text-white rounded-r-lg hover:bg-primary/90 transition">
                                            Subscribe
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Footer -->
                    <div class="border-t border-gray-800">
                        <div class="container mx-auto px-4 py-6">
                            <div class="flex flex-col md:flex-row justify-between items-center">
                                <p class="text-gray-400 text-sm">
                                    © 2025 Indonesian Conference on Religion and Peace (ICRP). All rights reserved.
                                </p>
                                <div class="flex space-x-6 mt-4 md:mt-0">
                                    <a href="#" class="text-sm text-gray-400 hover:text-primary transition">Privacy
                                        Policy</a>
                                    <a href="#" class="text-sm text-gray-400 hover:text-primary transition">Terms of
                                        Service</a>
                                    <a href="#"
                                       class="text-sm text-gray-400 hover:text-primary transition">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

            @livewireScripts
        </div>
    </body>
</html>
