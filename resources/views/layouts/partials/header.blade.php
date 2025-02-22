<div
    class="sticky top-0 z-40 flex items-center h-16 px-4 bg-white border-b border-gray-200 shadow-sm shrink-0 gap-x-4 sm:gap-x-6 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-gray-950 lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <i class="fa-solid fa-bars w-6 h-6"></i>
    </button>

    <!-- Separator -->
    <div class="w-px h-6 bg-gray-950 lg:hidden" aria-hidden="true"></div>

    <div class="flex items-center gap-x-4 lg:gap-x-6">

    </div>

    <div class="flex justify-end flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex items-center gap-x-4 lg:gap-x-6">

            <!-- Separator -->
            <div class="w-px h-6 bg-gray-950"></div>

            <!-- Profile dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center py-1.5 px-2 hover:bg-primary-100 rounded-lg">
                    <span class="sr-only">Open user menu</span>
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                        <h3 class="text-primary-600 font-medium text-sm">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </h3>
                    </div>
                    <div class="hidden lg:flex lg:items-center">
                        <h3 class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                            {{ Auth::user()->name }}
                        </h3>
                    </div>
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                    <a href="{{ route('profile') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                        tabindex="-1">
                        <i class="fa-solid fa-user text-lg mr-2"></i>
                        My Profile
                    </a>

                    <a href="" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem" tabindex="-1">
                        <i class="fa-solid fa-gear text-lg mr-2"></i>
                        Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="border-t">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                            role="menuitem" tabindex="-1"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa-solid fa-sign-out-alt text-lg mr-2"></i>
                            Sign Out
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
