<div class="w-[1200px] mx-auto pt-16 h-auto min-h-screen">
    <section class="text-white rounded-2xl p-8">
        <div class="flex justify-between">
            <div class="flex items-center gap-8">
                <img
                    src="{{ $user->getFilamentAvatarUrl() }}"
                    alt="{{ $user->name }}"
                    class="h-32 w-32 rounded-full object-cover border-4 border-gray-600"
                />
                <div>
                    <div class="flex gap-x-8 items-center">
                        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                        <div class="flex gap-x-4 items-center">
                            <livewire:followers-modal :user="$user"/>
                            <span
                                class="bg-gray-600 px-4 py-1 text-sm flex items-center justify-center rounded-md cursor-pointer">
                                {{ $user->forms->count() }} gönderi
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm mt-2">{{ $user->email }}</p>
                    <p class="text-gray-300 text-sm">{{ $user->created_at->translatedFormat('d F Y H:i') }} ' den beri
                        üye</p>
                </div>
            </div>
            <div class="">
                <div class="px-4 py-2 flex gap-x-2 cursor-pointer items-center">
                    <livewire:follow-button :user="$user" :button="true"/>
                    <livewire:report-action :user="$user"/>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Hakkında</h2>
            <p class="text-gray-300">
                {{ $user->bio ?? 'Bu kullanıcı henüz biyografi eklememiş.' }}
            </p>
        </div>


        <div class="flex justify-center items-center mt-8">
            <div class="flex gap-x-6 p-6">
                <div x-data="{ content_type: 'gonderiler' }" class="flex flex-col">
                    <div class="flex justify-center gap-x-8 pb-4">
                        <button
                            @click="content_type = 'gonderiler'"
                            :class="{ 'border-b-[1px] border-white text-gray-500' : content_type === 'gonderiler' }"
                            class="text-white pb-1 text-sm hover:text-gray-400">
                            Gönderiler
                        </button>
                        <button
                            @click="content_type = 'yanitlar'"
                            :class="{ 'border-b-[1px] border-white text-gray-500' : content_type === 'yanitlar' }"
                            class="text-white pb-1 text-sm hover:text-gray-400">
                            Yorumlar
                        </button>
                    </div>

                    <div class="p-6 rounded-xl">
                        <template x-if="content_type === 'gonderiler'">
                            <ul class="text-gray-200 flex flex-col gap-y-4">
                                @foreach($user->forms as $form)
                                    <livewire:post-view :post="$form" :nofollow="true"/>
                                @endforeach
                            </ul>
                        </template>

                        <template x-if="content_type === 'yanitlar'">
                            <div class="space-y-6 mt-6">
                                @foreach($user->comments as $comment)
                                    <div class="p-5 bg-gray-800 rounded-xl shadow-lg border border-gray-700">
                                        <div class="mb-3">
                                            <a href="{{ route('post.show', $comment->post->id) }}">
                                                <h3 class="text-lg font-bold text-white">Gönderi</h3>
                                                <p class="text-gray-300 text-sm">
                                                    {{ $comment->post->content ?? 'Gönderi Silinmiş veya Bulunamıyor' }}
                                                </p>
                                            </a>
                                        </div>

                                        <div>
                                            <h3 class="text-lg font-bold text-white">Yapılan Yorum</h3>
                                            <p class="text-gray-200 text-sm">
                                                "{{ $comment->comment }}"
                                            </p>
                                        </div>

                                        <div class="mt-4 text-right">
                                            <span class="text-xs text-gray-500">
                                                {{ $comment->created_at->translatedFormat('d F Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
