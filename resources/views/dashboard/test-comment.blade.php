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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($libraries as $library)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative h-48 w-full">
                        @if ($library->image)
                            <img src="{{ Storage::url('libraries/' . $library->image) }}" alt="{{ $library->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $library->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $library->author }}</p>

                        @if ($library->published_year)
                            <p class="text-xs text-gray-500 mt-1">{{ $library->published_year }}</p>
                        @endif

                        <div class="mt-3 flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                            {{ $library->comments->count() }} komentar
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('dashboard.books.show', $library) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-md hover:bg-indigo-200">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500">Tidak ada buku yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $libraries->links() }}
        </div>
    </div>
</x-dashboard-layout>
