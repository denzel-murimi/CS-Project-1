@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Claims</h1>

    <!-- Success / Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded p-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded p-4">
            {{ session('error') }}
        </div>
    @endif

    @if($claims->count())
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($claims as $claim)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $claim->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $claim->item->name ?? 'N/A' }}
                                <div class="text-gray-500 text-xs">{{ $claim->item->description ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($claim->status === 'pending')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($claim->status === 'approved')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                @elseif($claim->status === 'rejected')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $claim->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($claim->status === 'rejected')
                                    @if($claim->appeal_count < 2)
                                        <form action="{{ route('claims.appeal', $claim->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Appeal
                                            </button>
                                        </form>
                                        <span class="text-xs text-gray-500 ml-2">
                                            (Appeals left: {{ 2 - $claim->appeal_count }})
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-500">Max appeals reached</span>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-500">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">You have not submitted any claims yet.</p>
    @endif
</div>
@endsection
