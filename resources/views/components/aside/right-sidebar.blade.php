<aside class="col-span-3 bg-secondary p-5 h-[calc(100vh-80px)]">
    <div class="p-4 h-full overflow-y-auto">

        @if (!$selectedPost)
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
        @endif


        @if ($selectedPost)
        <!-- Post Details Content -->
            <div ">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Gönderi Detayları</h2>
                        <button wire:click="clearSelectedPost" class="text-gray-300 hover:text-white">
                            <x-icon name="heroicon-c-x-mark" class="size-6" />
                        </button>
                    </div>
                        Yorumlarrrrs
                </div>
            </div>
        @endif


        <!-- Notifications Content -->
        {{-- <div x-show="sidebarContent === 'notifications'" style="display: none;">
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
        </div> --}}
    </div>
</aside>
