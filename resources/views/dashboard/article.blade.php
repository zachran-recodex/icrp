<x-dashboard-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-shark-950">List Berita & Artikel</h1>
            </div>
            <nav class="text-sm font-medium text-shark-500" aria-label="breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li class="flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="hover:text-primary">Dashboard</a>
                        <span aria-hidden="true">/</span>
                    </li>
                    <li class="text-primary font-bold" aria-current="page">Berita & Artikel</li>
                </ol>
            </nav>
        </div>

        <!-- Komponen Livewire untuk Artikel -->
        <livewire:manage-articles />

        <!-- Komponen Livewire untuk Kategori -->
        <livewire:manage-categories />
    </div>
</x-dashboard-layout>
