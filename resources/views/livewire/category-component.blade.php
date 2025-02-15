<x-layouts.layout>
    <h2 class="text-2xl font-bold mb-6">Kategoriler</h2>

    <div class="bg-transparent p-4 flex flex-col gap-3">
        @foreach($categories as $category)
            <div
                class="flex items-center relative space-x-4 p-4  hover:bg-gray-600 transition duration-200 rounded-lg">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach($category->mostSharedTopics(count: 3) as $topic)
                            <a href="{{ route('topic.detail', $topic) }}" class="text-indigo-500 text-sm font-medium">#{{ $topic->name }}</a>
                        @endforeach
                    </div>
                    <span class="text-gray-500 text-sm mt-1"> {{ $category->posts->count() }} Gönderi</span>
                </div>
                <a href="{{ route('category.detail', $category) }}"
                class="absolute right-5 text-sm text-indigo-400 bottom-1/2 flex items-center p-1 gap-2 cursor-pointer">
                    <span>Görüntüle</span>
                    <x-icon name="heroicon-s-arrow-right-circle" class="size-4"/>
                </a>
            </div>
        @endforeach
    </div>
</x-layouts.layout>
