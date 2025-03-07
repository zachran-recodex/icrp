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

    <meta name="robots" content="">
@endsection

<x-main-layout>
    <!-- Hero Section -->
    <x-hero-section :title="$heroSection->title" :image="$heroSection->image" />

    <!-- About Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 space-y-12">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Tentang Kami</h2>
                <p class="text-lg text-gray-600">Indonesian Conference on Religion and Peace (ICRP)</p>
            </div>

            <!-- Sejarah & Gambar -->
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2 text-gray-700 text-lg space-y-6 leading-relaxed">
                    <p>
                        ICRP adalah sebuah organisasi berbadan hukum yayasan yang bersifat non-sektarian, nonprofit,
                        non-pemerintah, dan independen. ICRP mempromosikan dialog dan kerjasama lintas iman dibidani
                        kelahirannya oleh para tokoh dari berbagai agama dan kepercayaan di Indonesia. ICRP berusaha
                        mempromosikan dialog dalam pengembangan kehidupan beragama yang demokratis, humanis dan
                        pluralis.
                    </p>
                    <p>
                        Jauh sebelum ICRP diresmikan pada 12 Juli 2000 oleh Presiden RI Abdurrahman Wahid, upaya-upaya
                        dialog lintas agama sudah tumbuh dan berkembang di Indonesia. ICRP bersama berbagai lembaga dan
                        individu yang peduli memperjuangkan pluralisme dan perdamaian lebih mempertegas upaya-upaya
                        tersebut demi menegakkan keadilan dalam berbagai perspektif gender, HAM, kehidupan beragama,
                        ekonomi, sosial, pendidikan, kesehatan dan politik. ICRP turut aktif dalam mengembangkan studi
                        perdamaian dan resolusi konflik, serta memperjuangkan hak-hak sipil, kebebasan beragama dan
                        berkeyakinan.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/hero.jpeg') }}" alt="KH. Abdurrahman Wahid"
                         class="w-full h-auto rounded-xl shadow-lg">
                    <p class="text-center text-sm text-gray-500 mt-2">Source: https://www.icrp.com</p>
                </div>
            </div>

            <div class="grid grid-cols-2 items-center gap-12">
                <!-- Visi -->
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-primary-600 mb-6">Visi</h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        Masyarakat yang damai dan sejahtera dalam konteks kemajemukan agama dan kepercayaan di Indonesia.
                    </p>
                </div>

                <!-- Misi -->
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-primary-600 mb-6">Misi</h2>
                    <ul class="text-lg text-gray-700 max-w-3xl mx-auto space-y-4 text-left list-disc list-inside">
                        <li>Menumbuhkembangkan multikulturalisme dan pluralisme dalam kehidupan Masyarakat.</li>
                        <li>
                            Membangun kesadaran dan mengembangkan budaya religiusitas yang sehat, saling menghormati dan
                            bebas dari rasa saling curiga di antara seluruh elemen bangsa khususnya komunitas dan lembaga
                            antar iman.
                        </li>
                        <li>
                            Mendorong usaha-usaha dialog, advokasi, pengkajian dan pemecahan masalah-masalah sosial politik
                            dan keagamaan baik dalam skala daerah, nasional, regional, maupun internasional.
                        </li>
                        <li>
                            Mendorong semua pihak untuk menghormati dan mensyukuri keanekaragaman dan kekayaan tradisi
                            keagamaan masing-masing.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Prinsip-Prinsip -->
            <div class="space-y-10">
                <p class="text-lg text-gray-700 font-semibold text-center mx-auto leading-relaxed">
                    Prinsip-prinsip Bumi ini disediakan oleh Sang Maha Pencipta untuk semua manusia, sehingga semua
                    manusia memiliki hak yang sama pula. Karena itu:
                </p>
                <ul class="text-lg text-gray-700 mx-auto space-y-4 list-decimal list-inside">
                    <li>
                        ICRP percaya bahwa keragaman suku, agama, budaya, adat Indonesia adalah kekayaan yang diberikan
                        Tuhan untuk mendorong integrasi sosial, bukan untuk alasan memecah belah.
                    </li>
                    <li>
                        ICRP percaya bahwa pluralisme, penghargaan terhadap yang lain, adalah pilihan sikap terbaik
                        dalam kehidupan beragama di tengah keragaman tersebut.
                    </li>
                    <li>
                        ICRP percaya bahwa misi utama agama-agama adalah terwujudnya kehidupan rukun, damai, dan
                        sejahtera, bagi manusia dan kemanusiaan secara keseluruhan.
                    </li>
                    <li>
                        ICRP percaya bahwa pada prinsipnya agama tidak mengajarkan kekerasan. Karena itu setiap
                        komunitas agama harus mengambil peran aktif untuk menolak segala bentuk kekerasan atas nama
                        agama.
                    </li>
                    <li>
                        ICRP percaya bahwa setiap individu, setiap warga negara, harus dijamin hak-hak dan kebebasan
                        sipilnya oleh negara. Termasuk di dalamnya adalah hak dan kebebasan beragama dan berkeyakinan.
                    </li>
                    <li>
                        ICRP percaya bahwa negara harus “netral agama”. Negara harus berdiri di atas semua agama dan
                        keyakinan dalam merumuskan dan mengimplementasikan setiap kebijakannya.
                    </li>
                    <li>
                        ICRP menolak “logika pengakuan” yang membawa pada kesimpulan “agama resmi” atau “agama yang
                        diakui”. Negara sudah secara otomatis harus mengakui, melindungi, dan menghargai setiap
                        pengakuan agama oleh individu maupun kelompok.
                    </li>
                    <li>
                        ICRP percaya bahwa komunitas dan kelompok agama menempati posisi strategis dan peran yang
                        signifikan dalam kehidupan berbangsa.
                    </li>
                    <li>
                        ICRP percaya bahwa kelompok agama adalah modal sosial yang harus didorong untuk berperan aktif
                        dalam pemajuan kehidupan sosial masyarakat, dan karena itu mereka harus peduli terhadap masalah
                        sosial di luar isu-isu agama.
                    </li>
                    <li>
                        ICRP menolak politisasi agama, penggunaan agama dan simbol-simbol agama untuk kepentingan
                        politik sesaat dan untuk meraih dukungan dalam politik praktis
                    </li>
                </ul>
            </div>

        </div>
    </section>

    <!-- Programs Section with Modal -->
    <section class="py-20 bg-primary-50">
        <div class="container mx-auto px-4 space-y-12">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl font-extrabold text-primary-600 mb-4">Program Kerja</h2>
                <p class="text-lg text-gray-600">Indonesian Conference on Religion and Peace (ICRP)</p>
            </div>

            <!-- Programs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($programs as $program)
                    <div
                        x-data="{ open: false }"
                        class="relative bg-white shadow-lg rounded-lg overflow-hidden group cursor-pointer"
                        @click="open = true"
                    >
                        <img src="{{ Storage::url('programs/' . $program->image) }}" alt="{{ $program->title }}"
                            class="w-full h-[312px] object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">{{ $program->title }}</h3>
                            <p class="text-white mt-2">
                                {{ Str::limit(strip_tags($program->description), 80) }}
                            </p>
                        </div>

                        <!-- Modal -->
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="fixed inset-0 z-50 flex items-center justify-center"
                            @click.away="open = false"
                        >
                            <div class="fixed inset-0 bg-black bg-opacity-50" @click="open = false"></div>

                            <div class="relative bg-white rounded-lg shadow-xl overflow-hidden max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                                <!-- Modal Header with Close Button -->
                                <div class="flex justify-between items-center p-6 border-b">
                                    <h3 class="text-2xl font-bold text-primary-600">{{ $program->title }}</h3>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal Content -->
                                <div class="p-6">
                                    <div class="mb-6">
                                        <img src="{{ Storage::url('programs/' . $program->image) }}" alt="{{ $program->title }}"
                                            class="w-full h-64 object-cover rounded-lg">
                                    </div>

                                    <div class="space-y-4">
                                        <!-- Display all program data here -->
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-700">Deskripsi Program:</h4>
                                            <div class="mt-2 text-gray-600">
                                                {!! $program->description !!}
                                            </div>
                                        </div>

                                        @if($program->goals)
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-700">Tujuan:</h4>
                                            <div class="mt-2 text-gray-600">
                                                {!! $program->goals !!}
                                            </div>
                                        </div>
                                        @endif

                                        @if($program->timeline)
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-700">Timeline:</h4>
                                            <div class="mt-2 text-gray-600">
                                                {!! $program->timeline !!}
                                            </div>
                                        </div>
                                        @endif

                                        @if($program->status)
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-700">Status:</h4>
                                            <div class="mt-2">
                                                <span class="px-3 py-1 text-sm rounded-full {{ $program->status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $program->status }}
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="p-6 border-t bg-gray-50 flex justify-end">
                                    <button @click="open = false" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
