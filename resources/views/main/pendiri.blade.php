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
            <img src="{{ asset('images/hero.jpeg') }}" alt="Hero Background" class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 space-y-12">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Jajaran Pendiri ICRP</h2>
            </div>

            <!-- Founders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Founder 1 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="K.H. Abdurahman Wahid"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">K.H. Abdurahman Wahid</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 2 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Budi Santoso Tanuwibowo"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Budi Santoso Tanuwibowo</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 3 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Chandra Setiawan"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Chandra Setiawan</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 4 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Djohan Efendi"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Djohan Efendi</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 1 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="K.H. Abdurahman Wahid"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">K.H. Abdurahman Wahid</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 2 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Budi Santoso Tanuwibowo"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Budi Santoso Tanuwibowo</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 3 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Chandra Setiawan"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Chandra Setiawan</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 4 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Djohan Efendi"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Djohan Efendi</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 1 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="K.H. Abdurahman Wahid"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">K.H. Abdurahman Wahid</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 2 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Budi Santoso Tanuwibowo"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Budi Santoso Tanuwibowo</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 3 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Chandra Setiawan"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Chandra Setiawan</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
                </div>

                <!-- Founder 4 -->
                <div class="flex flex-col items-center text-center p-4">
                    <div class="w-32 h-32 mb-4">
                        <img src="{{ asset('images/hero.jpeg') }}" alt="Djohan Efendi"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Djohan Efendi</h3>
                    <p class="text-purple-600 mb-2">Founder</p>
                    <p class="text-sm text-gray-600 max-w-sm">As one of the founders of ICRP, Prof. Maria Sukmawati has
                        been an inspiration in building bridges for inter-religious dialogue in Indonesia.</p>
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
