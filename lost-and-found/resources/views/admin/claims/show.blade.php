@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Claim Details</h1>

    {{-- Flash messages for success or error --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-2">Found Item Info</h2>
        <p><strong>Name:</strong> {{ $claim->item->name }}</p>
        <p><strong>Description:</strong> {{ $claim->item->description ?? 'N/A' }}</p>
        <p><strong>Category:</strong> {{ $claim->item->category ?? 'N/A' }}</p>
        <p><strong>Location:</strong> {{ $claim->item->location ?? 'N/A' }}</p>
        <p><strong>Date Found:</strong> {{ $claim->item->date_lost_found ? $claim->item->date_lost_found->format('d M Y') : 'N/A' }}</p>
        <p><strong>Item Unique Identifier:</strong> {{ $claim->item->id }}</p>
        @if($claim->item->image_path)
            <div class="mt-2">
                <strong>Item Image:</strong><br>
                <img src="{{ asset('storage/' . $claim->item->image_path) }}" alt="Item Image" class="w-48 rounded border border-gray-300">
            </div>
        @endif

        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Claim Info</h2>
        <p><strong>Claim ID:</strong> #{{ $claim->id }}</p>
        <p><strong>Status:</strong> {{ ucfirst($claim->status) }}</p>
        <p><strong>Message:</strong> {{ $claim->message }}</p>
        <p><strong>Contact Info:</strong> {{ $claim->contact_info }}</p>
        <p><strong>Date Submitted:</strong> {{ $claim->created_at->format('d M Y') }}</p>
        @if ($claim->photo_path)
            <div class="mt-4">
                <h3 class="text-xl font-semibold mb-2">Uploaded Photo</h3>
                <img src="{{ asset('storage/' . $claim->photo_path) }}"
                    alt="Claim/Appeal Photo"
                    class="w-48 rounded border border-gray-300 mb-2">
            </div>
        @endif

        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Claimant</h2>
        <p><strong>Username:</strong> {{ $claim->user->username }}</p>
        <p><strong>Email:</strong> {{ $claim->user->email }}</p>
        <p><strong>User Unique Identifier:</strong> {{ $claim->user->id }}</p>

        @if ($claim->appeal_count > 0)
            <hr class="my-4">
            <h2 class="text-xl font-semibold mb-2">Latest Appeal Info</h2>
            <p><strong>Appeal Message:</strong> {{ $claim->appeal_message ?? 'N/A' }}</p>
            @if ($claim->photo_path)
                <div class="mt-2">
                    <strong>Appeal Photo:</strong><br>
                    <img src="{{ asset('storage/' . $claim->photo_path) }}" alt="Appeal Photo" class="w-48 rounded border border-gray-300">
                </div>
            @endif
        @endif

        @if ($claim->lostItem)
            <hr class="my-4">
            <h2 class="text-xl font-semibold mb-2">Linked Lost Report</h2>
            <p><strong>Name:</strong> {{ $claim->lostItem->name }}</p>
            <p><strong>Description:</strong> {{ $claim->lostItem->description ?? 'N/A' }}</p>
            <p><strong>Unique Identifier:</strong> {{ $claim->lostItem->id }}</p>
            <p><strong>Reported At:</strong> {{ $claim->lostItem->created_at->format('d M Y') }}</p>
        @else
            <hr class="my-4">
            <p class="text-gray-600 italic">No linked lost report.</p>
        @endif

        @if ($claim->status === 'pending')
            <hr class="my-6">
            <div class="flex space-x-4">
                <!-- Approve Button -->
                <form action="{{ route('admin.claims.update', $claim->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Approve Claim
                    </button>
                </form>

                <!-- Reject Button -->
                <form action="{{ route('admin.claims.update', $claim->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Reject Claim
                    </button>
                </form>
            </div>
        @else
            <hr class="my-6">
            <p class="text-gray-600 italic">This claim has already been <strong>{{ ucfirst($claim->status) }}</strong>.</p>
        @endif

        <hr class="my-6">

        <a href="{{ route('admin.claims.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
            Back to Claims
        </a>
    </div>
</div>
@endsection
