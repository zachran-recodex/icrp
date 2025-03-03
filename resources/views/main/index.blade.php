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
            <img src="{{ Storage::url('hero/' . $heroSection->image) }}" alt="{{ $heroSection->title }}"
                class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Content Overlay -->
        <div class="container mx-auto px-4 relative z-20 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    {{ $heroSection->title }}
                </h1>
                <p class="text-lg text-white/90 mb-8">
                    {{ $heroSection->subtitle }}
                </p>
                <a href="{{ route('tentang') }}"
                    class="inline-block bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-lg text-lg font-semibold transition transform hover:scale-105">
                    Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- News & Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Berita & Artikel</h2>
                <p class="text-gray-600">
                    Jelajahi berita dan artikel yang membahas dialog lintas agama, perdamaian, serta inisiatif kolaboratif dalam membangun harmoni di Indonesia.
                </p>
            </div>

            <!-- Featured News & Articles -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('berita.detail', $featuredArticle->slug) }}" class="relative w-[1000px] h-[476px]">
                    <!-- Gambar Artikel -->
                    <img src="{{ Storage::url('articles/' . $featuredArticle->image) }}"
                         alt="{{ $featuredArticle->title }}" class="w-full h-full object-cover rounded-lg">

                    <!-- Badge Kategori -->
                    <div class="absolute top-4 left-4 bg-primary-500 z-10 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $featuredArticle->category->title }}
                    </div>

                    <!-- Overlay & Konten -->
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-8 rounded-lg">
                        <h2 class="text-white text-xl font-bold mb-3">
                            {{ $featuredArticle->title }}
                        </h2>
                        <p class="text-gray-300">
                            {{ Str::limit(strip_tags($featuredArticle->content), 150) }}
                        </p>
                    </div>
                </a>
            </div>

            <!-- Slider News & Article -->
            <div x-data="{
                    currentIndex: 0,
                    totalSlides: 3,
                    next() {
                        this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
                    },
                    prev() {
                        this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
                    },
                    goToSlide(index) {
                        this.currentIndex = index;
                    }
                }" class="relative">
                <div class="overflow-hidden">
                    <div class="pb-4 flex transition-transform duration-700 ease-in-out"
                         :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">

                        <!-- Looping artikel -->
                        @foreach ($articles->chunk(3) as $chunkedArticles)
                            <div class="w-full flex-none grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach ($chunkedArticles as $article)
                                    <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                                        <div class="relative h-64">
                                            <!-- Gambar Artikel -->
                                            <img src="{{ Storage::url('articles/' . $article->image) }}"
                                                 alt="News" class="w-full h-full object-cover">

                                            <!-- Badge Kategori -->
                                            <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                                {{ $article->category->title }}
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h4 class="text-xl font-semibold mb-3">{{ $article->title }}</h4>
                                            <p class="text-gray-600 mb-3">
                                                {{ Str::limit(strip_tags($article->content), 150) }}
                                            </p>
                                            <a href="{{ route('berita.detail', $article->slug) }}" class="text-primary hover:text-primary/80 font-medium text-sm">
                                                Baca Selengkapnya →
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Indicator Dots -->
                <div class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <template x-for="(_, index) in totalSlides" :key="index">
                        <button @click="goToSlide(index)"
                                :class="{
                    'w-3 h-3 rounded-full bg-primary': currentIndex === index,
                    'w-3 h-3 rounded-full bg-primary/50': currentIndex !== index
                }"
                                class="transition-colors duration-300"></button>
                    </template>
                </div>
            </div>

        </div>
    </section>

    <!-- Events Section -->
    <section class="py-20 bg-primary-50">
        <div class="container mx-auto px-4">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Agenda Mendatang</h2>
                <p class="text-gray-600">
                    Ikuti berbagai agenda dan diskusi bermakna yang mendorong dialog lintas agama, perdamaian, serta kerja sama dalam membangun harmoni di Indonesia.
                </p>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($events as $event)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative">
                            <img src="{{ Storage::url('events/' . $event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-sm">
                                {{ $event->date->format('d F Y') }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-3">{{ $event->title }}</h3>
                            <p class="text-gray-600">
                                {{ Str::limit(strip_tags($event->description), 100) }}
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500 mt-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $event->time->format('H:i') }} WIB</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

{{--    <!-- Videos Section -->--}}
{{--    <section class="py-20 bg-white">--}}
{{--        <div class="container mx-auto px-4">--}}
{{--            <div class="flex flex-col md:flex-row gap-8">--}}
{{--                <!-- Featured Video -->--}}
{{--                <div class="w-full md:w-1/2">--}}
{{--                    <div class="relative rounded-xl overflow-hidden aspect-video">--}}
{{--                        <img src="{{ asset('images/hero.jpeg') }}" alt="Featured Video"--}}
{{--                            class="w-full h-full object-cover">--}}
{{--                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">--}}
{{--                            <button--}}
{{--                                class="w-16 h-16 bg-white/25 rounded-full flex items-center justify-center hover:bg-white/40 transition">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"--}}
{{--                                    viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
{{--                                </svg>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Video Slider -->--}}
{{--                <div class="w-full md:w-1/2">--}}
{{--                    <div x-data="{--}}
{{--                        activeSlide: 0,--}}
{{--                        slides: [0, 1, 2],--}}
{{--                        init() {--}}
{{--                            setInterval(() => {--}}
{{--                                this.activeSlide = (this.activeSlide + 1) % 2;--}}
{{--                            }, 5000);--}}
{{--                        }--}}
{{--                    }" class="relative">--}}
{{--                        <div class="overflow-hidden">--}}
{{--                            <div class="pb-4 flex transition-transform duration-700 ease-in-out"--}}
{{--                                :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">--}}
{{--                                <!-- First Slide -->--}}
{{--                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                                    <template x-for="i in 2">--}}
{{--                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">--}}
{{--                                            <div class="relative h-64">--}}
{{--                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"--}}
{{--                                                    class="w-full h-full object-cover">--}}
{{--                                            </div>--}}
{{--                                            <div class="p-6">--}}
{{--                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP--}}
{{--                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>--}}
{{--                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </template>--}}
{{--                                </div>--}}

{{--                                <!-- Second Slide -->--}}
{{--                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                                    <template x-for="i in 2">--}}
{{--                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">--}}
{{--                                            <div class="relative h-64">--}}
{{--                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"--}}
{{--                                                    class="w-full h-full object-cover">--}}
{{--                                            </div>--}}
{{--                                            <div class="p-6">--}}
{{--                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP--}}
{{--                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>--}}
{{--                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </template>--}}
{{--                                </div>--}}

{{--                                <!-- Third Slide -->--}}
{{--                                <div class="w-full flex-none grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                                    <template x-for="i in 2">--}}
{{--                                        <div class="bg-white rounded-xl overflow-hidden shadow-lg">--}}
{{--                                            <div class="relative h-64">--}}
{{--                                                <img src="{{ asset('images/hero.jpeg') }}" alt="News"--}}
{{--                                                    class="w-full h-full object-cover">--}}
{{--                                            </div>--}}
{{--                                            <div class="p-6">--}}
{{--                                                <h4 class="text-xl font-semibold mb-3">Minister of Religion and ICRP--}}
{{--                                                    Agree to Strengthen Interfaith Harmony in Indonesia</h4>--}}
{{--                                                <p class="text-gray-600 mb-4">Inauguration of ICRP Management</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </template>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Slider Navigation Dots -->--}}
{{--                        <div class="flex justify-center mt-8 space-x-2">--}}
{{--                            <template x-for="(slide, index) in slides" :key="index">--}}
{{--                                <button class="w-3 h-3 rounded-full transition-opacity duration-200"--}}
{{--                                    :class="{--}}
{{--                                        'bg-primary opacity-100': activeSlide ===--}}
{{--                                            index,--}}
{{--                                        'bg-primary opacity-50': activeSlide !== index--}}
{{--                                    }"--}}
{{--                                    @click="activeSlide = index"></button>--}}
{{--                            </template>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- Library Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Pustaka</h2>
                <p class="text-gray-600">
                    Eksplorasi koleksi buku-buku kami tentang dialog antar agama dan kerukunan umat beragama
                </p>
            </div>

            <!-- Regular Collection -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                @foreach($libraries as $library)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg transition hover:shadow-xl">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img src="{{ Storage::url('libraries/' . $library->image) }}" alt="{{ $library->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <span class="text-sm text-white/80">Religious Studies</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $library->title }}</h3>
                            <p class="text-gray-600 mb-4">Penulis: {{ $library->author }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">2023</span>
                                <a href="{{ route('pustaka.detail', $library->slug) }}" class="text-primary hover:text-primary/80 font-medium text-sm">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="{{ route('pustaka') }}"
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
            <img src="{{ Storage::url('cta/' . $callToAction->image) }}" alt="{{ $callToAction->title }}" class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-primary-950/70"></div>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                    {{ $callToAction->title }}
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    {{ $callToAction->subtitle }}
                </p>
                <a href="{{ route('kontak') }}"
                    class="inline-block px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition transform hover:scale-105">
                    {{ $callToAction->button_text }}
                </a>
            </div>
        </div>
    </section>
</x-main-layout>
