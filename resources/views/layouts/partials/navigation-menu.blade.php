<nav class="flex flex-col flex-1">
    <ul role="list" class="flex flex-col flex-1 gap-y-6">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center p-2 rounded-md gap-x-3">
                    <i
                        class="fa-solid fa-house {{ request()->routeIs('dashboard') ? 'text-primary-500' : 'text-shark-950' }}"></i>
                    Dashboard
                </x-nav-link>
            </ul>
        </li>
    </ul>
</nav>
