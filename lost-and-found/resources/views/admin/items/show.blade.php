@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Item Details</h1>

    <dl class="space-y-4">
        <div>
            <dt class="text-sm font-medium text-gray-700">Name</dt>
            <dd class="text-lg text-gray-900">{{ $item->name }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-700">Type</dt>
            <dd class="text-lg text-gray-900">{{ $item->type }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-700">Status</dt>
            <dd class="text-lg text-gray-900">{{ ucfirst($item->status) }}</dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-700">Description</dt>
            <dd class="text-lg text-gray-900">{{ $item->description }}</dd>
        </div>
    </dl>

    <div class="mt-6">
        <a href="{{ route('admin.items.edit', $item->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md">Edit</a>
        <a href="{{ route('admin.items.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md">Back</a>
    </div>
</div>
@endsection
