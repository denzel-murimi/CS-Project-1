@extends('layouts.app')

@section('title', 'Claim Item')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8">
    <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-xl w-full">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-16 h-16 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
            </svg>
            <h1 class="text-3xl font-extrabold text-blue-800 mb-1">Claim: {{ $item->name }}</h1>
            <p class="text-gray-600 text-center">Tell us why you believe this item is yours and provide your contact info. You can also upload a photo for proof.</p>
        </div>
        <form method="POST" action="{{ route('claims.store', $item) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="message" class="block mb-1 font-semibold">Why do you believe this is yours?</label>
                <textarea id="message" name="message" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400" required>{{ old('message') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="contact_info" class="block mb-1 font-semibold">Your Contact Info</label>
                <textarea id="contact_info" name="contact_info" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400" required>{{ old('contact_info') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-semibold mb-2">Upload Photo (Optional)</label>
                <input type="file" name="photo" id="photo" class="border border-gray-300 rounded-full px-3 py-2 w-full focus:ring-2 focus:ring-blue-400" accept="image/*">
                @error('photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-full w-full font-semibold hover:from-blue-600 hover:to-blue-800 transition text-lg shadow-lg mt-2">Submit Claim</button>
        </form>
    </div>
</div>
@endsection
