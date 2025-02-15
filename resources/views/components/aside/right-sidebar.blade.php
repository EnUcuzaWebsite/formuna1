
<aside class="col-span-3 h-[calc(100vh-80px)]">
    <div class="h-full overflow-y-auto">

        @if (!$showNotifications)
            <!-- Default Content -->
            <div x-show="sidebarContent === 'default'">
            <div class="flex h-full text-gray-400">
                    <div class="w-full p-4">
                        <div class="space-y-4 pğ4">
                            <div class="flex flex-col gap-y-4 items-start justify-between">
                                <h2 class="text-lg text-white  font-bold">Popüler Kategoriler</h2>
                                <ul class="flex flex-col gap-y-2 w-full">
                                    @foreach ($categories as $category)
                                        <a href="{{ route('category.detail', $category->category) }}" wire:navigate class="flex text-gray-300 items-center justify-between p-2 rounded-md transition-colors duration-300 hover:bg-gray-600 cursor-pointer">
                                            {{ $category->category->name}}
                                            <span class="text-xs text-gray-500">
                                                {{ $category->count }} gönderi
                                            </span>
                                        </a>
                                    @endforeach
                                </ul>
                                <h2 class="text-lg text-white mt-2  font-bold">Popüler Konular</h2>
                                <ul class="flex flex-col gap-y-2 w-full">
                                    @foreach ($topics as $topic)
                                        <a href="{{ route('topic.detail', $topic->topic) }}" wire:navigate class="flex text-gray-300 items-center justify-between p-2 rounded-md transition-colors duration-300 hover:bg-gray-600 cursor-pointer">
                                            {{ $topic->topic->name}}
                                            <span class="text-xs text-gray-500">
                                                {{ $topic->count }} gönderi
                                            </span>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($showNotifications)
            <div class="space-y-4 p-5">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">Bildirimler</h2>
                    <button wire:click="clearSelected" class="text-gray-300 hover:text-white">
                        <x-icon name="heroicon-c-x-mark" class="size-6"/>
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
        @endif
    </div>
</aside>
