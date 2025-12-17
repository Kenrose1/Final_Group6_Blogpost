<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- TOP METRICS GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- Posts Card -->
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-md">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Total Posts</div>
                                    <!-- FIX: Assuming $posts holds the COUNT, not a collection. -->
                                    <div class="text-lg font-semibold text-gray-900">{{ $posts }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories Card -->
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-lg shadow-md">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Total Categories</div>
                                    <div class="text-lg font-semibold text-gray-900">{{ $categories->count() }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Users Card -->
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.25-1.264-.7-1.732M7 20v-2c0-.653.25-1.264.7-1.732M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-1.657 1.343-3 3-3h4c1.657 0 3 1.343 3 3v2M7 7h10M7 7a2 2 0 01-2-2V3a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2M7 7H5m2 0h10"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Registered Users</div>
                                    <!-- FIX: Assuming $users holds the COUNT, not a collection. -->
                                    <div class="text-lg font-semibold text-gray-900">{{ $users }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories List -->
                    <div class="mt-8">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Categories</h3>
                        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200">
                                @foreach ($categories as $category)
                                    <li>
                                        <!-- FIX: Added a route placeholder, assuming a category show route exists -->
                                        <a href="{{ route('categories.show', $category) }}" class="block hover:bg-gray-50">
                                            <div class="px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between"> 
                                                    <!-- FIX: Removed the NESTED foreach loop -->
                                                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $category->name }}</p>
                                                    <div class="ml-2 flex-shrink-0 flex">
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $category->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>