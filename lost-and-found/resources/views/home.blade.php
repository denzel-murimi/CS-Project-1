@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-6">
    {{-- Header --}}
    <div class="bg-white shadow p-6 flex justify-between items-center">
        <div class="text-2xl font-bold">SU Lost & Found System</div>
        <div class="space-x-4">
            @guest
                <a href="{{ route('login') }}" class="button">Login</a>
                <a href="{{ route('register') }}" class="button bg-black text-white px-4 py-2 rounded">Sign Up</a>
            @else
                <span>Welcome, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="button">Logout</button>
                </form>
            @endguest
        </div>
    </div>

    {{-- Nav --}}
    <div class="bg-gray-200 py-3 px-6 flex space-x-6">
        <a href="{{ route('home') }}" class="nav-item">Home</a>
        <a href="{{ route('items.index') }}" class="nav-item">Lost Items</a>
        <a href="{{ route('items.index') }}" class="nav-item">Found Items</a>
        <a href="{{ route('items.lost.create') }}" class="nav-item">Report Item</a>
        @auth
            <a href="#" class="nav-item">My Account</a>
        @endauth
        <a href="#" class="nav-item">Contact</a>
    </div>

    {{-- Search --}}
    <div class="max-w-6xl mx-auto mt-6 px-6">
        <input type="text" placeholder="🔍 Search for lost or found items..."
            class="w-full border-2 border-gray-400 p-3 rounded mb-6" />
    </div>

    <div class="max-w-6xl mx-auto px-6 flex">
        {{-- Sidebar --}}
        <div class="w-1/4">
            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Filters</h3>
                <div><input type="checkbox" /> Lost Items</div>
                <div><input type="checkbox" /> Found Items</div>
            </div>
            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Category</h3>
                <div><input type="checkbox" /> Electronics</div>
                <div><input type="checkbox" /> Personal Items</div>
                <div><input type="checkbox" /> Documents</div>
                <div><input type="checkbox" /> Clothing</div>
                <div><input type="checkbox" /> Books</div>
            </div>
            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Location</h3>
                <div><input type="checkbox" /> Library</div>
                <div><input type="checkbox" /> Cafeteria</div>
                <div><input type="checkbox" /> Classrooms</div>
                <div><input type="checkbox" /> Sports Center</div>
            </div>
        </div>

        {{-- Main content --}}
        <div class="w-3/4 pl-6">
            <h2 class="text-xl font-bold mb-4">Recent Items</h2>

            @foreach ($recentItems as $item)
    <div class="flex bg-white border rounded p-4 mb-4">
        <div class="w-24 h-24 bg-gray-300 flex items-center justify-center mr-4">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="object-cover w-full h-full">
            @else
                <span>{{ ucfirst($item->category) }}</span>
            @endif
        </div>
        <div>
            <h3 class="font-bold text-lg">
                {{ $item->name }}
                <span class="uppercase text-sm text-{{ $item->statusColor }}">{{ strtoupper($item->type) }}</span>
            </h3>
            <p class="text-sm">📍 {{ $item->location }}</p>
            <p class="text-xs text-gray-500">📅 {{ $item->date_lost_found->format('F j, Y') }}</p>
            <a href="{{ route('items.show', $item->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">View Details</a>
        </div>
    </div>
@endforeach

        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center py-6 text-gray-500 mt-10 border-t">
        © 2025 Strathmore University Lost & Found System
    </div>
</div>
@endsection
