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
    <x-hero-section :title="$heroSection->title" :image="$heroSection->image" />

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 space-y-12">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Jajaran Pendiri ICRP</h2>
            </div>

            <!-- Founders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($founders as $founder)
                    <div class="flex flex-col items-center text-center p-4">
                        <div class="w-32 h-32 mb-4">
                            <img src="{{ Storage::url('founders/' . $founder->image) }}" alt="{{ $founder->name }}"
                                 class="w-full h-full rounded-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $founder->name }}</h3>
                        <p class="text-primary-600 mb-2">{{ $founder->position }}</p>
                        <p class="text-sm text-gray-600 max-w-sm">
                            {{ Str::limit(strip_tags($founder->description), 100) }}
                        </p>
                    </div>
                @endforeach
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
