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
                    {{ $heroSection?->title ?? 'Profil Pengurus ICRP' }}
                </h1>
                @if($heroSection?->subtitle)
                    <p class="text-lg text-white/90 mb-8">
                        {{ $heroSection->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Members Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Profil Pengurus ICRP</h2>
                <p class="text-lg text-gray-600">
                    Para pemimpin yang berdedikasi dalam membangun perdamaian dan dialog antarumat beragama di Indonesia
                </p>
            </div>

            @if($members->isNotEmpty())
                @php
                    $categories = $members->groupBy('dewan_category');
                    $categoryOrder = ['direktur eksekutif', 'pengurus harian', 'pengurus', 'pembina', 'pengawas', 'kehormatan'];
                    $sortedCategories = collect($categoryOrder)->mapWithKeys(function($category) use ($categories) {
                        return [$category => $categories->get($category)];
                    })->filter();
                @endphp

                @foreach($sortedCategories as $categoryName => $categoryMembers)
                    @if($categoryMembers->isNotEmpty())
                        <!-- Category Header -->
                        <div class="mb-12">
                            <h3 class="text-2xl font-bold text-primary-700 mb-8 text-center">
                                {{ ucwords($categoryName) }}
                            </h3>

                            <!-- Members Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($categoryMembers as $member)
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                                        <!-- Member Photo -->
                                        <div class="aspect-[4/5] overflow-hidden">
                                            @if($member->photo)
                                                <img src="{{ Storage::url($member->photo) }}" 
                                                     alt="{{ $member->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                    <i class="fa-solid fa-user text-6xl text-primary-300"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Member Info -->
                                        <div class="p-6">
                                            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $member->name }}</h4>
                                            
                                            @if($member->nickname)
                                                <p class="text-sm text-primary-600 font-medium mb-2">"{{ $member->nickname }}"</p>
                                            @endif

                                            @if($member->position)
                                                <p class="text-sm text-gray-600 mb-3">{{ $member->position }}</p>
                                            @endif

                                            @if($member->known_as)
                                                <p class="text-sm text-gray-600 mb-3">{{ $member->known_as }}</p>
                                            @endif

                                            <div class="text-sm text-gray-500 mb-4">
                                                @if($member->birth_date)
                                                    <p>{{ $member->birth_place ? $member->birth_place . ', ' : '' }}{{ $member->birth_date->format('d M Y') }}</p>
                                                @endif
                                                @if($member->death_date)
                                                    <p>Wafat: {{ $member->death_date->format('d M Y') }}</p>
                                                    <p class="text-xs">({{ $member->age }} tahun)</p>
                                                @endif
                                            </div>

                                            @if($member->quote)
                                                <blockquote class="text-sm italic text-gray-600 border-l-4 border-primary-300 pl-4 mb-4">
                                                    "{{ Str::limit($member->quote, 100) }}"
                                                </blockquote>
                                            @endif

                                            <a href="{{ route('pengurus.detail', $member->slug) }}" 
                                               class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                                                Baca Selengkapnya 
                                                <i class="fa-solid fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fa-solid fa-users text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Pengurus</h3>
                        <p class="text-gray-500">Informasi profil pengurus akan segera tersedia.</p>
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
