<div>
    <span wire:click="openModal"
          class="bg-gray-600 px-4 py-1 text-sm flex items-center justify-center rounded-md cursor-pointer">
        {{ $user->following->count() }} takip edilen
    </span>

    @if ($isShowModal)
        <div wire:click.self="closeModal" class="fixed inset-0 bg-white/20 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-gray-800 p-6 rounded-md w-[400px]">
                <div class="flex justify-between items-center">
                    <div></div>
                    <h2 class="text-xl text-center font-semibold">Takip Edilenler</h2>
                    <button wire:click="closeModal">
                        <x-heroicon-c-x-mark class="size-6"/>
                    </button>
                </div>
                <ul class="mt-2 max-h-80 overflow-y-auto">
                    @if($user->following->count() === 0)
                        <span
                            class="text-sm text-center w-full block mt-4">Herhangi bir kullanıcıyı takip etmiyorsunuz</span>
                    @else
                        @foreach ($user->following as $following)
                            <a href="{{ route('user.details', ['user' => $following->followed->id]) }}"
                               class="text-white text-sm block hover:bg-gray-600 px-4 py-2 rounded-md flex items-center gap-x-3">
                                <img
                                    src="{{ $following->followed->getFilamentAvatarUrl() }}"
                                    alt="{{ $following->followed->name }}"
                                    class="h-8 w-8 rounded-full object-cover"
                                />
                                <div class="flex flex-col">
                                    <span class="text-sm">{{ $following->followed->name }}</span>
                                    <span class="text-xs">{{ $following->followed->email }}</span>
                                </div>
                            </a>
                        @endforeach

                    @endif
                </ul>
            </div>
        </div>
    @endif
</div>
