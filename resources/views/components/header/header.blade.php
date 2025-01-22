<?php

use App\Models\User;
$name = User::find(auth()->user()->id)->name;
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
                <x-icon class="size-5 text-zinc-400 hover:text-white cursor-pointer" name="heroicon-o-bell"/>
                @livewire('create-button')

            </div>

            <div class="h-8 w-px bg-gray-800"></div>

            <div class="flex items-center gap-x-2 cursor-pointer hover:bg-gray-800 px-3 py-2 rounded-md">
                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
                    <x-icon class="size-4" name="heroicon-o-user"/>
                </div>
                <span class="text-sm font-medium"> {{ $name }} </span>
            </div>

            <button wire:click="logout" class="text-sm font-medium">Logout</button>
        </div>
    </div>
</header>
