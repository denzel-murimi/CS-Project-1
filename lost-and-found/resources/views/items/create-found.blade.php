@extends('layouts.app')

@section('title', 'Report Found Item')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8 px-4">
    <div class="max-w-2xl mx-auto bg-white shadow-2xl rounded-3xl p-10">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-14 h-14 text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <h1 class="text-3xl font-extrabold text-green-800 mb-1">Report Found Item</h1>
            <p class="text-gray-600 text-center">Found something? Help return it to its owner.<br>Fill in the details below.</p>
        </div>
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('items.found.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold">Name</label>
                <input id="name" type="text" name="name" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-green-400" value="{{ old('name', $prefill->name ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-1 font-semibold">Description</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 rounded-3xl p-3 focus:ring-2 focus:ring-green-400" required>{{ old('description', $prefill->description ?? '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="block mb-1 font-semibold">Category</label>
                <select id="category" name="category" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-green-400" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $prefill->category ?? '') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="location" class="block mb-1 font-semibold">Location</label>
                <select id="location" name="location" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-green-400" required>
                    <option value="">Select a location</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc }}" {{ old('location', $prefill->location ?? '') == $loc ? 'selected' : '' }}>
                            {{ $loc }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date_lost_found" class="block mb-1 font-semibold">Date Found</label>
                <input id="date_lost_found" type="date" name="date_lost_found" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-green-400" value="{{ old('date_lost_found', optional($prefill?->date_lost_found)->format('Y-m-d')) }}" required>
            </div>
            <div class="mb-4">
                <label for="unique_identifiers" class="block text-gray-700 font-semibold mb-1">Unique Identifiers (Private, for Admin only)</label>
                <textarea name="unique_identifiers" id="unique_identifiers" class="w-full border border-gray-300 rounded-3xl p-3 focus:ring-2 focus:ring-green-400" placeholder="E.g. bag contained textbooks, wallet has initials, etc.">{{ old('unique_identifiers') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="contact_info" class="block mb-1 font-semibold">Contact Info</label>
                <textarea id="contact_info" name="contact_info" class="w-full border border-gray-300 rounded-3xl p-3 focus:ring-2 focus:ring-green-400">{{ old('contact_info', $prefill->contact_info ?? '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block mb-1 font-semibold">Upload Image</label>
                <input id="image" type="file" name="image" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-green-400">
            </div>
            <button type="submit" class="bg-gradient-to-r from-green-500 to-green-700 text-white px-4 py-2 rounded-full w-full font-semibold hover:from-green-600 hover:to-green-800 transition text-lg shadow-lg mt-2">Submit</button>
        </form>
    </div>
</div>
@endsection
