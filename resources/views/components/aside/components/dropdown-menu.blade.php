<div x-data="{open: sessionStorage.getItem('categories_open') === 'true' }"
     x-init="$watch('open', value => sessionStorage.setItem('categories_open', value))" class="pt-8">
    <button
        @click="open = !open"
        class="flex items-center justify-between w-full gap-x-3 text-gray-400 hover:bg-gray-800 block rounded-md h-10 cursor-pointer px-3"
    >
        <div class="flex items-center gap-x-2">
            <x-icon name="{{ $icon }}"
                    class="size-5 font-semibold"
            />
            <span class="font-semibold text-sm">{{ $title }}</span>
        </div>
        <x-icon name="heroicon-c-chevron-down"
                class="size-5 font-semibold transform transition-transform duration-200"
                x-bind:class="{'rotate-180': open}"
        />
    </button>

    <ul
        x-show="open" x-collapse
        class="flex flex-col gap-y-4 pt-3">
        @foreach($list as $item)
            <li class="flex items-center gap-3 hover:bg-gray-800 block rounded-md h-10 px-3 cursor-pointer group">
                <a href="*" class="text-sm text-white">
                    {{ $item['name'] }}
                    <span class="text-xs text-gray-400">
                           ({{ $item["entry"] }})
                        </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
