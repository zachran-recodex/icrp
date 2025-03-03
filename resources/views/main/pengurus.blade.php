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
        <div class="container mx-auto px-4 space-y-12">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h2 class="text-3xl md:text-4xl text-primary-500 font-bold mb-4">Pengurus ICRP</h2>
                <p class="text-gray-600">
                    Berikut ini adalah para pengurus yang menjalankan ICRP, menjalankan misi perdamaian,
                    kerukunan dan dialog antaragama di Indonesia.
                </p>
            </div>

            @if($dewanPengurus->count() > 0)
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Dewan Pengurus</h2>
                </div>

                <!-- Dewan Pengurus Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($dewanPengurus as $member)
                        <div class="flex flex-col items-center text-center p-4">
                            <div class="w-32 h-32 mb-4">
                                @if($member->image)
                                    <img src="{{ Storage::url('managements/' . $member->image) }}" alt="{{ $member->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-purple-600 mb-2">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 max-w-sm">{{ Str::limit(strip_tags($member->description), 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($dewanKehormatan->count() > 0)
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Dewan Kehormatan</h2>
                </div>

                <!-- Dewan Kehormatan Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($dewanKehormatan as $member)
                        <div class="flex flex-col items-center text-center p-4">
                            <div class="w-32 h-32 mb-4">
                                @if($member->image)
                                    <img src="{{ Storage::url('managements/' . $member->image) }}" alt="{{ $member->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-purple-600 mb-2">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 max-w-sm">{{ Str::limit(strip_tags($member->description), 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($dewanPembina->count() > 0)
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Dewan Pembina</h2>
                </div>

                <!-- Dewan Pembina Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($dewanPembina as $member)
                        <div class="flex flex-col items-center text-center p-4">
                            <div class="w-32 h-32 mb-4">
                                @if($member->image)
                                    <img src="{{ Storage::url('managements/' . $member->image) }}" alt="{{ $member->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-purple-600 mb-2">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 max-w-sm">{{ Str::limit(strip_tags($member->description), 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($dewanPengawas->count() > 0)
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Dewan Pengawas</h2>
                </div>

                <!-- Dewan Pengawas Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($dewanPengawas as $member)
                        <div class="flex flex-col items-center text-center p-4">
                            <div class="w-32 h-32 mb-4">
                                @if($member->image)
                                    <img src="{{ Storage::url('managements/' . $member->image) }}" alt="{{ $member->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-purple-600 mb-2">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 max-w-sm">{{ Str::limit(strip_tags($member->description), 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($dewanPengurusHarian->count() > 0)
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Dewan Pengurus Harian</h2>
                </div>

                <!-- Dewan Pengurus Harian Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($dewanPengurusHarian as $member)
                        <div class="flex flex-col items-center text-center p-4">
                            <div class="w-32 h-32 mb-4">
                                @if($member->image)
                                    <img src="{{ Storage::url('managements/' . $member->image) }}" alt="{{ $member->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-purple-600 mb-2">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 max-w-sm">{{ Str::limit(strip_tags($member->description), 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
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
