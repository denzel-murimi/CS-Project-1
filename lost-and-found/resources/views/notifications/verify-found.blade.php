@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Verify Found Item</h1>
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Is this your lost item?</h2>
        <div class="mb-4">
            <div class="font-bold">Item Name:</div>
            <div>{{ $foundItem->name }}</div>
        </div>
        <div class="mb-4">
            <div class="font-bold">Description:</div>
            <div>{{ $foundItem->description }}</div>
        </div>
        <div class="mb-4">
            <div class="font-bold">Location Found:</div>
            <div>{{ $foundItem->location }}</div>
        </div>
        @if($foundItem->image_path)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $foundItem->image_path) }}" alt="Found Item Image" class="w-48 rounded border">
            </div>
        @endif
        <form action="{{ route('notifications.confirmFoundMatch', $foundItem->id) }}" method="POST" class="inline-block mr-2">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Yes, this is my item</button>
        </form>
        <form action="{{ route('notifications.rejectFoundMatch', $foundItem->id) }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">No, not my item</button>
        </form>
    </div>
</div>
@endsection
