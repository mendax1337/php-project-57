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
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                        {{ __('Задачи') }}
                    </x-nav-link>

                    <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                        {{ __('Статусы') }}
                    </x-nav-link>

                    <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.*')">
                        {{ __('Метки') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Правый блок --}}
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Вход') }}
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Регистрация') }}
                    </a>
                @endguest

                @auth
                    {{-- Простая кнопка выхода, как в демо --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                            {{ __('Выход') }}
                        </button>
                    </form>
                @endauth
            </div>

            {{-- Бургер для мобилок --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition"
                        aria-controls="mobile-menu"
                        :aria-expanded="open.toString()">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Мобильное меню --}}
    <div id="mobile-menu" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                {{ __('Задачи') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                {{ __('Статусы') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.*')">
                {{ __('Метки') }}
            </x-responsive-nav-link>
        </div>

        @guest
            <div class="pt-4 pb-4 border-t border-gray-200">
                <div class="px-4 flex gap-3">
                    <a href="{{ route('login') }}"
                       class="w-full text-center px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Вход') }}
                    </a>
                    <a href="{{ route('register') }}"
                       class="w-full text-center px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Регистрация') }}
                    </a>
                </div>
            </div>
        @endguest

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1 px-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded">
                            {{ __('Выход') }}
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
