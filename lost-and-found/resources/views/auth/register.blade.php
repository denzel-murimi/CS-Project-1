@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border rounded p-2" value="{{ old('username') }}" required>
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Phone</label>
            <input type="text" name="phone" class="w-full border rounded p-2" value="{{ old('phone') }}">
            @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Register
        </button>

        <!-- Login Link - ADD THIS SECTION -->
        <p class="mt-4 text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Login here
            </a>
        </p>
    </form>
</div>
@endsection
