@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-8 max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-indigo-700 flex items-center">
            <svg class="w-8 h-8 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Item Details
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Reported By</span>
                    <span class="block text-lg text-gray-900">
                        @if($item->user)
                            {{ $item->user->name }} <span class="text-gray-500">({{ $item->user->email }})</span><br>
                            <span class="text-gray-600">Student ID:</span> {{ $item->user->student_id }}<br>
                            <span class="text-gray-600">Phone:</span> {{ $item->user->phone }}
                        @else
                            <span class="text-gray-500">Unknown</span>
                        @endif
                    </span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Date Reported</span>
                    <span class="block text-lg text-gray-900">{{ $item->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Location</span>
                    <span class="block text-lg text-gray-900">{{ $item->location }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Category</span>
                    <span class="block text-lg text-gray-900">{{ $item->category }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Type</span>
                    <span class="block text-lg text-gray-900">{{ ucfirst($item->type) }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Status</span>
                    <span class="block text-lg text-gray-900">{{ ucfirst($item->status) }}</span>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Name</span>
                    <span class="block text-lg text-gray-900">{{ $item->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Description</span>
                    <span class="block text-lg text-gray-900">{{ $item->description }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs font-semibold text-gray-500 uppercase">Photo</span>
                    <span class="block text-lg text-gray-900 mt-2">
                        @if ($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="Item" class="w-48 h-auto rounded border border-gray-300">
                        @else
                            <span class="text-gray-500">No photo available.</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-8 flex space-x-4 justify-end">
            <a href="{{ route('admin.items.edit', $item->id) }}" class="px-6 py-2 bg-yellow-500 text-white rounded-md font-semibold hover:bg-yellow-600 transition">Edit</a>
            <a href="{{ route('admin.items.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md font-semibold hover:bg-gray-600 transition">Back</a>
        </div>
    </div>
</div>
@endsection
