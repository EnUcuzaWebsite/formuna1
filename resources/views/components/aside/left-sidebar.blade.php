<div>
    <aside class="h-screen w-[19rem] p-5 overflow-auto">
        <h1 class="px-1 text-2xl font-semibold">
            <a href="{{ route('home') }}" wire:navigate>
                Formuna1
            </a>
        </h1>

        <ul class="flex flex-col gap-y-4 pt-10">
            @foreach($sidebar_list as $item)
                <a href="{{ route($item['path']) }}" wire:navigate class="flex items-center gap-3 hover:bg-gray-600 rounded-md h-10 px-3 cursor-pointer group
                       {{ request()->routeIs($item['path']) ? 'bg-gray-600' : '' }}">
                    <x-icon name="heroicon-s-{{ $item['icon'] }}" class="size-4 hidden group-hover:block"/>
                    @if(request()->routeIs($item['path']))
                        <x-icon name="heroicon-s-{{ $item['icon'] }}" class="size-4 group-hover:hidden"/>
                    @else
                        <x-icon name="heroicon-o-{{ $item['icon'] }}" class="size-4 group-hover:hidden"/>
                    @endif

                        <span>
                        {{ $item['title'] }}
                    </span>
                </a>
            @endforeach
        </ul>
    </aside>
</div>
