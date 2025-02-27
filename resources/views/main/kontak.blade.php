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

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Alamat & Kontak -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Alamat :</h3>
                    <p class="font-bold text-primary-900">Rumah Perdamaian</p>
                    <p>Jl. Cempaka Putih Barat XXI No. 34<br>Jakarta Pusat 10520</p>

                    <p class="mt-4">Telp. 021-42802349<br>icrp.indonesia@gmail.com</p>

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
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.776064377371!2d106.86304067418592!3d-6.159251860550536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ff3847e4a5%3A0xb31d86a1d14431ae!2sJl.%20Cempaka%20Putih%20Barat%20XXI%20No.34%2C%20RW.5%2C%20Cemp.%20Putih%20Barat%2C%20Kec.%20Cemp.%20Putih%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010520!5e0!3m2!1sen!2sid!4v1708185483742">
                    </iframe>
                </div>
            </div>
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
s
