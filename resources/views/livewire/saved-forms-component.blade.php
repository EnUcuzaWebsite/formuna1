<x-layouts.layout>
        <h2 class="text-2xl font-bold mb-6">
            Kaydedilenler
        </h2>
        @if($user->savedPosts->isEmpty())
            <p class="text-gray-500 text-center text-lg">
                Henüz kaydedilmiş bir form bulunmuyor. 🌿
            </p>
        @else
               <ul class="flex flex-col gap-y-3">
                   @foreach($user->savedPosts as $post)
                       <li class="p-5 bg-gray-800 rounded-xl shadow-lg border border-gray-700 cursor-pointer flex justify-between">
                           <a href="{{ route("post.show", $post->post->id) }}">
                               <div class="flex items-center gap-4">
                                   <div class="bg-gray-900 p-3 rounded-lg">
                                       <x-heroicon-s-bookmark class="w-8 h-8 text-gray-400"/>
                                   </div>
                                   <div class="text-left">
                                       <p class="text-lg font-semibold text-white">
                                           {{ $post->post->title }}</p>
                                       <p class="text-xs text-gray-400">{{ $post->created_at->translatedFormat('d F Y H:i') }}</p>
                                   </div>
                               </div>
                           </a>
                           <livewire:save-button :post="$post->post"/>
                       </li>
                   @endforeach
               </ul>
        @endif
</x-layouts.layout>
