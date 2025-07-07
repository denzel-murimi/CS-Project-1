@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

    {{-- Profile Update Form --}}
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">New Password (optional)</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1">Confirm New Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                Save Changes
            </button>
        </div>
    </form>

    {{-- Delete Account Form --}}
    <form method="POST"
          action="{{ route('profile.destroy') }}"
          class="mt-8 text-right"
          onsubmit="return confirm('Are you sure you want to delete your account?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded">
            Delete Account
        </button>
    </form>

</div>
@endsection
