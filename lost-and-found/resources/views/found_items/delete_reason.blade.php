@extends('layouts.app')

@section('title', 'Request Deletion')

@section('content')
<div class="max-w-lg mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">
        Request Deletion for "{{ $item->name }}"
    </h1>

    <form action="{{ route('found.items.delete.reason.submit', $item->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="reason" class="block text-gray-700 font-semibold">Reason for deletion</label>
            <textarea name="reason" id="reason" rows="4"
                class="w-full border border-gray-300 rounded mt-1 p-2"
                required>{{ old('reason') }}</textarea>
            @error('reason')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Submit Request
        </button>
    </form>
</div>
@endsection
