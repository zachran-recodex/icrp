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
            <img src="{{ Storage::url('hero/' . $heroSection->image) }}" alt="{{ $heroSection->title }}"
                class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    </section>

    <!-- News & Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">{{ $article->title }}</h2>
            </div>

            <!-- Featured News & Articles -->
            <div class="flex justify-center mb-8">
                <div class="relative w-[1000px] h-[476px]">
                    <!-- Gambar Artikel -->
                    <img src="{{ Storage::url('articles/' . $article->image) }}"
                         alt="{{ $article->title }}" class="w-full h-full object-cover rounded-lg">

                    <!-- Badge Kategori -->
                    <div class="absolute top-4 left-4 bg-primary-500 z-10 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $article->category->title }}
                    </div>
                </div>
            </div>

            <div class="">
                <p>
                    {{ Str::limit(strip_tags($article->content), 1000) }}
                </p>
            </div>

        </div>
    </section>

    <!-- News & Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

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
