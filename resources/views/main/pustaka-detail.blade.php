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
        <div class="container mx-auto px-4 space-y-6">

            <!-- Tombol Back -->
            <div class="mb-6">
                <a href="{{ route('pustaka') }}" class="inline-flex items-center text-black hover:text-gray-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Pustaka
                </a>
            </div>

            <!-- Grid untuk Detail Buku -->
            <div class="grid grid-cols-3 gap-8">
                <div class="flex w-full bg-gray-200 py-8 rounded-lg justify-center">
                    <img src="{{ asset('images/book.png') }}"
                         alt="" class="w-[281px] h-[333px] object-cover rounded-lg">
                </div>
                <div class="col-span-2 space-y-8">
                    <h2 class="text-2xl text-primary-500 font-bold mb-4">{{ $library->title }}</h2>
                    <div class="grid grid-cols-2">
                        <ul>
                            <li>Bahasa :</li>
                            <li>Penulis :</li>
                            <li>Penerbit :</li>
                        </ul>
                        <ul>
                            <li>Tanggal Rilis :</li>
                            <li>Halaman :</li>
                            <li>Format :</li>
                        </ul>
                    </div>
                    <h2 class="text-xl text-primary-500 font-bold mb-4">Deskripsi Buku</h2>
                    <p class="text-gray-600">
                        Djohan Effendi adalah salah satu sosok penting dalam upaya pengembangan kehidupan keagamaan yang lebih dialogis, harmonis, dan toleran dalam era Indonesia modern. Kehidupan keagamaan-baik intra maupun antaragama- seperti itu tentu saja merupakan kebutuhan yang senantiasa harus diperjuangkan, bukan hanya untuk umat beragama itu sendiri, tapi juga untuk kepentingan keberlanjutan negara-bangsa Indonesia Kesediaan pak Djohan ikut berjuang menegakkan hak-hak kebebasan beragama di Indonesia tidaklah setengah-setengah melainkan all-out. Ini dilakukan beliau sejak jaman Orde Baru, hingga sekarang.
                    </p>
                </div>
            </div>

            <!-- Review Buku -->
            <h2 class="text-2xl text-primary-500 font-bold mb-4">Review Buku</h2>
            <p class="text-gray-600">
                Djohan Effendi adalah salah satu sosok penting dalam upaya pengembangan kehidupan keagamaan yang lebih dialogis, harmonis, dan toleran dalam era Indonesia modern. Kehidupan keagamaan-baik intra maupun antaragama- seperti itu tentu saja merupakan kebutuhan yang senantiasa harus diperjuangkan, bukan hanya untuk umat beragama itu sendiri, tapi juga untuk kepentingan keberlanjutan negara-bangsa Indonesia Kesediaan pak Djohan ikut berjuang menegakkan hak-hak kebebasan beragama di Indonesia tidaklah setengah-setengah melainkan all-out. Ini dilakukan beliau sejak jaman Orde Baru, hingga sekarang.
            </p>

            <!-- Komentar Buku -->
            <div class="mt-8">
                <livewire:library-comments :library_id="$library->id" />
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
