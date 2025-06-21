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
                    {{ $heroSection?->title ?? 'Berita & Artikel ICRP' }}
                </h1>
                @if($heroSection?->subtitle)
                    <p class="text-lg text-white/90 mb-8">
                        {{ $heroSection->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Berita & Artikel</h2>
                <p class="text-lg text-gray-600">
                    Jelajahi berita dan artikel yang membahas dialog lintas agama, perdamaian, serta inisiatif kolaboratif dalam membangun harmoni di Indonesia.
                </p>
            </div>

            @if($articles->isNotEmpty())
                <!-- Articles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                            <!-- Article Image -->
                            <div class="aspect-[4/3] overflow-hidden relative">
                                @if($article->image)
                                    <img src="{{ Storage::url('articles/' . $article->image) }}" 
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                        <i class="fa-solid fa-newspaper text-6xl text-primary-300"></i>
                                    </div>
                                @endif
                                
                                <!-- Category Badge -->
                                @if($article->articleCategory)
                                    <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $article->articleCategory->title }}
                                    </div>
                                @endif
                            </div>

                            <!-- Article Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $article->title }}</h3>
                                
                                @if($article->content)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($article->content), 120) }}
                                    </p>
                                @endif

                                <div class="text-sm text-gray-500 mb-4">
                                    <p>{{ $article->created_at->format('d M Y') }}</p>
                                </div>

                                <a href="{{ route('artikel.detail', $article->slug) }}" 
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
                        <i class="fa-solid fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
                        <p class="text-gray-500">Artikel dan berita akan segera tersedia.</p>
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
