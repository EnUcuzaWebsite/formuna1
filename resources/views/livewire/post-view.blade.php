<!--  Buna tıklandığında right sidebar post -->
<button
    class="flex w-full gap-x-3 hover:bg-gray-800 transition-colors duration-300 rounded-lg p-4 mt-6 bg-secondary cursor-pointer"
    wire:click="detail"
    >
    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
        <x-icon class="size-4" name="heroicon-o-user"/>
    </div>

    <div class="flex w-full flex-col gap-y-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-4 text-zinc-400">
                <span class="text-sm"> {{ $post->user->name }} </span>
                <span class="text-xs"> {{ $post->created_at->translatedFormat('d F Y H:i') }} </span>
            </div>
            <x-icon class="size-6 cursor-pointer text-zinc-400" name="heroicon-o-ellipsis-horizontal"/>
        </div>

        <div class="flex flex-col gap-y-2">
            <h4 class="font-medium text-[16px]">{{ $post->title }}</h4>
            <p class="text-zinc-200 text-sm">
                {{ strip_tags($post->content) }}
            </p>
        </div>
        <ul class="flex items-center gap-x-4 pt-2">
            <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                <x-icon class="size-4" name="heroicon-o-hand-thumb-up"/>
                <span>Beğen</span>
            </li>
            <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                <x-icon class="size-4" name="heroicon-m-chat-bubble-left-ellipsis"/>
                <span>Yorum</span>
            </li>
            <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                <x-icon class="size-4" name="heroicon-o-share"/>
                <span>Paylaş</span>
            </li>
        </ul>
    </div>
</button>
