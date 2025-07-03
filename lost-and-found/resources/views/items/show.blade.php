@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
        {{ $item->name }} 
        <span class="text-sm uppercase ml-2 text-{{ $item->statusColor }}">
            ({{ $item->type }})
        </span>
    </h2>

    <div class="flex gap-6">
        {{-- Image --}}
        <div class="w-1/3">
            @if ($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="rounded shadow w-full">
            @else
                <div class="bg-gray-200 w-full h-48 flex items-center justify-center rounded text-sm text-gray-600">
                    No image available
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="w-2/3 space-y-3">
            <p><span class="font-semibold">Category:</span> {{ $item->category }}</p>
            <p><span class="font-semibold">Location:</span> {{ $item->location }}</p>
            <p><span class="font-semibold">Date:</span> {{ $item->date_lost_found->format('F j, Y') }}</p>
            <p><span class="font-semibold">Status:</span> 
                <span class="text-{{ $item->statusColor }} capitalize">{{ $item->status }}</span>
            </p>
            <p><span class="font-semibold">Reported By:</span> {{ $item->user->name ?? 'Anonymous' }}</p>
            @if($item->contact_info)
                <p><span class="font-semibold">Contact:</span> {{ $item->contact_info }}</p>
            @endif
            <p><span class="font-semibold">Description:</span></p>
            <p class="text-gray-700">{{ $item->description }}</p>

            @if ($item->reward_offered)
                <div class="mt-2 p-3 border-l-4 border-yellow-500 bg-yellow-50 text-yellow-800">
                    🎁 A reward of <strong>KES {{ number_format($item->reward_amount, 2) }}</strong> is offered for returning this item.
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">← Back to previous page</a>
    </div>
</div>
@endsection
