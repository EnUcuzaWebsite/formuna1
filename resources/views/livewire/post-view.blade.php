<section
    class="flex w-full gap-x-3 hover:bg-gray-600 transition-colors duration-300 rounded-lg p-4 mt-6 cursor-pointer items-start">

    <div class="flex w-full flex-col gap-y-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4 relative">
                <div class="flex items-center gap-1 relative">
                    <a href="#" class="flex items-center gap-2">
                        <img src="{{  $post->user->getFilamentAvatarUrl() }}" class="rounded-full h-8 w-8" alt="">
                        <span class="text-sm">{{ $post->user->name }}</span>
                    </a>
                    <livewire:follow-button :post="$post"/>
                </div>

                <span class="text-xs">{{ $post->created_at->translatedFormat('d F Y H:i') }}</span>
            </div>


            <div class="flex items-center">
                    <livewire:like-button :post="$post"/>

                    <livewire:post-action-group :post="$post"/>
            </div>

        </div>

        <div class="flex flex-col gap-y-2 pl-2">
            <h4 class="font-medium text-[16px]">{{ $post->title }}</h4>
            <p class="text-zinc-200 text-sm">
                {{ strip_tags($post->content) }}
            </p>
        </div>
    </div>
</section>
