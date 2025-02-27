<x-dashboard-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-950">Call To Action</h1>
            </div>
            <nav class="text-sm font-medium text-gray-500" aria-label="breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li class="flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="hover:text-primary">Dashboard</a>
                        <span aria-hidden="true">/</span>
                    </li>
                    <li class="text-primary font-bold" aria-current="page">Call To Action</li>
                </ol>
            </nav>
        </div>

        <!-- Livewire -->
        <livewire:manage-call-to-action />
    </div>
</x-dashboard-layout>
