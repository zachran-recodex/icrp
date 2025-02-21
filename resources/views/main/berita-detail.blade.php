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
