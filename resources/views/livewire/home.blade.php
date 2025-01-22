<x-layouts.layout>
    <h1 class="text-2xl font-bold">Anasayfa</hjson>
    @foreach ($posts as $post )
        <livewire:post-view :post="$post"/>
    @endforeach
    <br>
    {{ $posts->links() }}

</x-layouts.layout>

