<x-layouts.layout>
    <h2 class="text-2xl font-bold mb-6">
        Beğenilenler
    </h2>
    @if($user->likedForms->isEmpty())
        <p class="text-gray-500 text-center text-lg">
            Henüz kaydedilmiş bir form bulunmuyor. 🌿
        </p>
    @else
        <ul class="flex flex-col gap-y-3">
            @foreach($user->likedForms as $form)
                <li class="p-5 bg-gray-800 rounded-xl shadow-lg border border-gray-700 cursor-pointer">
                    <a href="{{ route("post.show", $form->post->id) }}">
                        <div class="flex items-center gap-4">
                            <div class="bg-gray-900 p-3 rounded-lg">
                                <x-heroicon-s-hand-thumb-up class="w-8 h-8 text-gray-400"/>
                            </div>
                            <div class="text-left">
                                <p class="text-lg font-semibold text-white">Form
                                    {{ $form->post->title }}</p>
                                <p class="text-xs text-gray-400">{{ $form->created_at->translatedFormat('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</x-layouts.layout>
