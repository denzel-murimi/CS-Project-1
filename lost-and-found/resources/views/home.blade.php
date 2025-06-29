@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Lost Something?
                <span class="text-blue-600">We'll Help You Find It</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Strathmore University's Lost & Found system connects students, staff and faculty to reunite with their lost belongings.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('items.lost.create') }}" class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-200 flex items-center justify-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Report Lost Item
                </a>
                <a href="{{ route('items.found.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-200 flex items-center justify-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Report Found Item
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="bg-white py-8 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" placeholder="Search for lost or found items..." 
                class="w-full pl-10 pr-4 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
            <button class="absolute right-2 top-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                Search
            </button>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>
                    Filters
                </h3>
                
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-3">Item Status</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Lost Items</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Found Items</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-3">Category</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Electronics</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Personal Items</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Documents</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Clothing</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Books</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Location</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Library</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Cafeteria</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Classrooms</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Sports Center</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items List -->
        <div class="lg:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Recent Items</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Sort by:</span>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                       <option>Most Recent</option>
                       <option>Oldest First</option>
                       <option>Location</option>
                   </select>
               </div>
           </div>

           <div class="grid gap-6">
               @foreach ($recentItems as $item)
                   <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                       <div class="flex">
                           <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center mr-6 flex-shrink-0">
                               @if($item->image_path)
                                   <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="object-cover w-full h-full rounded-lg">
                               @else
                                   <i class="fas fa-{{ $item->category == 'electronics' ? 'mobile-alt' : ($item->category == 'documents' ? 'file-alt' : ($item->category == 'clothing' ? 'tshirt' : ($item->category == 'books' ? 'book' : 'box'))) }} text-gray-400 text-2xl"></i>
                               @endif
                           </div>
                           <div class="flex-1">
                               <div class="flex items-start justify-between">
                                   <div>
                                       <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                           {{ $item->name }}
                                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type == 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} ml-2">
                                               {{ strtoupper($item->type) }}
                                           </span>
                                       </h3>
                                       <p class="text-gray-600 mb-2">{{ $item->description ?? 'No description available' }}</p>
                                       <div class="flex items-center text-sm text-gray-500 space-x-4">
                                           <span class="flex items-center">
                                               <i class="fas fa-map-marker-alt mr-1"></i>
                                               {{ $item->location }}
                                           </span>
                                           <span class="flex items-center">
                                               <i class="fas fa-calendar mr-1"></i>
                                               {{ $item->date_lost_found->format('M j, Y') }}
                                           </span>
                                       </div>
                                   </div>
                                   <a href="{{ route('items.show', $item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                                       View Details
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>

           @if($recentItems->isEmpty())
               <div class="text-center py-12">
                   <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                   <h3 class="text-lg font-medium text-gray-900 mb-2">No items found</h3>
                   <p class="text-gray-500">Be the first to report a lost or found item!</p>
               </div>
           @endif

           <!-- Load More Button -->
           @if($recentItems->count() >= 10)
               <div class="text-center mt-8">
                   <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition duration-200">
                       Load More Items
                   </button>
               </div>
           @endif
       </div>
   </div>
</div>

<!-- Stats Section -->
<div class="bg-blue-600 text-white py-16">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center mb-12">
           <h2 class="text-3xl font-bold mb-4">Helping Our Community</h2>
           <p class="text-blue-100 text-lg">See how we're making a difference at Strathmore University</p>
       </div>
       <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
           <div>
               <div class="text-4xl font-bold mb-2">{{ $stats['items_reunited'] ?? 248 }}</div>
               <div class="text-blue-100">Items Reunited</div>
           </div>
           <div>
               <div class="text-4xl font-bold mb-2">{{ $stats['success_rate'] ?? '89%' }}</div>
               <div class="text-blue-100">Success Rate</div>
           </div>
           <div>
               <div class="text-4xl font-bold mb-2">{{ $stats['active_users'] ?? 1205 }}</div>
               <div class="text-blue-100">Active Users</div>
           </div>
           <div>
               <div class="text-4xl font-bold mb-2">{{ $stats['pending_items'] ?? 38 }}</div>
               <div class="text-blue-100">Pending Items</div>
           </div>
       </div>
   </div>
</div>
@endsection