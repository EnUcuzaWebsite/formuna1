<x-layouts.user-details-layout>

    <div class="h-auto max-h-screen overflow-auto">
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
                                <livewire:followed-modal :user="$user"/>
                                <span
                                    class="bg-gray-600 px-4 py-1 text-sm flex items-center justify-center rounded-md cursor-pointer">
                                {{ $user->forms->count() }} gönderi
                            </span>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm mt-2">{{ $user->email }}</p>
                        <p class="text-gray-300 text-sm">{{ $user->created_at->translatedFormat('d F Y H:i') }} ' den
                            beri üye</p>
                    </div>
                </div>
                <div class="">
                    <div class="px-4 py-2 flex gap-x-2 cursor-pointer items-center mt-[13px]">
                        <livewire:follow-button :user="$user" :button="true"/>
                        <livewire:report-action :user="$user"/>
                        @if($user->id === auth()->user()->id)
                            <livewire:edit-action :user="$user"/>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Hakkında</h2>
                <p class="text-gray-300">
                    {{ $user->bio ?? 'Bu kullanıcı henüz biyografi eklememiş.' }}
                </p>
            </div>


            <div x-data="{ content_type: 'gonderiler' }" class="flex flex-col mt-16">
                <div class="flex gap-x-6 pb-4 justify-center">
                    <button
                        @click="content_type = 'gonderiler'"
                        :class="{ 'bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#231f39] text-white' : content_type === 'gonderiler' }"
                        class="text-gray-400 pb-2 text-sm px-6 py-3 rounded-full hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center gap-x-2">
                        <x-heroicon-o-document-text class="w-5 h-5"/> Gönderiler
                    </button>

                    <button
                        @click="content_type = 'yanitlar'"
                        :class="{ 'bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#231f39] text-white' : content_type === 'yanitlar' }"
                        class="text-gray-400 pb-2 text-sm px-6 py-3 rounded-full hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center gap-x-2">
                        <x-heroicon-o-chat-bubble-left-ellipsis class="w-5 h-5"/> Yorumlar
                    </button>

                    @if(\Illuminate\Support\Facades\Auth::user() && Auth::user()->id == $user->id)
                        <button
                            @click="content_type = 'kaydedilenler'"
                            :class="{ 'bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#231f39] text-white' : content_type === 'kaydedilenler' }"
                            class="text-gray-400 pb-2 text-sm px-6 py-3 rounded-full hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center gap-x-2">
                            <x-heroicon-o-bookmark class="w-5 h-5"/> Kaydedilenler
                        </button>

                        <button
                            @click="content_type = 'begenilenler'"
                            :class="{ 'bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#231f39] text-white' : content_type === 'begenilenler' }"
                            class="text-gray-400 pb-2 text-sm px-6 py-3 rounded-full hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center gap-x-2">
                            <x-heroicon-o-heart class="w-5 h-5"/> Beğenilenler
                        </button>
                    @endif
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

                    <template x-if="content_type === 'kaydedilenler'">
                       @if($user->savedPosts->count())
                            <ul class="text-gray-200 text-center flex flex-col gap-y-4 mt-6">
                                @foreach($user->savedPosts as $saved_post)
                                    <li class="p-5 bg-gray-800 rounded-xl shadow-lg border border-gray-700 cursor-pointer flex justify-between">
                                        <a href="{{ route("post.show", $saved_post->post->id) }}">
                                            <div class="flex items-center gap-4">
                                                <div class="bg-gray-900 p-3 rounded-lg">
                                                    <x-heroicon-s-bookmark class="w-8 h-8 text-gray-400"/>
                                                </div>
                                                <div class="text-left">
                                                    <p class="text-lg font-semibold text-white hover:text-violet-200">
                                                        {{ $saved_post->post->title }}</p>
                                                    <p class="text-xs text-gray-400">{{ $saved_post->created_at->translatedFormat('d F Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <livewire:save-button :post="$saved_post->post"/>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 text-center text-lg">
                                Henüz kaydedilmiş bir form bulunmuyor. 🌿
                            </p>
                        @endif
                    </template>


                    <template x-if="content_type === 'begenilenler'">
                        @if($user->likedPosts->count())
                            <ul class="text-gray-200 text-center flex flex-col gap-y-4 mt-6">
                                @foreach($user->likedPosts as $liked_post)
                                    <li class="p-5 bg-gray-800 rounded-xl shadow-lg border border-gray-700 cursor-pointer flex justify-between">
                                        <a href="{{ route("post.show", $liked_post->post->id) }}">
                                            <div class="flex items-center gap-4">
                                                <div class="bg-gray-900 p-3 rounded-lg">
                                                    <x-heroicon-s-hand-thumb-up class="w-8 h-8 text-gray-400"/>
                                                </div>
                                                <div class="text-left">
                                                    <p class="text-lg font-semibold text-white hover:text-violet-200">
                                                        {{ $liked_post->post->title }}</p>
                                                    <p class="text-xs text-gray-400">{{ $liked_post->created_at->translatedFormat('d F Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <livewire:like-button :post="$liked_post->post"/>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 text-center text-lg">
                                Henüz beğenilen bir form bulunmuyor. 🌿
                            </p>
                        @endif
                    </template>

                </div>
            </div>

        </section>
    </div>

</x-layouts.user-details-layout>
