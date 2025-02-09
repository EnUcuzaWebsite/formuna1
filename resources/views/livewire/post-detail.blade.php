<x-layouts.layout>
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold mb-6">Gönderi Detay</h1>
        <livewire:comment-action :post="$post"/>
    </div>

    <div
        class="flex w-full gap-x-3 p-4 mt-6 cursor-pointer items-start">

        <div class="flex w-full flex-col gap-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4 relative">
                    <div class="flex items-center gap-1 relative">
                        <button href="#" class="flex items-center gap-2">
                            <img src="{{  $post->user->getFilamentAvatarUrl() }}" class="rounded-full h-8 w-8" alt="">
                            <span class="text-sm">{{ $post->user->name }}</span>
                        </button>
                        @if($post->user->id !== auth()->user()->id)
                            <livewire:follow-button :user="$post->user"/>
                        @endif
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
    </div>


    <div class="mt-8">
        <h2 class="text-lg font-semibold">Yorumlar</h2>
        <div class="border-t border-gray-700 mt-4"></div>
        @if($post->comments->isEmpty())
            <div class="pt-6 text-gray-400">
                Henüz herhangi bir yorum yok.
            </div>
        @endif
            @foreach($post->comments as $comment)
                <ul class="space-y-4 mt-4 overflow-auto">
                    <li class="flex gap-4 p-4 bg-transparent rounded-md">
                        <img src="{{ $comment->user->getFilamentAvatarUrl() }}" alt="User Avatar"
                             class="rounded-full h-12 w-12 border-2 border-gray-200">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="">{{ $comment->user->name }}</span>
                                    @if($post->user->id !== auth()->user()->id)
                                        <livewire:follow-button :user="$comment->user"/>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-200">{{ $comment->created_at->diffForHumans() }}</span>

                            </div>
                            <p class="mt-2 text-sm text-gray-200">
                                {{ strip_tags($comment->comment) }}
                            </p>
                        </div>
                    </li>
                </ul>
            @endforeach


    </div>
</x-layouts.layout>
