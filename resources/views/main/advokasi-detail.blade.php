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
                    {{ $advocacy->title }}
                </h1>
                <p class="text-lg text-white/90 mb-8">
                    Advokasi Kebebasan Beragama dan Berkeyakinan
                </p>
            </div>
        </div>
    </section>

    <!-- Advocacy Detail Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('advokasi') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-800 transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali ke Advokasi
                </a>
            </div>

            <!-- Advocacy Content -->
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left Side: Advocacy Image and Info -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-8">
                        <!-- Advocacy Image -->
                        <div class="aspect-[4/3] overflow-hidden">
                            @if($advocacy->image)
                                <img src="{{ Storage::url($advocacy->image) }}" 
                                     alt="{{ $advocacy->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <i class="fa-solid fa-comment text-8xl text-primary-300"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Advocacy Basic Info -->
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $advocacy->title }}</h2>
                            
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-calendar-days w-5 text-gray-400 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-700">Dipublikasikan</div>
                                        <div class="text-gray-600">{{ $advocacy->created_at->format('d F Y') }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <i class="fa-solid fa-tag w-5 text-gray-400 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-700">Kategori</div>
                                        <div class="text-gray-600">Advokasi KBB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Advocacy Content -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center text-white">
                                <i class="fa-solid fa-comment text-xl"></i>
                            </div>
                            <h3 class="ml-4 text-2xl font-bold text-gray-800">Isi Advokasi</h3>
                        </div>

                        @if($advocacy->content)
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $advocacy->content !!}
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="fa-solid fa-file-lines text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">Konten advokasi akan segera tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Advocacies Section -->
    @if($relatedAdvocacies->isNotEmpty())
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <!-- Section Header -->
                <div class="max-w-3xl mx-auto text-center mb-12">
                    <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Advokasi Terkait</h2>
                    <p class="text-lg text-gray-600">
                        Program advokasi lainnya yang mungkin menarik untuk Anda
                    </p>
                </div>

                <!-- Related Advocacies Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedAdvocacies as $relatedAdvocacy)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                            <!-- Advocacy Image -->
                            <div class="aspect-[4/3] overflow-hidden relative">
                                @if($relatedAdvocacy->image)
                                    <img src="{{ Storage::url($relatedAdvocacy->image) }}" 
                                         alt="{{ $relatedAdvocacy->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                        <i class="fa-solid fa-comment text-6xl text-primary-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Advocacy Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $relatedAdvocacy->title }}</h3>
                                
                                @if($relatedAdvocacy->content)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($relatedAdvocacy->content), 120) }}
                                    </p>
                                @endif

                                <div class="text-sm text-gray-500 mb-4">
                                    <p>{{ $relatedAdvocacy->created_at->format('d M Y') }}</p>
                                </div>

                                <a href="{{ route('advokasi.detail', $relatedAdvocacy->slug) }}" 
                                   class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                                    Baca Selengkapnya 
                                    <i class="fa-solid fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
