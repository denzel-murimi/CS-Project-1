@extends('layouts.app')

@section('title', 'Claim Item')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Claim: {{ $item->name }}</h1>

    <form method="POST" action="{{ route('claims.store', $item) }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Why do you believe this is yours?</label>
            <textarea name="message" class="w-full border rounded p-2" required>{{ old('message') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Your Contact Info</label>
            <textarea name="contact_info" class="w-full border rounded p-2" required>{{ old('contact_info') }}</textarea>
        </div>

        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
            Submit Claim
        </button>
    </form>
</div>
@endsection
