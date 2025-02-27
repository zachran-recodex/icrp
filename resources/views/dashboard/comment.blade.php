<x-dashboard-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-950">Test Komentar</h1>
            </div>
            <nav class="text-sm font-medium text-gray-500" aria-label="breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li class="flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="hover:text-primary">Dashboard</a>
                        <span aria-hidden="true">/</span>
                    </li>
                    <li class="text-primary font-bold" aria-current="page">Test Komentar</li>
                </ol>
            </nav>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/3 mb-6 md:mb-0 md:pr-6">
                        @if ($library->image)
                            <img src="{{ Storage::url('libraries/' . $library->image) }}" alt="{{ $library->title }}"
                                class="w-full h-auto rounded-lg shadow-md">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="w-full md:w-2/3">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $library->title }}</h1>
                        <p class="text-xl text-gray-700 mt-2">oleh {{ $library->author }}</p>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            @if ($library->publisher)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Penerbit</h3>
                                    <p class="mt-1 text-sm text-gray-900">{{ $library->publisher }}</p>
                                </div>
                            @endif

                            @if ($library->published_year)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Tahun Terbit</h3>
                                    <p class="mt-1 text-sm text-gray-900">{{ $library->published_year }}</p>
                                </div>
                            @endif

                            @if ($library->isbn)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">ISBN</h3>
                                    <p class="mt-1 text-sm text-gray-900">{{ $library->isbn }}</p>
                                </div>
                            @endif

                            @if ($library->pages)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Jumlah Halaman</h3>
                                    <p class="mt-1 text-sm text-gray-900">{{ $library->pages }}</p>
                                </div>
                            @endif
                        </div>

                        @if ($library->description)
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                                <div class="mt-2 text-gray-700 space-y-4">
                                    {!! $library->description !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <livewire:library-comments :library_id="$library->id" />
            </div>
        </div>
    </div>
</x-dashboard-layout>
