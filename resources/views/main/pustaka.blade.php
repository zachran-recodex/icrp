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

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Pustaka</h2>
                <p class="text-gray-600">
                    Jelajahi berita dan artikel yang membahas dialog lintas agama, perdamaian, serta inisiatif kolaboratif dalam membangun harmoni di Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <div class="flex w-full justify-center">
                    <img src="{{ asset('images/book.png') }}"
                         alt="" class="w-[281px] h-[333px] object-cover rounded-lg">
                </div>
                <div class="col-span-2">
                    <h2 class="text-2xl text-primary-500 font-bold mb-4">Sang Pelintas Batas: Biografi Djohan Effendi</h2>
                    <p class="text-gray-600">
                        Djohan Effendi adalah salah satu sosok penting dalam upaya pengembangan kehidupan keagamaan yang lebih dialogis, harmonis, dan toleran dalam era Indonesia modern. Kehidupan keagamaan-baik intra maupun antaragama- seperti itu tentu saja merupakan kebutuhan yang senantiasa harus diperjuangkan, bukan hanya untuk umat beragama itu sendiri, tapi juga untuk kepentingan keberlanjutan negara-bangsa Indonesia Kesediaan pak Djohan ikut berjuang menegakkan hak-hak kebebasan beragama di Indonesia tidaklah setengah-setengah melainkan all-out. Ini dilakukan beliau sejak jaman Orde Baru, hingga sekarang.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Library Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">

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
