@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border rounded p-2" value="{{ old('username') }}" required>
            @error('username')
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

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Login
        </button>

        <p class="mt-4 text-sm">
            <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                Forgot Your Password?
            </a>
        </p>

        <!-- Register Link - ADD THIS SECTION -->
        <p class="mt-4 text-sm text-gray-600">
            Not a member?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                Register here
            </a>
        </p>
    </form>
</div>
@endsection
