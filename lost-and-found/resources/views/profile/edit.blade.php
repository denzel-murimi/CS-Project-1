@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-8">
            <svg class="w-12 h-12 text-blue-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <div>
                <h2 class="text-3xl font-extrabold text-blue-800 mb-1">Edit Profile</h2>
                <p class="text-gray-600">Update your account details below. Your information is kept private.</p>
            </div>
        </div>
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        {{-- Profile Update Form --}}
        <form method="POST" action="{{ route('profile.update') }}" class="bg-white shadow-2xl rounded-3xl p-8 mb-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                           class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-1">New Password (optional)</label>
                    <input id="password" type="password" name="password"
                           class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-full w-full font-semibold hover:from-blue-600 hover:to-blue-800 transition text-lg shadow-lg mt-8">Save Changes</button>
        </form>
        {{-- Delete Account Form --}}
        <form method="POST" action="{{ route('profile.destroy') }}" class="bg-white shadow-2xl rounded-3xl p-8 text-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-full w-full mt-2">Delete Account</button>
        </form>
    </div>
</div>
@endsection
