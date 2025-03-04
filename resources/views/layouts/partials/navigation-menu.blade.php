<nav class="flex flex-col flex-1">
    <ul role="list" class="flex flex-col flex-1 gap-y-6">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-house {{ request()->routeIs('dashboard') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Dashboard
                </x-nav-link>
            </ul>
        </li>

        <li>
            <h2 class="text-xs font-semibold leading-6 text-gray-400 uppercase">Sistem Manajemen Konten</h2>
            <ul role="list" class="-mx-2 space-y-1">

                <x-nav-link :href="route('dashboard.hero-section')" :active="request()->routeIs('dashboard.hero-section')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-desktop {{ request()->routeIs('dashboard.hero-section') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Hero Section
                </x-nav-link>

                <x-nav-link :href="route('dashboard.articles')" :active="request()->routeIs('dashboard.articles')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-newspaper {{ request()->routeIs('dashboard.articles') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Berita & Artikel
                </x-nav-link>

                <x-nav-link :href="route('dashboard.events')" :active="request()->routeIs('dashboard.events')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-calendar {{ request()->routeIs('dashboard.events') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Acara
                </x-nav-link>

                <x-nav-link :href="route('dashboard.founders')" :active="request()->routeIs('dashboard.founders')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-user-tie {{ request()->routeIs('dashboard.founders') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Pendiri
                </x-nav-link>

                <x-nav-link :href="route('dashboard.managements')" :active="request()->routeIs('dashboard.managements')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-users-line {{ request()->routeIs('dashboard.managements') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Pengurus
                </x-nav-link>

                <x-nav-link :href="route('dashboard.libraries')" :active="request()->routeIs('dashboard.libraries')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-book {{ request()->routeIs('dashboard.libraries') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Pustaka
                </x-nav-link>

                <x-nav-link :href="route('dashboard.programs')" :active="request()->routeIs('dashboard.programs')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-key {{ request()->routeIs('dashboard.programs') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Program
                </x-nav-link>

                <x-nav-link :href="route('dashboard.cta')" :active="request()->routeIs('dashboard.cta')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-rectangle-ad {{ request()->routeIs('dashboard.cta') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    CTA Section
                </x-nav-link>

                <x-nav-link :href="route('dashboard.advocacies')" :active="request()->routeIs('dashboard.advocacies')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-comment {{ request()->routeIs('dashboard.advocacies') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Advokasi KBB
                </x-nav-link>
            </ul>
        </li>

        <li>
            <h2 class="text-xs font-semibold leading-6 text-gray-400 uppercase">Lainnya</h2>
            <ul role="list" class="-mx-2 space-y-1">

                <x-nav-link :href="route('dashboard.setting')" :active="request()->routeIs('dashboard.setting')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-gear {{ request()->routeIs('dashboard.setting') ? 'text-primary-500' : 'text-gray-950' }}"></i>
                    Setting
                </x-nav-link>

            </ul>
        </li>
    </ul>
</nav>
