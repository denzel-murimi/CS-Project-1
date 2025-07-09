@extends('layouts.app')

@section('title', 'Browse Lost & Found Items')

@section('content')

<div class="max-w-7xl mx-auto mt-10">
    <div class="bg-white bg-opacity-90 rounded-3xl shadow-2xl p-8 md:p-12">
        <div class="flex items-center mb-8">
            <svg class="w-10 h-10 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Browse Lost & Found Items</h1>
        </div>

        <form method="GET" action="{{ route('items.search') }}" class="mb-10 grid grid-cols-1 md:grid-cols-4 gap-4">
            <input
                type="text"
                name="q"
                id="q"
                placeholder="Search by name, description, location"
                value="{{ request('q') }}"
                class="w-full rounded-full px-5 py-3 border-0 shadow focus:ring-2 focus:ring-blue-300 bg-blue-50 placeholder-gray-400 text-gray-800"
                aria-label="Search by name, description, location"
            >

            <select name="type" id="type" class="w-full rounded-full px-5 py-3 border-0 shadow focus:ring-2 focus:ring-blue-300 bg-blue-50 text-gray-800">
                <option value="">All Types</option>
                <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
            </select>

            <select name="category" id="category" class="w-full rounded-full px-5 py-3 border-0 shadow focus:ring-2 focus:ring-blue-300 bg-blue-50 text-gray-800">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>

            <input
                type="text"
                name="location"
                id="location"
                placeholder="Search by location"
                value="{{ request('location') }}"
                class="w-full rounded-full px-5 py-3 border-0 shadow focus:ring-2 focus:ring-blue-300 bg-blue-50 placeholder-gray-400 text-gray-800"
                aria-label="Search by location"
            >

            <button type="submit" class="col-span-1 md:col-span-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold py-3 rounded-full shadow-lg hover:from-blue-600 hover:to-blue-800 transition">
                <span class="inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    Search
                </span>
            </button>
        </form>

        @if ($items->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($items as $item)
                    <div class="bg-white rounded-3xl shadow-xl p-6 flex flex-col hover:shadow-2xl transition-all">
                        @if ($item->image_path)
                            <img
                                src="{{ asset('storage/' . $item->image_path) }}"
                                alt="{{ $item->name }}"
                                class="w-full h-40 object-cover mb-4 rounded-2xl border-4 border-blue-100"
                            >
                        @else
                            <div class="w-full h-40 flex items-center justify-center bg-blue-50 text-blue-300 mb-4 rounded-2xl border-4 border-blue-100">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            </div>
                        @endif

                        <h2 class="text-lg font-bold mb-2 text-blue-700">
                            <a href="{{ route('items.show', $item) }}" class="hover:text-blue-500 transition">
                                {{ $item->name }}
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-1 text-sm">
                            <strong>Category:</strong> {{ ucfirst($item->category) }}
                        </p>
                        <p class="text-gray-600 mb-1 text-sm">
                            <strong>Location:</strong> {{ $item->location }}
                        </p>
                        <p class="text-gray-600 mb-1 text-sm">
                            <strong>Type:</strong>
                            <span class="font-semibold text-{{ $item->status_color }}">
                                {{ ucfirst($item->type) }}
                            </span>
                        </p>
                        <p class="text-gray-400 text-xs mt-auto">
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-center mt-10">
                <p class="text-gray-500">No items found. Try adjusting your filters.</p>
            </div>
        @endif
    </div>
</div>
@endsection
