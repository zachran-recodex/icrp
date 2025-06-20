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
                    {{ $founder->name }}
                </h1>
                @if($founder->known_as)
                    <p class="text-lg text-white/90 mb-8">
                        {{ $founder->known_as }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Founder Detail Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('pendiri') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-800 transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali ke Profil Pendiri
                </a>
            </div>

            <!-- Founder Content -->
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left Side: Photo and Info -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-8">
                        <!-- Founder Photo -->
                        <div class="aspect-[4/5] overflow-hidden">
                            @if($founder->photo)
                                <img src="{{ Storage::url($founder->photo) }}" 
                                     alt="{{ $founder->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <i class="fa-solid fa-user text-8xl text-primary-300"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Founder Basic Info -->
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $founder->name }}</h2>
                            
                            @if($founder->nickname)
                                <p class="text-primary-600 font-medium mb-4">"{{ $founder->nickname }}"</p>
                            @endif

                            <div class="space-y-3 text-sm">
                                @if($founder->birth_date)
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-calendar-days w-5 text-gray-400 mr-3"></i>
                                        <div>
                                            <div class="font-medium text-gray-700">Lahir</div>
                                            <div class="text-gray-600">
                                                {{ $founder->birth_place ? $founder->birth_place . ', ' : '' }}{{ $founder->birth_date->format('d F Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($founder->death_date)
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-cross w-5 text-gray-400 mr-3"></i>
                                        <div>
                                            <div class="font-medium text-gray-700">Wafat</div>
                                            <div class="text-gray-600">
                                                {{ $founder->death_date->format('d F Y') }} ({{ $founder->age }} tahun)
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($founder->known_as)
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-star w-5 text-gray-400 mr-3"></i>
                                        <div>
                                            <div class="font-medium text-gray-700">Dikenal sebagai</div>
                                            <div class="text-gray-600">{{ $founder->known_as }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($founder->quote)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <blockquote class="text-primary-700 italic border-l-4 border-primary-300 pl-4">
                                        "{{ $founder->quote }}"
                                    </blockquote>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side: Biography -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center text-white">
                                <i class="fa-solid fa-book text-xl"></i>
                            </div>
                            <h3 class="ml-4 text-2xl font-bold text-gray-800">Biografi</h3>
                        </div>

                        @if($founder->biography)
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $founder->biography !!}
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="fa-solid fa-book-open text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">Biografi akan segera tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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