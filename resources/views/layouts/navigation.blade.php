<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                {{-- Основное меню (desktop) --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Всегда доступно --}}
                    <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                        {{ __('Статусы') }}
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            {{-- Правый блок: у гостя всегда видны кнопки входа/регистрации --}}
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        Вход
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        Регистрация
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition" aria-haspopup="menu" aria-expanded="false">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    role="button"
                                    tabindex="0"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault(); this.closest('form').submit();}"
                                    aria-label="{{ __('Log Out') }}"
                                >
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- Бургер для мобилок --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition" aria-controls="mobile-menu" :aria-expanded="open.toString()">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Мобильное меню --}}
    <div id="mobile-menu" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Всегда доступно --}}
            <x-responsive-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                {{ __('Статусы') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @guest
            <div class="pt-4 pb-4 border-t border-gray-200">
                <div class="px-4 flex gap-3">
                    <a href="{{ route('login') }}" class="w-full text-center px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">Вход</a>
                    <a href="{{ route('register') }}" class="w-full text-center px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">Регистрация</a>
                </div>
            </div>
        @endguest

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link
                            :href="route('logout')"
                            role="button"
                            tabindex="0"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault(); this.closest('form').submit();}"
                            aria-label="{{ __('Log Out') }}"
                        >
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
