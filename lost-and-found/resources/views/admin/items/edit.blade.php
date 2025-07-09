@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Item</h1>

    <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <input type="text" name="type" id="type" value="{{ old('type', $item->type) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('type')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="available" {{ old('status', $item->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="claimed" {{ old('status', $item->status) == 'claimed' ? 'selected' : '' }}>Claimed</option>
                <option value="inactive" {{ old('status', $item->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Current Photo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Photo</label>
            @if ($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="Item Photo" class="w-48 h-auto mt-2 rounded border border-gray-300">
            @else
                <p class="text-gray-500 mt-2">No photo uploaded.</p>
            @endif
        </div>

        {{-- New Photo --}}
        <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Change Photo</label>
            <input type="file" name="photo" id="photo" class="mt-1 block w-full">
            @error('photo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex space-x-4">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update</button>
            <a href="{{ route('admin.items.show', $item->id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</a>
        </div>
    </form>
</div>
@endsection
