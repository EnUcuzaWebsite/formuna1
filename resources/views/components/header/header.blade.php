<?php

use App\Models\User;

$name = User::find(auth()->user()->id)->name;

$dropdownList = [
    [
        "title" => "Profil",
        "icon" => "users",
        "route" => "home"
    ],
    [
        "title" => "Ayarlar",
        "icon" => "cog",
        "route" => "home"
    ],
]
?>

<header class="h-20 border-b border-gray-800 flex items-center justify-between px-8">

    <div class="flex items-center w-full justify-between">
        <div class="flex gap-x-1 items-center">
            <label class="cursor-pointer" for="searchInput">
                <x-icon
                    name="heroicon-o-magnifying-glass"
                    class="size-4 text-zinc-500"/>
            </label>
            <input
                id="searchInput"
                placeholder="Kullanici, konu veya hashtag ara..."
                class="bg-transparent flex items-center w-[500px] px-1 text-sm text-zinc-500 outline-none border-none focus:ring-0 focus:outline-none"
            />
        </div>


        <div class="flex items-center gap-x-3">
            <div class="flex items-center gap-x-4">
                <button wire:click="notification">
                    <x-icon class="size-5 text-zinc-400 hover:text-white cursor-pointer" name="heroicon-o-bell"/>
                </button>
                @livewire('create-button')

            </div>

            <div class="h-8 w-px bg-gray-800"></div>

            <button x-data="{ profileOpen: false }" @click="profileOpen = !profileOpen"
                    @click.away="profileOpen = false"
                    class="flex relative items-center gap-x-2 cursor-pointer hover:bg-gray-800 px-3 py-2 rounded-md">
                <img src="{{ auth()->user()->getFilamentAvatarUrl() }}" class="rounded-full h-8 w-8" alt="">
                <span class="text-sm font-medium"> {{ $name }} </span>

                <div x-show="profileOpen" x-cloak class="bg-gray-800 rounded-md p-4 z-50 absolute top-full w-full">
                    <ul class="flex flex-col gap-y-1 items-start text-sm">
                        @foreach($dropdownList as $item)
                            <li wire:click="{{ route($item["route"]) }}"
                                class="block hover:bg-gray-600 p-2 cursor-pointer text-left rounded-md w-full flex justify-start gap-x-5 items-center">
                                <x-icon name="heroicon-o-{{ $item['icon'] }}" class="size-4"/>
                                <span>
                                {{ $item["title"] }}
                                </span>
                            </li>
                        @endforeach
                        @if ($is_admin)
                            <a href="/admin"
                               class="block hover:bg-gray-600 p-2 text-left cursor-pointer rounded-md w-full flex justify-start gap-x-5 items-center">
                                <x-icon name="heroicon-o-home" class="size-4"/>
                                <span>
                                Admin
                            </span>
                            </a>
                        @endif
                        <li wire:click="logout"
                            class="block flex items-center justify-between cursor-pointer hover:bg-gray-600 p-2 text-left rounded-md w-full">
                            <x-icon class="size-4" name="heroicon-o-arrow-left-start-on-rectangle"/>
                            <span>Çıkış Yap</span>
                        </li>
                    </ul>

                </div>
            </button>
        </div>
    </div>
</header>
