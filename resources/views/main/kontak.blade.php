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

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Alamat & Kontak -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Alamat :</h3>
                    <p class="font-bold text-primary">Rumah Perdamaian</p>
                    <p>Jl. Cempaka Putih Barat XXI No. 34<br>Jakarta Pusat 10520</p>

                    <p class="mt-4">Telp. 021-42802349<br>icrp.indonesia@gmail.com<br>info@icrp.id</p>

                    <!-- Sosial Media -->
                    <div class="mt-6 flex items-center gap-4">
                        <a href="https://instagram.com/icrp.indonesia" target="_blank"
                            class="text-gray-700 hover:text-primary-500">
                            <i class="fab fa-instagram text-2xl"></i> @icrp.indonesia
                        </a>
                        <a href="https://facebook.com/icrp.indonesia" target="_blank"
                            class="text-gray-700 hover:text-primary-500">
                            <i class="fab fa-facebook text-2xl"></i> icrp.indonesia
                        </a>
                    </div>
                </div>

                <!-- Google Maps -->
                <div>
                    <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.633068725179!2d106.8659217!3d-6.179844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4ff60232a8b%3A0xc77634900d08328d!2sIndonesian%20Conference%20on%20Religion%20and%20Peace%20(ICRP)!5e0!3m2!1sid!2sid!4v1740990622369!5m2!1sid!2sid">
                    </iframe>
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
