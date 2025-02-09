<div>
    <span wire:click="openModal"
          class="bg-gray-600 px-4 py-1 text-sm flex items-center justify-center rounded-md cursor-pointer">
        {{ $user->followers->count() }} takipçi
    </span>

    @if ($isShowModal)
        <div class="fixed inset-0 bg-white/20 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-gray-800 p-6 rounded-md w-[400px]">
                <div class="flex justify-between items-center">
                    <div></div>
                    <h2 class="text-xl text-center font-semibold">Takipçiler</h2>
                    <button wire:click="closeModal">
                        <x-heroicon-c-x-mark class="size-6" />
                    </button>
                </div>
                <ul class="mt-2">
                    @foreach ($user->followers as $follower)
                        <a href="{{ route('user.details', ['user' => $follower->follower->id]) }}"
                           class="text-white text-sm block hover:bg-gray-600 px-4 py-2 rounded-md">{{ $follower->follower->name }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
