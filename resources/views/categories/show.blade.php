<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($category->posts as $post)
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-bold text-lg mb-2">
                                    <a href="{{ route('posts.index', $post) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                                <p class="text-gray-700">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-gray-500">No posts in this category yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{-- Add pagination links if you have many posts --}}
                        {{-- {{ $posts->links() }} --}}
                    </div>
                </div>
                <div class="p-6 bg-white border-t border-gray-200 flex justify-end items-center space-x-4">
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete Category
                        </button>
                    </form>
                    <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-900">
                        Back to Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
