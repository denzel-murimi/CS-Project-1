@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Report Lost Item</h1>

    @if ($errors->any())


        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('items.lost.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border rounded p-2" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Category</label>
            <select name="category" class="w-full border rounded p-2" required>
                <option value="">Select a category</option>
                @foreach ($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Location</label>
            <select name="location" class="w-full border rounded p-2" required>
                <option value="">Select a location</option>
                @foreach ($locations as $loc)
                    <option value="{{ $loc }}" {{ old('location') === $loc ? 'selected' : '' }}>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Date Lost</label>
            <input type="date" name="date_lost_found" class="w-full border rounded p-2" value="{{ old('date_lost_found') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Contact Info</label>
            <textarea name="contact_info" class="w-full border rounded p-2">{{ old('contact_info') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Upload Image</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>
</div>
@endsection
