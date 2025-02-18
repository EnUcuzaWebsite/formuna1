<section class="grid gap-y-2 hover:bg-gray-600 transition-colors duration-300 rounded-lg p-4 mt-6 cursor-pointer items-start">
    <header class="flex items-center justify-between ">
        <div class="flex items-center gap-4 relative">
            <div class="flex items-center gap-1 relative">
                @if($this->is_detail)
                    <a href="{{ route("user.details", $post->user) }}" class="flex items-center gap-2">
                        <img src="{{  $post->user->getFilamentAvatarUrl() }}" class="rounded-full h-8 w-8" alt="">
                        <span class="text-sm">{{ $post->user->name }}</span>
                    </a>
                @endif
                @if($post->user->id !== auth()->user()->id && !$this->is_detail)
                    <div>
                        <livewire:follow-button :user="$post->user"/>
                    </div>
                @endif
            </div>

            <span class="text-xs">{{ $post->created_at->translatedFormat('d F Y H:i') }}</span>
        </div>
        <div class="flex items-center">
            <livewire:like-button :post="$post"/>
            <livewire:post-action-group :post="$post"/>
        </div>
    </header>

    <a href="{{ route('post.show', ['post' => $post->id]) }}">
        <main class="flex flex-col gap-y-2 pl-2">
            <h4 class="font-medium text-[18px]">{{ $post->title }}</h4>
            <p class="text-zinc-200 text-sm mt-2">
                {{ Str::limit(strip_tags($post->content), 150, '...') }}
            </p>
            <a href="{{ route('post.show', ['post' => $post->id]) }}" class="text-sm text-indigo-500">okumaya devam et</a>
        </main>
    </a>
    <div class="text-xs flex gap-2 text-gray-200 pl-2"">
        <span>{{ $post->category->name }}</span>
        <i>#{{ $post->topic->name }}</i>
    </div>
</section>
