<div class="h-screen w-screen flex" x-data="{ sidebarContent: 'default' }" >
    <x-aside.left-sidebar/>

    <div class="flex-1 flex-col bg-primary">
        <x-header.header/>

        <div class="grid grid-cols-12 justify-between">
            <main class="bg-primary col-span-9 p-5 w-full h-[calc(100vh-80px)] overflow-auto">
                {{ $slot }}
            </main>
            <livewire:right-sidebar/>
        </div>
    </div>
</div>
</div>


