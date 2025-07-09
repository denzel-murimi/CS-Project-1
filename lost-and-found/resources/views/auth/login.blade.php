@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
    <div class="bg-white shadow rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-800">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block mb-1 font-semibold">Username</label>
                <input type="text" id="username" name="username" class="w-full border rounded p-2" value="{{ old('username') }}" required>
                @error('username')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded p-2" required>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full font-semibold hover:bg-blue-700 transition">Login</button>
            <p class="mt-4 text-sm text-center">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Your Password?</a>
            </p>
            <p class="mt-4 text-sm text-gray-600 text-center">
                Not a member?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
            </p>
        </form>
    </div>
</div>
@endsection
