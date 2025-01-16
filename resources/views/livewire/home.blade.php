<x-layouts.layout>
    <form class="p-1 flex w-full gap-x-3 bg-secondary rounded-lg p-4">
        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
            <x-icon class="size-4" name="heroicon-o-user"/>
        </div>
        <div class="flex-1 w-full flex-col gap-y-2">
            <textarea
                rows="3"
                class="px-4 py-2 rounded-lg bg-gray-800 w-full focus:ring-0 outline-none focus:ring-0 focus:outline-none"
                placeholder="Ne düşünüyorsunuz?"></textarea>

            <div class="flex justify-between items-center pt-4">
                <ul class="flex items-center gap-x-4">
                    <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                        <x-icon class="size-4" name="heroicon-o-photo"/>
                        <span>Fotoğraf</span>
                    </li>
                    <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                        <x-icon class="size-4" name="heroicon-o-video-camera"/>
                        <span>Video</span>
                    </li>
                    <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                        <x-icon class="size-4" name="heroicon-o-paper-clip"/>
                        <span>Dosya</span>
                    </li>
                    <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                        <x-icon class="size-4" name="heroicon-o-face-smile"/>
                        <span>Emoji</span>
                    </li>
                </ul>
                <button
                    class="px-6 py-2 flex items-center text-sm bg-blue-600 justify-center rounded-lg hover:bg-blue-700 font-medium">
                    Paylaş
                </button>
            </div>
        </div>
    </form>


    <section class="p-1 flex w-full gap-x-3  rounded-lg p-4 mt-6 bg-secondary">
        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
            <x-icon class="size-4" name="heroicon-o-user"/>
        </div>

        <div class="flex w-full flex-col gap-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-4 text-zinc-400">
                    <span class="text-sm">Mehmet Yılmaz</span>
                    <span class="text-xs">1 saat önce</span>
                </div>
                <x-icon class="size-6 cursor-pointer text-zinc-400" name="heroicon-o-ellipsis-horizontal"/>
            </div>

            <div class="flex flex-col gap-y-2">
                <h3 class="font-medium">2024 F1 Lansman Araçları</h3>
                <p class="text-zinc-200 text-xs">
                    Bu sezon lansmanlarında en çok dikkatimi çeken Mercedes'in radikal tasarım değişiklikleri oldu.
                    Özellikle sidepod tasarımı ve arka süspansiyon çözümü oldukça ilginç. Sizce bu değişiklikler Red
                    Bull
                    dominasyonunu sonlandırabilir mi?
                </p>
            </div>

            <ul class="flex items-center gap-x-4 pt-2">
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-hand-thumb-up"/>
                    <span>Beğen</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-m-chat-bubble-left-ellipsis"/>
                    <span>Yorum</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-share"/>
                    <span>Paylaş</span>
                </li>
            </ul>
        </div>
    </section>
    <section class="p-1 flex w-full gap-x-3  rounded-lg p-4 mt-6 bg-secondary">
        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
            <x-icon class="size-4" name="heroicon-o-user"/>
        </div>

        <div class="flex w-full flex-col gap-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-4 text-zinc-400">
                    <span class="text-sm">Mehmet Yılmaz</span>
                    <span class="text-xs">1 saat önce</span>
                </div>
                <x-icon class="size-6 cursor-pointer text-zinc-400" name="heroicon-o-ellipsis-horizontal"/>
            </div>

            <div class="flex flex-col gap-y-2">
                <h3 class="font-medium">2024 F1 Lansman Araçları</h3>
                <p class="text-zinc-200 text-xs">
                    Bu sezon lansmanlarında en çok dikkatimi çeken Mercedes'in radikal tasarım değişiklikleri oldu.
                    Özellikle sidepod tasarımı ve arka süspansiyon çözümü oldukça ilginç. Sizce bu değişiklikler Red
                    Bull
                    dominasyonunu sonlandırabilir mi?
                </p>
            </div>

            <ul class="flex items-center gap-x-4 pt-2">
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-hand-thumb-up"/>
                    <span>Beğen</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-m-chat-bubble-left-ellipsis"/>
                    <span>Yorum</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-share"/>
                    <span>Paylaş</span>
                </li>
            </ul>
        </div>
    </section>
    <section class="p-1 flex w-full gap-x-3  rounded-lg p-4 mt-6 bg-secondary">
        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
            <x-icon class="size-4" name="heroicon-o-user"/>
        </div>

        <div class="flex w-full flex-col gap-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-4 text-zinc-400">
                    <span class="text-sm">Mehmet Yılmaz</span>
                    <span class="text-xs">1 saat önce</span>
                </div>
                <x-icon class="size-6 cursor-pointer text-zinc-400" name="heroicon-o-ellipsis-horizontal"/>
            </div>

            <div class="flex flex-col gap-y-2">
                <h3 class="font-medium">2024 F1 Lansman Araçları</h3>
                <p class="text-zinc-200 text-xs">
                    Bu sezon lansmanlarında en çok dikkatimi çeken Mercedes'in radikal tasarım değişiklikleri oldu.
                    Özellikle sidepod tasarımı ve arka süspansiyon çözümü oldukça ilginç. Sizce bu değişiklikler Red
                    Bull
                    dominasyonunu sonlandırabilir mi?
                </p>
            </div>

            <ul class="flex items-center gap-x-4 pt-2">
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-hand-thumb-up"/>
                    <span>Beğen</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-m-chat-bubble-left-ellipsis"/>
                    <span>Yorum</span>
                </li>
                <li class="flex items-center gap-x-2 text-zinc-400 text-sm hover:text-blue-500 cursor-pointer">
                    <x-icon class="size-4" name="heroicon-o-share"/>
                    <span>Paylaş</span>
                </li>
            </ul>
        </div>
    </section>
</x-layouts.layout>
