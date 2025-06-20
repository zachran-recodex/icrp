<x-layouts.main>
    <!-- Hero Section -->
    <section class="relative min-h-[40vh] md:min-h-[50vh] flex items-center justify-center">
        @if($heroSection?->image)
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="{{ Storage::url($heroSection->image) }}" alt="{{ $heroSection->title }}"
                     class="w-full h-full object-cover">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
        @else
            <!-- Fallback Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-800"></div>
        @endif

        <!-- Content Overlay -->
        <div class="container mx-auto px-4 relative z-20 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    {{ $heroSection?->title ?? 'Profil Pendiri ICRP' }}
                </h1>
                @if($heroSection?->subtitle)
                    <p class="text-lg text-white/90 mb-8">
                        {{ $heroSection->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Founders Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Profil Pendiri ICRP</h2>
                <p class="text-lg text-gray-600">
                    Para tokoh visioner yang mendirikan Indonesian Conference on Religion and Peace
                </p>
            </div>

            @if($founders->isNotEmpty())
                <!-- Founders Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($founders as $founder)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                            <!-- Founder Photo -->
                            <div class="aspect-[4/5] overflow-hidden">
                                @if($founder->photo)
                                    <img src="{{ Storage::url($founder->photo) }}" 
                                         alt="{{ $founder->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-6xl text-primary-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Founder Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $founder->name }}</h3>
                                
                                @if($founder->nickname)
                                    <p class="text-sm text-primary-600 font-medium mb-2">"{{ $founder->nickname }}"</p>
                                @endif

                                @if($founder->known_as)
                                    <p class="text-sm text-gray-600 mb-3">{{ $founder->known_as }}</p>
                                @endif

                                <div class="text-sm text-gray-500 mb-4">
                                    @if($founder->birth_date)
                                        <p>{{ $founder->birth_place ? $founder->birth_place . ', ' : '' }}{{ $founder->birth_date->format('d M Y') }}</p>
                                    @endif
                                    @if($founder->death_date)
                                        <p>Wafat: {{ $founder->death_date->format('d M Y') }}</p>
                                        <p class="text-xs">({{ $founder->age }} tahun)</p>
                                    @endif
                                </div>

                                @if($founder->quote)
                                    <blockquote class="text-sm italic text-gray-600 border-l-4 border-primary-300 pl-4 mb-4">
                                        "{{ Str::limit($founder->quote, 100) }}"
                                    </blockquote>
                                @endif

                                <a href="{{ route('pendiri.detail', $founder->slug) }}" 
                                   class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                                    Baca Selengkapnya 
                                    <i class="fa-solid fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fa-solid fa-users text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Pendiri</h3>
                        <p class="text-gray-500">Informasi profil pendiri akan segera tersedia.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ $callToAction?->image ? Storage::url($callToAction->image) : 'https://images.unsplash.com/photo-1529390079861-591de354faf5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}"
                 alt="{{ $callToAction?->title ?? 'Bergabung dengan Misi Perdamaian' }}"
                 class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-primary-950/70"></div>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                    {{ $callToAction?->title ?? 'Bergabunglah dengan Misi Perdamaian' }}
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    {{ $callToAction?->subtitle ?? 'Mari bersama-sama membangun dialog yang bermakna dan memperkuat persaudaraan lintas iman demi Indonesia yang damai dan harmonis' }}
                </p>
                <a href="#"
                   class="inline-block px-8 py-4 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition transform hover:scale-105">
                    {{ $callToAction?->button_text ?? 'Bergabung Sekarang' }}
                </a>
            </div>
        </div>
    </section>
</x-layouts.main>