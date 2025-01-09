<div class="h-screen w-screnn flex flex-col">
    <header class="w-full px-20 h-16 border-b border-zinc-300 flex items-center justify-center">
        header
    </header>


    <div class="flex">
        <aside class="w-[250px] border-r border-zinc-400 p-4 h-[calc(100vh-64px)]">
            sidebar
        </aside>

        <main class="flex-1 p-5">
            <div class="bg-primary">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
