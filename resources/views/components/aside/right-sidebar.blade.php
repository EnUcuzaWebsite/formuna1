<?php
$categories = [
    [
        "name" => "Formula 1",
        "entry" => "156"
    ],
    [
        "name" => "Formula 1",
        "entry" => "156"
    ],
    [
        "name" => "Formula 1",
        "entry" => "156"
    ],
    [
        "name" => "Formula 1",
        "entry" => "156"
    ],
    [
        "name" => "hamiltoncular",
        "entry" => "+8"
    ],
];

?>


<aside class="col-span-3 bg-secondary h-[calc(100vh-80px)]">
    <div class="h-full overflow-y-auto">

        @if (!$selectedPost && !$showNotifications)
            <!-- Default Content -->
            <div x-show="sidebarContent === 'default'">
            <div class="flex h-full text-gray-400">
                    <div class="w-full px-4">
                        <x-aside.components.dropdown-menu title="KATEGORILER" icon="heroicon-o-bars-3" :list=$categories/>
                        <x-aside.components.dropdown-menu title="UYELIK" icon="heroicon-o-users" :list=$categories/>
                    </div>
                </div>
            </div>
        @endif


        @if ($selectedPost)
            <!-- Post Details Content -->
            <div class=" h-full flex flex-col p-5">
                <div class="space-y-4 flex-grow">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Gönderi Detayları</h2>
                        <button wire:click="clearSelected" class="text-gray-300 hover:text-white">
                            <x-icon name="heroicon-c-x-mark" class="size-6"/>
                        </button>
                    </div>
                    <div class="h-[530px] overflow-auto flex flex-col gap-y-3">
                        @foreach ($selectedPost->comments as $comment)
                            <ul class="flex flex-col gap-y-3">
                                <li class="p-3 rounded-md bg-gray-800 flex flex-col gap-y-2">
                                    <div class="flex justify-between items-center w-full">
                                        <span class="text-sm text-gray-300">{{ $comment->user->name }}</span>
                                        <span
                                            class="text-[10px] text-gray-300">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs">{{ $comment->comment }}</p>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <!-- Alt kısım -->
                <div class="mt-auto p-4 bg-gray-900 text-center text-white">
                    bottom
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
