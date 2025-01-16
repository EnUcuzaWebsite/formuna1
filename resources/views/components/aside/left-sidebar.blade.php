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
        ]
    ];

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

<aside class="h-screen w-[19rem] bg-secondary p-5 overflow-auto">
    <h1 class="px-1 text-2xl font-semibold">
        <a href="{{ route('home') }}" wire:navigate>
            Formuna1
        </a>
    </h1>

    <ul class="flex flex-col gap-y-4 pt-10">
        @foreach($sidebar_list as $item)
            <li class="flex items-center gap-3 hover:bg-gray-800 block rounded-md h-10 px-3 cursor-pointer group">
                <x-icon name="heroicon-s-{{ $item['icon'] }}" class="size-4 hidden group-hover:block"/>
                <x-icon name="heroicon-o-{{ $item['icon'] }}" class="size-4 group-hover:hidden"/>
                <a href="{{ route($item['path']) }} wire:navigate">
                    {{ $item['title'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <x-aside.components.dropdown-menu title="KATEGORILER" icon="heroicon-o-bars-3" :list=$categories />
    <x-aside.components.dropdown-menu title="UYELIK" icon="heroicon-o-users" :list=$categories />

</aside>
