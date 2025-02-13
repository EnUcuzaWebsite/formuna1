<div class="flex w-screen h-screen" x-data="{ sidebarContent: 'default' }">
  <livewire:left-sidebar/>
    <div class="flex-col flex-1">
        <livewire:header/>

        <div class="grid justify-between grid-cols-12">
            <main class="col-span-9 p-5 w-full h-[calc(100vh-80px)] overflow-auto">
                {{ $slot }}
            </main>
            <livewire:right-sidebar/>
        </div>
    </div>
</div>

