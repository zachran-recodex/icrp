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

    <meta name="robots" content="">
@endsection

<x-main-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[30vh] flex items-center justify-center">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpeg') }}" alt="Hero Background" class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 space-y-12">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Tentang</h2>
                <p class="text-xl font-semibold text-primary">ICRP - Indonesian Conference on Religion and Peace</p>
            </div>

            <!-- Bagian 2: Sejarah & Gambar -->
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2 space-y-4 text-gray-700 text-lg">
                    <p>
                        <em>Indonesian Conference on Religion and Peace</em> (ICRP) adalah lembaga sosial dan
                        kemanusiaan
                        berbadan hukum Yayasan yang berkantor di Jl. Cempaka Putih Barat XXI No. 34 Jakarta Pusat.
                    </p>
                    <p>
                        ICRP memiliki komitmen sebagai Rumah Bersama dalam mewujudkan perdamaian, membangun dan
                        menciptakan
                        forum dialog sebagai ruang perjumpaan, penghormatan atas keberagaman, toleransi, dan perdamaian,
                        serta menjunjung tinggi martabat nilai-nilai kemanusiaan.
                    </p>
                    <p>
                        Sebelum diresmikan pada 12 Juli 2000 oleh Presiden Indonesia ke-4, KH. Abdurrahman Wahid, upaya
                        dialog antaragama telah dibangun di Indonesia.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="KH. Abdurrahman Wahid"
                        class="w-full h-auto rounded-lg shadow-lg">
                    <p class="text-center text-sm text-gray-500 mt-2">Source: https://www.icrp.com</p>
                </div>
            </div>

            <!-- Paragraf Pembuka -->
            <div class="text-gray-700 text-lg space-y-6 mx-auto">
                <p>
                    ICRP bersama dengan berbagai lembaga maupun individu yang memperjuangkan pluralisme dan
                    perdamaian lebih menekankan pada keadilan dalam berbagai perspektif: gender, HAM, spiritualitas,
                    ekonomi, sosial, dan politik.
                </p>
            </div>

            <!-- Bagian 3: Ide Pendirian & Gambar -->
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="Diskusi ICRP"
                        class="w-full h-auto rounded-lg shadow-lg">
                    <p class="text-center text-sm text-gray-500 mt-2">Source: https://www.icrp.com</p>
                </div>
                <div class="w-full md:w-1/2 space-y-4 text-gray-700 text-lg">
                    <p>
                        Ide pendirian ICRP berawal dari pemikiran Djohan Effendi, Mensekneg era Presiden Abdurrahman
                        Wahid (Gus Dur). Djohan Effendi adalah tokoh penting dalam pengembangan kehidupan keagamaan yang
                        lebih dialogis, harmonis, dan toleran di Indonesia.
                    </p>
                    <p>
                        Sebagai organisasi nirlaba, nonsektarian, non-pemerintah, dan independen, ICRP didedikasikan
                        untuk mempromosikan dialog antaragama, demokrasi, dan perdamaian di Indonesia.
                    </p>
                </div>
            </div>

            <!-- Bagian Visi -->
            <div class="text-center mt-16">
                <h3 class="text-2xl md:text-3xl font-bold text-primary mb-4">Visi</h3>
                <p class="text-gray-700 text-lg max-w-3xl mx-auto">
                    Mewujudkan masyarakat damai, berkeadilan, setara, persaudaraan dalam pluralisme agama dan keyakinan,
                    serta kesejahteraan dalam konteks kemajemukan agama di Indonesia.
                </p>
            </div>

            <!-- Bagian Misi -->
            <div class="mt-12">
                <h3 class="text-2xl md:text-3xl font-bold text-center text-primary mb-6">Misi</h3>
                <ul class="list-decimal list-inside text-gray-700 text-lg max-w-3xl mx-auto space-y-4">
                    <li>Menumbuhkan multikulturalisme dan pluralisme dalam kehidupan bermasyarakat.</li>
                    <li>Membangun kesadaran budaya religius yang sehat dan saling menghormati.</li>
                    <li>Memfasilitasi dialog, advokasi, dan pemecahan masalah sosial-politik terkait keagamaan.</li>
                    <li>Mendorong generasi muda untuk menghormati dan menyayangi keberagaman.</li>
                </ul>
            </div>

        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-20 bg-primary-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary-900 mb-4">Our Program</h2>
                <p class="text-primary-700">
                    The following is the work program of the Indonesian Religion and Peace Conference (ICRP) which was
                    prepared with the aim of encouraging peace, tolerance, and inter-religious dialogue in Indonesia,
                    for the sake of creating a harmonious and inclusive social life.
                </p>
            </div>

            <!-- Programs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Interfaith Dialogue -->
                <div class="relative bg-white shadow-lg rounded-lg overflow-hidden group">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="Interfaith Dialogue"
                        class="w-full h-[312px] object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6">
                        <div class="flex items-center gap-2 text-primary-400">
                            <i class="fas fa-users w-6 h-6"></i>
                            <h3 class="text-white text-xl font-semibold">Interfaith Dialogue</h3>
                        </div>
                        <p class="text-white mt-2">
                            Facilitating constructive dialogue between religious and community leaders to build mutual
                            understanding.
                        </p>
                    </div>
                </div>

                <!-- Peace Education -->
                <div class="relative bg-white shadow-lg rounded-lg overflow-hidden group">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="Peace Education"
                        class="w-full h-[312px] object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6">
                        <div class="flex items-center gap-2 text-primary-400">
                            <i class="fas fa-book w-6 h-6"></i>
                            <h3 class="text-white text-xl font-semibold">Peace Education</h3>
                        </div>
                        <p class="text-white mt-2">
                            Educational program for younger generations about peace and tolerance in religion.
                        </p>
                    </div>
                </div>

                <!-- Human Rights Advocacy -->
                <div class="relative bg-white shadow-lg rounded-lg overflow-hidden group">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="Human Rights Advocacy"
                        class="w-full h-[312px] object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6">
                        <div class="flex items-center gap-2 text-primary-400">
                            <i class="fas fa-balance-scale w-6 h-6"></i>
                            <h3 class="text-white text-xl font-semibold">Human Rights Advocacy</h3>
                        </div>
                        <p class="text-white mt-2">
                            Fighting for religious rights and freedom of belief for all groups in society.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpeg') }}" alt="CTA Background" class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-primary-950/70"></div>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                    Mari Bergabung Bersama ICRP
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    Jadilah bagian dari gerakan membangun kerukunan umat beragama di Indonesia. Bersama kita wujudkan
                    masyarakat yang toleran dan harmonis.
                </p>
                <a href="#"
                    class="inline-block px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition transform hover:scale-105">
                    Bergabung Sekarang
                </a>
            </div>
        </div>
    </section>
</x-main-layout>
