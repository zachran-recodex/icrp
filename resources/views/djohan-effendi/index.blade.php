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

    <meta name="robots" content="">
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
                    Pustaka Djohan Effendi
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
</x-main-layout>
