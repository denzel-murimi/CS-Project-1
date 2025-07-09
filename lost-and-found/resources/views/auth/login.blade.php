@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8">
    <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-md w-full">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-16 h-16 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m4-4v8" />
            </svg>
            <h1 class="text-3xl font-extrabold text-blue-800 mb-1">Welcome Back!</h1>
            <p class="text-gray-600 text-center">Sign in to your Strathmore Lost & Found account.<br>We're glad to see you again!</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block mb-1 font-semibold">Username</label>
                <input type="text" id="username" name="username" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400" value="{{ old('username') }}" required>
                @error('username')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-full p-3 focus:ring-2 focus:ring-blue-400" required>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-full w-full font-semibold hover:from-blue-600 hover:to-blue-800 transition text-lg shadow-lg mt-2">Login</button>
            <p class="mt-6 text-sm text-center">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline font-semibold">Forgot Your Password?</a>
            </p>
            <p class="mt-4 text-sm text-gray-600 text-center">
                Not a member?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Register here</a>
            </p>
        </form>
    </div>
</div>
@endsection
