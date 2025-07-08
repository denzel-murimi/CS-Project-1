@extends('layouts.app')

@section('title', 'My Items')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My {{ ucfirst($type) }} Items</h1>

    {{-- Flash success message --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded p-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Flash error message --}}
    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded p-4">
            {{ session('error') }}
        </div>
    @endif

    @if($items->count())
        <table class="min-w-full divide-y divide-gray-200 mb-8">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($type === 'lost')
                                <form action="{{ route('my.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lost item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            @elseif($type === 'found')
                                @if($item->deletionRequest && $item->deletionRequest->status === 'pending')
                                    <span class="text-yellow-600 italic">Request Pending</span>
                                @elseif($item->deletionRequest && $item->deletionRequest->status === 'approved')
                                    <span class="text-green-600 italic">Approved</span>
                                @elseif($item->deletionRequest && $item->deletionRequest->status === 'rejected')
                                    <span class="text-red-600 italic">Rejected</span>
                                    <a href="{{ route('found.items.delete.reason.form', $item->id) }}" class="ml-2 text-yellow-600 hover:text-yellow-900">Re-request</a>
                                @else
                                    <a href="{{ route('found.items.delete.reason.form', $item->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                        Request Deletion
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">You have not reported any {{ $type }} items yet.</p>
    @endif
</div>
@endsection
