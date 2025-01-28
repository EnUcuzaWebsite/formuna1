<?php
    $sidebar_list = [
        [
            "path" => "home",
            "icon" => "home",
            "title" => "Anasayfa",
        ],
        [
            "path" => "home",
            "icon" => "users",
            "title" => "Keşfet",
        ],
        [
            "path" => "home",
            "icon" => "bookmark",
            "title" => "Kaydedilenler",
        ],
        [
            "path" => "home",
            "icon" => "heart",
            "title" => "Beğenilenler",
        ],
        [
            "path" => "home",
            "icon" => "bars-3",
            "title" => "Kategoriler",
        ],
        [
            "path" => "home",
            "icon" => "users",
            "title" => "Üyeliklerin",
        ],
        [
            "path" => "home",
            "icon" => "user-plus",
            "title" => "Takip Edilenler",
        ],
        [
            "path" => "home",
            "icon" => "cog",
            "title" => "Ayarlar",
        ],
    ];
?>

<aside class="h-screen w-[19rem] bg-secondary p-5 overflow-auto">
    <h1 class="px-1 text-2xl font-semibold">
        <a href="{{ route('home') }}" wire:navigate>
            Formuna1
        </a>
    </h1>

    <ul class="flex flex-col gap-y-4 pt-10">
        @foreach($sidebar_list as $item)
            <li class="flex items-center gap-3 hover:bg-gray-800 rounded-md h-10 px-3 cursor-pointer group">
                <x-icon name="heroicon-s-{{ $item['icon'] }}" class="size-4 hidden group-hover:block"/>
                <x-icon name="heroicon-o-{{ $item['icon'] }}" class="size-4 group-hover:hidden"/>
                <a href="{{ route($item['path']) }} wire:navigate">
                    {{ $item['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>
