<div>
    <span wire:click="openModal"
          class="bg-gray-600 px-4 py-1 text-sm flex items-center justify-center rounded-md cursor-pointer">
        {{ $user->followers->count() }} takipçi
    </span>

    @if ($isShowModal)
        <div wire:click.self="closeModal" class="fixed inset-0 bg-white/20 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-gray-800 p-6 rounded-md w-[400px]">
                <div class="flex justify-between items-center">
                    <div></div>
                    <h2 class="text-xl text-center font-semibold">Takipçiler</h2>
                    <button wire:click="closeModal">
                        <x-heroicon-c-x-mark class="size-6"/>
                    </button>
                </div>
                <ul class="mt-2 max-h-80 overflow-y-auto">
                    @if($user->followers->count() === 0)
                        <span class="text-sm text-center w-full block mt-4">Herhangi bir kullanıcı takip etmiyor</span>
                    @else
                        @foreach ($user->followers as $follower)
                            <a href="{{ route('user.details', ['user' => $follower->follower->id]) }}"
                               class="text-white text-sm block hover:bg-gray-600 px-4 py-2 rounded-md flex items-center gap-x-3 max-h-20 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-700">
                                <img
                                    src="{{ $follower->follower->getFilamentAvatarUrl() }}"
                                    alt="{{ $follower->follower->name }}"
                                    class="h-8 w-8 rounded-full object-cover"
                                />
                               <div class="flex flex-col">
                                   <span class="text-sm">{{ $follower->follower->name }}</span>
                                   <span class="text-xs">{{ $follower->follower->email }}</span>
                               </div>

                            </a>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    @endif
</div>
