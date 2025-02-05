<x-layouts.layout>
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold mb-6">Gönderi Detay</h1>
        <button
            class="flex justify-end px-4 py-2 text-xs font-semibold bg-[#e4e4e4]  text-gray-950 rounded-md items-end">
            Yorum Yap
        </button>
    </div>
    <livewire:post-view :post="$post"/>

    <div class="mt-8">
        <h2 class="text-lg font-semibold">Yorumlar</h2>
        <div class="border-t border-gray-700 mt-4"></div>

        <div>
            <ul class="space-y-4 mt-4 overflow-auto">
                @foreach($post->comments as $comment)
                    <li class="flex gap-4 p-4 bg-transparent hover:bg-gray-600 rounded-md">
                        <img src="{{ $comment->user->getFilamentAvatarUrl() }}" alt="User Avatar"
                             class="rounded-full h-12 w-12 border-2 border-gray-200">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="">{{ $comment->user->name }}</span>
                                <span class="text-xs text-gray-200">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2 text-sm text-gray-200">{{ $comment->comment }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>
</x-layouts.layout>
