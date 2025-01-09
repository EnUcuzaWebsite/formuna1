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
        "name" => "Formula 1",
        "entry" => "156"
    ],
];

?>

<aside class="w-[19rem] bg-secondary p-5 ">
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

    <div x-data="{ open: localStorage.getItem('categories_open') === 'true' }"
         x-init="$watch('open', value => localStorage.setItem('categories_open', value)" class="pt-8">
        <button
            @click="open = !open"
            class="flex items-center justify-between w-full gap-x-3 text-gray-400 hover:bg-gray-800 block rounded-md h-10 cursor-pointer px-3"
        >
            <div class="flex items-center gap-x-2">
                <x-icon name="heroicon-o-bars-3"
                        class="size-5 font-semibold"
                />
                <span class="font-semibold text-sm">KATEGORILER</span>
            </div>
            <x-icon name="heroicon-c-chevron-down"
                    class="size-5 font-semibold transform transition-transform duration-200"
                    x-bind:class="{'rotate-180': open}"


            />
        </button>

        <ul
            x-show="open" x-collapse
            class="flex flex-col gap-y-4 pt-3">
            @foreach($categories as $category)
                <li class="flex items-center gap-3 hover:bg-gray-800 block rounded-md h-10 px-3 cursor-pointer group">
                    <a href="*" class="text-sm text-white">
                        {{ $category['name'] }}
                        <span class="text-xs text-gray-400">
                           ({{ $category["entry"] }})
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>


</aside>
