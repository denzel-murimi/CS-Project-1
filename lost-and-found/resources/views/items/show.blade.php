@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="mb-2">
        <span class="font-bold text-lg">
            @if($item->type === 'lost')
                LOST ITEM
            @else
                FOUND ITEM
            @endif
        </span>
    </div>
    <h1 class="text-3xl font-bold mb-4">{{ $item->name }}</h1>

    <div class="bg-white shadow rounded p-6 mb-6">
        @if ($item->image_path)
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full max-w-sm mb-4">
        @endif

        <p class="mb-2"><strong>Description:</strong> {{ $item->description }}</p>
        <p class="mb-2"><strong>Category:</strong> {{ ucfirst($item->category) }}</p>
        <p class="mb-2"><strong>Location:</strong> {{ $item->location }}</p>
        <p class="mb-2"><strong>Date Lost/Found:</strong> {{ $item->date_lost_found->format('d M Y') }}</p>
        <p class="mb-2"><strong>Type:</strong> {{ ucfirst($item->type) }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
        <p class="mb-2"><strong>Reported by:</strong> {{ $item->user->username ?? $item->user->name }}</p>

        @if ($item->contact_info)
            <p class="mt-4"><strong>Contact Info:</strong> {{ $item->contact_info }}</p>
        @endif

        {{-- Unique Identifiers - ADMIN ONLY --}}
        @auth
            @if(auth()->user()->isAdmin())
                @if(!empty($item->unique_identifiers))
                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded">
                        <strong>Unique Identifiers (Admin Only):</strong>
                        <p>{{ $item->unique_identifiers }}</p>
                    </div>
                @endif
            @endif
        @endauth

    </div>

    {{-- If this is a lost item, show FOUND button --}}
    @if ($item->isLost())
        <a
            href="{{ route('items.found.create', ['from_lost' => $item->id]) }}"
            class="inline-block bg-green-600 text-white px-4 py-2 rounded mt-4"
        >
            I Found This Item
        </a>
    @endif

    {{-- If this is a found item, show CLAIM button --}}
    @if ($item->isFound() && $item->isActive())
        <a
            href="{{ route('claims.create', ['item' => $item->id]) }}"
            class="inline-block bg-purple-600 text-white px-4 py-2 rounded mt-4 ml-4"
        >
            Claim This Item
        </a>
    @endif

</div>
@endsection
