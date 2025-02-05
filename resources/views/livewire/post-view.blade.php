<section
    class="flex w-full gap-x-3 hover:bg-gray-600 transition-colors duration-300 rounded-lg p-4 mt-6 cursor-pointer items-start">

    <div class="flex w-full flex-col gap-y-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4 relative">
                <button
                    x-data="{ userActions: false }"
                    @click="userActions = !userActions"
                    @click.away="userActions = false"
                    class="flex items-center gap-2 relative"
                >
                    <img src="{{  $post->user->getFilamentAvatarUrl() }}" class="rounded-full h-8 w-8" alt="">
                    <span class="text-sm">{{ $post->user->name }}</span>
                    <div
                        x-show="userActions"
                        x-cloak
                        class="absolute z-50 mt-2 w-44 top-full bg-gray-950 text-xs rounded-md shadow-lg"
                    >
                        <ul class="flex flex-col gap-2 px-4 py-2">
                            <li class="block hover:bg-gray-600 p-2 cursor-pointer rounded-md flex items-center gap-2">
                                <x-icon name="heroicon-o-user-plus" class="size-4"/>
                                Takip Et
                            </li>
                            <li class="block hover:bg-gray-600 p-2 cursor-pointer rounded-md flex items-center gap-2">
                                <x-icon name="heroicon-o-user" class="size-4"/>
                                Profile Git
                            </li>
                        </ul>
                    </div>
                </button>

                <span class="text-xs">{{ $post->created_at->translatedFormat('d F Y H:i') }}</span>
            </div>


            <div class="flex items-center  gap-x-3">
                <button>
                    <x-icon class="size-4" name="heroicon-o-heart"/>
                </button>
                <button
                    x-data="{ extraInfo: false }"
                    @click="extraInfo = !extraInfo"
                    @click.away="extraInfo = false"
                    class="relative">
                    <x-icon class="size-6 cursor-pointer text-zinc-400" name="heroicon-o-ellipsis-horizontal"/>
                    <div x-show="extraInfo" x-cloak>
                        <ul class="absolute top-full -left-28 w-[150px] flex flex-col gap-y-2 px-4 py-2 bg-gray-950 text-xs rounded-md ">
                            <li class="block hover:bg-gray-600 p-2 cursor-pointer text-left rounded-md w-full flex justify-start gap-x-2 items-center">
                                <x-icon name="heroicon-o-share" class="size-4"/>
                                Paylaş
                            </li>
                            <li class="block hover:bg-gray-600 p-2 cursor-pointer text-left rounded-md w-full flex justify-start gap-x-2 items-center">
                                <x-icon name="heroicon-o-bookmark" class="size-4"/>
                                Kaydet
                            </li>
                            <li class="block hover:bg-gray-600 p-2 cursor-pointer text-left rounded-md w-full flex justify-start gap-x-2 items-center">
                                <x-icon name="heroicon-o-no-symbol" class="size-4"/>
                                Şikayet Et
                            </li>
                        </ul>
                    </div>

                </button>
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
