<x-layouts.layout>
    <h2 class="text-2xl font-bold mb-6">Keşfet - Kategoriler</h2>

    <div class="bg-transparent p-4">
        @foreach($categories as $category)
            <div
                class="flex items-center space-x-4 p-4  hover:bg-gray-600 transition duration-200 rounded-lg cursor-pointer">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach($category->topics as $topic)
                            <span class="text-blue-500 text-sm font-medium">#{{ $topic->name }}</span>
                        @endforeach
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Bu kategoriye ait gönderiler</p>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.layout>
