@section('meta_tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <meta name="google-site-verification" content="">

    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">

    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">

    <link rel="canonical" href="">

    <meta name="theme-color" content="#FD38EC">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="robots" content="index, follow">
@endsection

<x-main-layout>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpeg') }}" alt="Hero Background" class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Content Overlay -->
        <div class="container mx-auto px-4 relative z-20 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    House of Peace
                </h1>
                <p class="text-lg text-white/90 mb-8">
                    Dialog Antar Agama, Kemanusiaan dan Persaudaraan Lintas Iman, Rumah Perdamaian, Agama untuk
                    Perdamaian, Demokrasi
                </p>
                <a href="#contact"
                    class="inline-block bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-lg
                  text-lg font-semibold transition transform hover:scale-105">
                    Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- News & Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

        </div>
    </section>

    <!-- Events Section -->
    <section class="py-20 bg-primary-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Upcoming Events</h2>
                <p class="text-gray-600">Join us in our upcoming events and be part of meaningful discussions and
                    activities that promote interfaith harmony and understanding in Indonesia.</p>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Event 1" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-sm">
                            25 Feb 2025
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Interfaith Dialogue Forum</h3>
                        <p class="text-gray-600 mb-4">Join religious leaders and scholars in a meaningful discussion
                            about fostering religious harmony.</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>14:00 WIB</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Jakarta</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Event 2" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-sm">
                            15 Mar 2025
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Youth Peace Workshop</h3>
                        <p class="text-gray-600 mb-4">Empowering young leaders to become advocates for religious
                            tolerance and peace.</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>09:00 WIB</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Bandung</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Event 3" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-sm">
                            05 Apr 2025
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Community Outreach Program</h3>
                        <p class="text-gray-600 mb-4">Building bridges between communities through cultural exchange
                            and dialogue.</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>10:00 WIB</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Surabaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Videos Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Featured Video -->
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-xl overflow-hidden aspect-video">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Featured Video"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <button
                                class="w-16 h-16 bg-white/25 rounded-full flex items-center justify-center hover:bg-white/40 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Video Slider -->
                <div class="w-full md:w-1/2">
                    <div x-data="{
                        activeSlide: 0,
                        slides: [0, 1, 2],
                        init() {
                            setInterval(() => {
                                this.activeSlide = (this.activeSlide + 1) % 2;
                            }, 5000);
                        }
                    }" class="relative">
                        <div class="overflow-hidden">
                            <div class="pb-4 flex transition-transform duration-700 ease-in-out"
                                :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                                <!-- First Slide -->
                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <template x-for="i in 2">
                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                                            <div class="relative h-64">
                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-6">
                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP
                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>
                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Second Slide -->
                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <template x-for="i in 2">
                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                                            <div class="relative h-64">
                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-6">
                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP
                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>
                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Third Slide -->
                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <template x-for="i in 2">
                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                                            <div class="relative h-64">
                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-6">
                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP
                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>
                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Navigation Dots -->
                        <div class="flex justify-center mt-8 space-x-2">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button class="w-3 h-3 rounded-full transition-opacity duration-200"
                                    :class="{
                                        'bg-primary opacity-100': activeSlide ===
                                            index,
                                        'bg-primary opacity-50': activeSlide !== index
                                    }"
                                    @click="activeSlide = index"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Library Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Pustaka</h2>
                <p class="text-gray-600">Eksplorasi koleksi buku-buku kami tentang dialog antar agama dan kerukunan
                    umat beragama</p>
            </div>

            <!-- Djohan Effendi Special Collection -->
            <div class="mb-16">
                <div class="max-w-3xl mx-auto text-center mb-8">
                    <h3 class="text-2xl font-bold text-primary">Koleksi Khusus Djohan Effendi</h3>
                    <p class="text-gray-600 mt-2">Karya-karya terpilih dari cendekiawan Muslim Indonesia</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Djohan's Book 1 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('images/hero.jpeg') }}" alt="Pembaruan Pemikiran Islam"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <span class="text-sm text-white/80">Pemikiran Islam</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold mb-4">Pembaruan Pemikiran Islam</h4>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">2023</span>
                                <a href="{{ route('djohan-effendi') }}"
                                    class="text-primary hover:text-primary/80 font-medium text-sm">Baca Selengkapnya
                                    →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Djohan's Book 2 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('images/hero.jpeg') }}" alt="Islam dan Pluralisme"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <span class="text-sm text-white/80">Pluralisme</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold mb-4">Islam dan Pluralisme Agama</h4>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">2023</span>
                                <a href="{{ route('djohan-effendi') }}"
                                    class="text-primary hover:text-primary/80 font-medium text-sm">Baca Selengkapnya
                                    →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Djohan's Book 3 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('images/hero.jpeg') }}" alt="Dialog Lintas Agama"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <span class="text-sm text-white/80">Dialog Agama</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold mb-4">Dialog Lintas Agama</h4>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">2023</span>
                                <a href="{{ route('djohan-effendi') }}"
                                    class="text-primary hover:text-primary/80 font-medium text-sm">Baca Selengkapnya
                                    →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Djohan's Book 4 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('images/hero.jpeg') }}" alt="Sufisme dan Modernitas"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <span class="text-sm text-white/80">Sufisme</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold mb-4">Sufisme dan Modernitas</h4>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">2023</span>
                                <a href="{{ route('djohan-effendi') }}"
                                    class="text-primary hover:text-primary/80 font-medium text-sm">Baca Selengkapnya
                                    →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regular Collection -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Book Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Book 1"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="text-sm text-white/80">Religious Studies</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Dialog Antar Agama</h3>
                        <p class="text-gray-600 mb-4">Penulis: Dr. Ahmad Syafii Maarif</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">2023</span>
                            <a href="#" class="text-primary hover:text-primary/80 font-medium text-sm">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Book Card 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Book 2"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="text-sm text-white/80">Peace Studies</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Harmoni dalam Keberagaman</h3>
                        <p class="text-gray-600 mb-4">Penulis: Prof. Maria Sukmawati</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">2024</span>
                            <a href="#" class="text-primary hover:text-primary/80 font-medium text-sm">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Book Card 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Book 3"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="text-sm text-white/80">Social Studies</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Membangun Toleransi</h3>
                        <p class="text-gray-600 mb-4">Penulis: Dr. Haedar Nashir</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">2024</span>
                            <a href="#" class="text-primary hover:text-primary/80 font-medium text-sm">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="#"
                    class="inline-block px-8 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition transform hover:scale-105">
                    Lihat Semua Buku
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpeg') }}" alt="CTA Background" class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-primary-950/70"></div>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                    Mari Bergabung Bersama ICRP
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    Jadilah bagian dari gerakan membangun kerukunan umat beragama di Indonesia. Bersama kita wujudkan
                    masyarakat yang toleran dan harmonis.
                </p>
                <a href="#"
                    class="inline-block px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition transform hover:scale-105">
                    Bergabung Sekarang
                </a>
            </div>
        </div>
    </section>
</x-main-layout>
