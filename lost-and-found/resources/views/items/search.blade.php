@extends('layouts.app')

@section('title', 'Browse Lost & Found Items')

@section('content')
<div class="max-w-7xl mx-auto mt-10">

    <h1 class="text-3xl font-bold mb-6">Browse Lost & Found Items</h1>

    <form method="GET" action="{{ route('items.search') }}" class="mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <input
            type="text"
            name="q"
            placeholder="Search by name, description, location"
            value="{{ request('q') }}"
            class="w-full border rounded p-2"
        >

        <select name="type" class="w-full border rounded p-2">
            <option value="">All Types</option>
            <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
            <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
        </select>

        <select name="category" class="w-full border rounded p-2">
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
            placeholder="Search by location"
            value="{{ request('location') }}"
            class="w-full border rounded p-2"
        >

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded col-span-1 md:col-span-4">
            Search
        </button>
    </form>

    @if ($items->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($items as $item)
                <div class="bg-white rounded shadow p-4 hover:shadow-lg transition">
                    @if ($item->image_path)
                        <img
                            src="{{ asset('storage/' . $item->image_path) }}"
                            alt="{{ $item->name }}"
                            class="w-full h-40 object-cover mb-4 rounded"
                        >
                    @else
                        <div class="w-full h-40 flex items-center justify-center bg-gray-100 text-gray-500 mb-4 rounded">
                            No image
                        </div>
                    @endif

                    <h2 class="text-lg font-bold mb-2">
                        <a href="{{ route('items.show', $item) }}" class="hover:text-blue-600">
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
                        <span class="text-{{ $item->status_color }}">
                            {{ ucfirst($item->type) }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-sm">
                        {{ $item->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $items->links() }}
        </div>
    @else
        <div class="text-center mt-10">
            <p class="text-gray-500">No items found. Try adjusting your filters.</p>
        </div>
    @endif

</div>
@endsection
