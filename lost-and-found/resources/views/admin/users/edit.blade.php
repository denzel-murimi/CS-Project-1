@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6 max-w-lg">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Is Admin?</label>
            <select name="is_admin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>No</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
