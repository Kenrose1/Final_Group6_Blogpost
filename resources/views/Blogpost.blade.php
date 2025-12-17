<!-- resources/views/BlogPostsList.blade.php -->
<x-app-layout>
    <div class="container mx-auto px-4 py-12 lg:py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold mb-8 text-center text-gray-900 dark:text-gray-100 tracking-tight border-b-2 border-blue-500 pb-3">
            Latest Blog Posts
        </h1>

        <!-- NEW SEARCH BAR FOR CATEGORIES -->
        <div class="max-w-xl mx-auto mb-12">
            <label for="category-search" class="sr-only">Search Categories</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="category-search" onkeyup="filterPosts()"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-700 rounded-xl leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                    placeholder="Search posts by category...">
            </div>
        </div>
        <!-- END SEARCH BAR -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="posts-grid">
            <div id="no-results-message" class="col-span-full text-center py-16 hidden">
                <p class="text-xl text-gray-500 dark:text-gray-400">
                    No posts found matching that category. Try a different search!
                </p>
            </div>
            @foreach ($posts as $post)
            <!-- Post Card Container -->
            <div id="post-{{ $post->id }}"
                class="post-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden cursor-pointer 
                            transition duration-300 transform hover:scale-[1.03] hover:shadow-2xl">

                <!-- TEXT-ONLY VISUAL HEADER -->
                <a href="javascript:void(0)"
                    style="background: radial-gradient(circle at top right, #3b82f6 0%, #1e40af 100%);"
                    class="block p-6 h-32 dark:bg-blue-900 
                            flex flex-col justify-end text-white hover:opacity-90 transition duration-150">
                    <h3 class="text-2xl font-extrabold leading-snug tracking-tight">
                        {{ $post->title }}
                    </h3>
                    <p class="text-xs mt-1 opacity-90 font-medium">
                        Published: {{ $post->created_at->format('M d, Y') ?? 'N/A' }}
                    </p>
                </a>

                <div class="p-6">

                    <!-- CATEGORY BADGE (Essential for search filtering) -->
                    @if ($post->category ?? false)
                    <p class="category-tag inline-block px-3 py-1 mb-4 text-xs font-bold uppercase tracking-wider 
                                bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 rounded-full shadow-sm">
                        {{ $post->category->name }}
                    </p>
                    @endif

                    <!-- Short Excerpt always visible -->
                    <!-- NOTE: The category name was merged into this paragraph in the user's previous code, -->
                    <!-- Full Post Body (Initially Hidden) -->
                    <div id="post-body-{{ $post->id }}" class="full-body-content hidden pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-gray-700 dark:text-gray-400 leading-relaxed text-base">
                            {{ $post->text ?? $post->body }}
                        </p>
                    </div>

                    <div class="flex items-center justify-start pt-2">
                        <!-- Toggle Button (Controls text visibility) -->
                        <button id="toggle-btn-{{ $post->id }}" onclick="togglePostBody({{ $post->id }})"
                            class="text-blue-600 dark:text-blue-400 font-bold hover:text-blue-800 transition duration-150 text-sm 
                                        inline-flex items-center space-x-1">
                            Show Full Post
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Placeholder for Pagination (assuming $posts is a paginated collection) -->
        <div class="mt-12 text-center">
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>

    <script>
function togglePostBody(postId) {
            const bodyElement = document.getElementById(`post-body-${postId}`);
            const buttonElement = document.getElementById(`toggle-btn-${postId}`);

            if (bodyElement.classList.contains('hidden')) {
                // Show the full body
                bodyElement.classList.remove('hidden');
                bodyElement.classList.add('block');
                if (buttonElement) {
                    buttonElement.innerText = 'Hide Post';
                }
            } else {
                // Hide the full body
                bodyElement.classList.remove('block');
                bodyElement.classList.add('hidden');
                if (buttonElement) {
                    buttonElement.innerText = 'Show Full Post';
                }
            }
        }

        /**
         * Filters blog posts displayed in the grid based on the category tag text.
         */
        function filterPosts() {
            const input = document.getElementById('category-search');
            const filter = input.value.toLowerCase();
            const postsGrid = document.getElementById('posts-grid');
            const postCards = postsGrid.getElementsByClassName('post-card');
            const noResultsMessage = document.getElementById('no-results-message');
            
        let visiblePostCount = 0; 

            for (let i = 0; i < postCards.length; i++) {
                const card = postCards[i];
                const tagElement = card.querySelector('.category-tag');
                let shouldShow = false;

                if (tagElement) {
                    const categoryText = tagElement.textContent || tagElement.innerText;
                    
                    if (categoryText.toLowerCase().includes(filter)) {
                        shouldShow = true;
                    }
                } else if (filter === '') {
                    // If filter is empty and there's no tag, show by default (assuming posts without categories are still visible)
                    shouldShow = true;
                }

                // Toggle visibility
                if (shouldShow) {
                    card.style.display = ""; // Reset to default display (grid item)
                    visiblePostCount++;
                } else {
                    card.style.display = "none";
                }
            }
            
            // Toggle "No results" message based on the count of visible posts
            if (visiblePostCount === 0) {
                noResultsMessage.classList.remove('hidden');
                noResultsMessage.classList.add('block');
            } else {
                noResultsMessage.classList.remove('block');
                noResultsMessage.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>