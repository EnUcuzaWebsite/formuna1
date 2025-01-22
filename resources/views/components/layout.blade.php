<div class="min-h-screen bg-primary" x-data="{ sidebarContent: 'default' }">
    <!-- Left Sidebar -->
    <div class="fixed left-0 top-0 h-screen w-[21rem] bg-secondary text-gray-100 z-50">
        <div class="p-4 h-full flex flex-col">
            <!-- Logo/Header - Fixed at top -->
            <div class="flex items-center mb-8 flex-shrink-0">
                <a href="{{ route('home') }}" wire:navigate class="hover:opacity-80">
                    <span class="text-2xl font-bold whitespace-nowrap">Formuna 1</span>
                </a>
            </div>

            <!-- Scrollable Navigation Area -->
            <div class="overflow-y-auto flex-1 -mr-4 pr-4">
                <!-- Navigation Items -->
                <nav class="space-y-6">
                    <!-- Main Navigation -->
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" wire:navigate
                            class="flex items-center p-3 rounded-lg hover:bg-gray-800 group justify-start hover:scale-105 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="ml-3">Ana Sayfa</span>
                        </a>

                        <a href="{{ route('explore') }}" wire:navigate
                            class="flex items-center p-3 rounded-lg hover:bg-gray-800 group justify-start">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="ml-3">Keşfet</span>
                        </a>

                        <a href="{{ route('saved-items') }}" wire:navigate
                            class="flex items-center p-3 rounded-lg hover:bg-gray-800 group justify-start">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span class="ml-3">Kaydedilenler</span>
                        </a>
                    </div>

                    <!-- Categories Dropdown -->
                    <div x-data="{ open: localStorage.getItem('membership_open') === 'true' }" x-init="$watch('open', value => localStorage.setItem('membership_open', value))">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-800">
                            <div class="flex items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                <span
                                    class="ml-3 text-sm font-semibold text-gray-400 uppercase tracking-wider">Kategoriler</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-collapse class="space-y-3 mt-2">
                            <a href="{{ route('category.detail', ['slug' => 'formula-1']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                Formula 1 <span class="text-gray-500">(156)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'motogp']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                MotoGP <span class="text-gray-500">(89)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'wrc']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                WRC <span class="text-gray-500">(45)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'formula-e']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                Formula E <span class="text-gray-500">(34)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'dtm']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                DTM <span class="text-gray-500">(28)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'indycar']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                IndyCar <span class="text-gray-500">(42)</span>
                            </a>
                            <a href="{{ route('category.detail', ['slug' => 'nascar']) }}" wire:navigate
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">
                                NASCAR <span class="text-gray-500">(67)</span>
                            </a>
                        </div>
                    </div>

                    <!-- Membership Dropdown -->
                    <div x-data="{ open: localStorage.getItem('membership_open') === 'true' }" x-init="$watch('open', value => localStorage.setItem('membership_open', value))">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-800">
                            <div class="flex items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span
                                    class="ml-3 text-sm font-semibold text-gray-400 uppercase tracking-wider">Üyelik</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-collapse class="space-y-4 mt-2">
                            <!-- Üye Olunan Konular -->
                            <div class="space-y-1">
                                <div class="px-3 text-sm font-medium text-gray-400">Üye Olunan Konular</div>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    2024 F1 Sezonu Tartışmaları
                                </a>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    MotoGP 2024 Tahminleri
                                </a>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    WRC Ralli Günlüğü
                                </a>
                            </div>

                            <!-- Favori Kategoriler -->
                            <div class="space-y-1">
                                <div class="px-3 text-sm font-medium text-gray-400">Favori Kategoriler</div>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    Formula 1
                                </a>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    MotoGP
                                </a>
                                <a href="#"
                                    class="flex items-center px-3 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                                    WRC
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-[21rem] right-0 h-20 bg-primary border-b border-gray-800 z-[100]">
        <div class="flex items-center justify-between h-full px-4">
            <div class="flex-1 max-w-2xl">
                <div class="relative ml-6">
                    <input type="text" placeholder="Kullanıcı, konu veya hashtag ara..."
                        class="w-full bg-transparent border-transparent text-gray-100 rounded-lg pl-10 pr-4 py-2.5 focus:border-none focus:ring-0">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4 ml-4">
                <button @click="sidebarContent = 'notifications'" class="p-2 text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </button>
                <button class="p-2 text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>

                <div class="h-8 w-px bg-gray-800"></div>
                <div x-data="{ profileOpen: false }" class="relative">
                    <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false"
                        class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-800">
                        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-white">{{ auth()->user()->name }}</span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" x-cloak
                        class="absolute right-0 mt-2 w-48 bg-secondary rounded-lg shadow-lg py-1 z-[110]">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                <span>Tema</span>
                            </div>
                        </a>
                        <a href="{{ route('settings') }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Ayarlar</span>
                            </div>
                        </a>
                        @if (auth()->user()->is_admin)
                            <a href="/admin" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                    <span>Admin Panel</span>
                                </div>
                            </a>
                        @endif
                        <div class="border-t border-gray-700 my-1"></div>
                        <button wire:click="logout"
                            class="w-full text-left px-4 py-2 text-sm text-red-500 hover:text-red-600">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Çıkış Yap</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Right Sidebar -->
    <div class="fixed right-0 top-20 h-[calc(100vh-4rem)] w-[20rem] bg-secondary text-gray-100 z-50">
        <div class="p-4 h-full overflow-y-auto">
            <!-- Default Content -->
            <div x-show="sidebarContent === 'default'">
                <div class="flex items-center justify-center h-full text-gray-400">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        <p class="text-lg">Sağ menü içeriği burada görüntülenecek</p>
                        <p class="text-sm mt-2">Bir gönderi seçin veya bildirimlerinizi kontrol edin</p>
                    </div>
                </div>
            </div>

            <!-- Post Details Content -->
            <div x-show="sidebarContent === 'post'" style="display: none;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Gönderi Detayları</h2>
                        <button @click="sidebarContent = 'default'" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Post details will be loaded here -->
                </div>
            </div>

            <!-- Notifications Content -->
            <div x-show="sidebarContent === 'notifications'" style="display: none;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Bildirimler</h2>
                        <button @click="sidebarContent = 'default'" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-2">
                        <!-- Example notifications -->
                        <div class="bg-gray-800 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">
                                        <span class="font-medium text-white">Ahmet Yılmaz</span> gönderinizi beğendi
                                    </p>
                                    <span class="text-xs text-gray-400">2 saat önce</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">
                                        <span class="font-medium text-white">Mehmet Demir</span> gönderinize yorum
                                        yaptı
                                    </p>
                                    <span class="text-xs text-gray-400">5 saat önce</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="ml-[21rem] mr-[20rem] bg-primary">
        <div class="pt-16 bg-primary">
            {{ $slot }}

        </div>
    </main>
</div>
