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
                    {{ $heroSection?->title ?? 'Tentang Kami' }}
                </h1>
                @if($heroSection?->subtitle)
                    <p class="text-lg text-white/90 mb-8">
                        {{ $heroSection->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </section>
    
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
                        ekonomi, sosial, pendidikan, kesehatan dan politik.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Dialog Antar Agama"
                         class="w-full h-auto rounded-xl shadow-lg">
                    <p class="text-center text-sm text-gray-500 mt-2">Dialog Antar Agama untuk Perdamaian</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-12">
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
                            bebas dari rasa saling curiga di antara seluruh elemen bangsa.
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
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-primary-600 mb-6">Prinsip-Prinsip</h2>
                    <p class="text-lg text-gray-700 font-semibold mx-auto leading-relaxed mb-8">
                        Bumi ini disediakan oleh Sang Maha Pencipta untuk semua manusia, sehingga semua
                        manusia memiliki hak yang sama pula. Karena itu:
                    </p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <ul class="text-lg text-gray-700 space-y-4 list-decimal list-inside">
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
                            ICRP percaya bahwa negara harus "netral agama". Negara harus berdiri di atas semua agama dan
                            keyakinan dalam merumuskan dan mengimplementasikan setiap kebijakannya.
                        </li>
                        <li>
                            ICRP menolak "logika pengakuan" yang membawa pada kesimpulan "agama resmi" atau "agama yang
                            diakui". Negara sudah secara otomatis harus mengakui, melindungi, dan menghargai setiap
                            pengakuan agama oleh individu maupun kelompok.
                        </li>
                        <li>
                            ICRP percaya bahwa komunitas dan kelompok agama menempati posisi strategis dan peran yang
                            signifikan dalam kehidupan berbangsa.
                        </li>
                        <li>
                            ICRP percaya bahwa kelompok agama adalah modal sosial yang harus didorong untuk berperan aktif
                            dalam pemajuan kehidupan sosial masyarakat.
                        </li>
                        <li>
                            ICRP menolak politisasi agama, penggunaan agama dan simbol-simbol agama untuk kepentingan
                            politik sesaat dan untuk meraih dukungan dalam politik praktis.
                        </li>
                    </ul>
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