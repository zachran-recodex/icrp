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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="robots" content="index, follow">
@endsection

<x-main-layout>
    <!-- Hero Section -->
    <x-hero-section :title="$heroSection->title" :image="$heroSection->image" />

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">

            <!-- Featured Article -->
            <div class="flex justify-center mt-16">
                <div class="relative rounded-2xl w-[706px] h-[405px]">
                    <img src="{{ asset('images/sahabat.png') }}" alt="Featured News"
                        class="w-[706px] h-[405px] object-cover">
                    <div class="absolute -top-20 -right-20">
                        <img src="{{ asset('images/boox.png') }}" alt="Featured News"
                             class="w-[365px] h-[197px] object-cover">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <x-call-to-action
        :title="$callToAction->title"
        :subtitle="$callToAction->subtitle"
        :image="$callToAction->image"
        :button-text="$callToAction->button_text"
        :button-link="route('kontak')"
    />
</x-main-layout>
