<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- STYLED ERROR ALERT -->
                    @if ($errors->any())
                        <div class="bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg relative mb-6" role="alert">
                            <strong class="font-bold">Validation Error!</strong>
                            <span class="block sm:inline"> Please correct the following issues:</span>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- /STYLED ERROR ALERT -->
                    
                    <!-- MAIN UPDATE FORM -->
                    <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- TITLE INPUT -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title:</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                value="{{ old('title', $post->title) }}" 
                                required 
                                autofocus
                            >
                        </div>

                        <!-- TEXT / BODY INPUT -->
                        <div>
                            <label for="text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Body / Content:</label>
                            <textarea 
                                name="text" 
                                id="text" 
                                rows="8"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                required
                            >{{ old('text', $post->text ?? '') }}</textarea>
                        </div>
                        
                        <!-- CATEGORY SELECT -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category:</label>
                            <select 
                                name="category_id" 
                                id="category_id" 
                                class="w-full md:w-1/2 rounded-lg shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                                required
                            >
                                <option value="" disabled>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="pt-4 flex items-center space-x-3">
                            <!-- SAVE BUTTON -->
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider 
                                hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Save Changes') }}
                            </button>

                            <!-- DELETE BUTTON -->
                            <button type="button" 
                                    onclick="document.getElementById('delete-form').submit()"
                                    class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider 
                                           hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </form>
                    
                    <!-- Hidden Delete Form (Required for DELETE requests) -->
                    <form id="delete-form" method="POST" action="{{ route('posts.destroy', $post) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>