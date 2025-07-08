@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Item</h1>

    <form action="{{ route('admin.items.update', $item->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <input type="text" name="type" id="type" value="{{ $item->type }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="claimed" {{ $item->status == 'claimed' ? 'selected' : '' }}>Claimed</option>
                <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $item->description }}</textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Update</button>
    </form>
</div>
@endsection
