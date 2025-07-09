@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Appeal Claim #{{ $claim->id }}</h1>
    <div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
        <div class="mb-4">
            <div class="font-bold">Item:</div>
            <div>{{ $claim->item->name ?? 'N/A' }}</div>
            <div class="text-gray-500 text-xs">{{ $claim->item->description ?? '' }}</div>
        </div>
        <form action="{{ route('claims.appeal', $claim->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="appeal_message" class="block text-sm font-medium text-gray-700">Appeal Message <span class="text-red-500">*</span></label>
                <textarea id="appeal_message" name="appeal_message" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('appeal_message') }}</textarea>
                @error('appeal_message')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Do you want to add an image to support your appeal?</label>
                <input type="file" name="appeal_photo" accept="image/*" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md">
                @error('appeal_photo')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Submit Appeal</button>
            <a href="{{ route('claims.my') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </form>
    </div>
</div>
@endsection
