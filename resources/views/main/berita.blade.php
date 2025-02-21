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
    <section class="relative min-h-[30vh] flex items-center justify-center">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpeg') }}" alt="Hero Background" class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    </section>

    <!-- News & Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Berita & Artikel</h2>
                <p class="text-primary-700">
                    Mengenai berita terkini mengenai konferensi agama dan perdamaian Indonesia.
                </p>
            </div>

        </div>
    </section>

    <section class="py-20 bg-primary-50">
        <div class="container mx-auto px-4">

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
