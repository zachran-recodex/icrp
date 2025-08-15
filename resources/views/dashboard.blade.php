<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Statistics Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-5">
            <!-- Articles Count -->
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                        {{ \App\Models\Article::count() }}
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        Total Articles
                    </div>
                </div>
            </div>

            <!-- Members Count -->
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                        {{ \App\Models\Member::count() }}
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        Total Members
                    </div>
                </div>
            </div>

            <!-- Library Count -->
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                        {{ \App\Models\Library::count() }}
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        Total Library
                    </div>
                </div>
            </div>

            <!-- Events Count -->
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                        {{ \App\Models\Event::count() }}
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        Total Events
                    </div>
                </div>
            </div>

            <!-- Advertisements Count -->
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-cyan-600 dark:text-cyan-400">
                        {{ \App\Models\Advertisement::count() }}
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        Total Ads
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Stats -->
        <div class="grid gap-6 md:grid-cols-2">
            <!-- Recent Articles -->
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Articles</h3>
                <div class="space-y-3">
                    @forelse(\App\Models\Article::latest()->take(5)->get() as $article)
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100 truncate">
                                    {{ $article->title }}
                                </p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">
                                    {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No articles yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Content Overview -->
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <h3 class="text-lg font-semibold mb-4">Content Overview</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Article Categories</span>
                        <span class="text-sm font-medium">{{ \App\Models\ArticleCategory::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Advocacies</span>
                        <span class="text-sm font-medium">{{ \App\Models\Advocacy::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Founders</span>
                        <span class="text-sm font-medium">{{ \App\Models\Founder::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Programs</span>
                        <span class="text-sm font-medium">{{ \App\Models\Program::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Upcoming Events</span>
                        <span class="text-sm font-medium">{{ \App\Models\Event::where('date', '>=', now())->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-neutral-600 dark:text-neutral-400">Active Ads</span>
                        <span class="text-sm font-medium">{{ \App\Models\Advertisement::active()->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
            <div class="grid gap-3 md:grid-cols-3">
                <flux:button icon="newspaper" href="{{ route('dashboard.manage-articles') }}" variant="primary" color="blue" wire:navigate>
                    Article
                </flux:button>
                <flux:button icon="user-group" href="{{ route('dashboard.manage-members') }}" variant="primary" color="green" wire:navigate>
                    Member
                </flux:button>
                <flux:button icon="book-open" href="{{ route('dashboard.manage-libraries') }}" variant="primary" color="purple" wire:navigate>
                    Library
                </flux:button>
                <flux:button icon="calendar" href="{{ route('dashboard.manage-events') }}" variant="primary" color="orange" wire:navigate>
                    Event
                </flux:button>
                <flux:button icon="scale" href="{{ route('dashboard.manage-advocacies') }}" variant="primary" color="red" wire:navigate>
                    Advocacy
                </flux:button>
                <flux:button icon="users" href="{{ route('dashboard.manage-founders') }}" variant="primary" color="yellow" wire:navigate>
                    Founder
                </flux:button>
                <flux:button icon="photo" href="{{ route('dashboard.manage-hero') }}" variant="primary" color="indigo" wire:navigate>
                    Hero Section
                </flux:button>
                <flux:button icon="megaphone" href="{{ route('dashboard.manage-call-to-action') }}" variant="primary" color="teal" wire:navigate>
                    Call To Action
                </flux:button>
                <flux:button icon="folder" href="{{ route('dashboard.manage-programs') }}" variant="primary" color="pink" wire:navigate>
                    Program
                </flux:button>
                <flux:button icon="megaphone" href="{{ route('dashboard.manage-advertisements') }}" variant="primary" color="cyan" wire:navigate>
                    Iklan Popup
                </flux:button>
            </div>
        </div>
    </div>
</x-layouts.app>
