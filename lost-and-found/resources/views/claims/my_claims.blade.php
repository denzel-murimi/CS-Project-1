@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8">
    <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-4xl w-full">
        <div class="flex flex-col items-center mb-8">
            <svg class="w-16 h-16 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
            </svg>
            <h1 class="text-3xl font-extrabold text-blue-800 mb-1">My Claims</h1>
            <p class="text-gray-600 text-center">Track your claims and their status here.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-full p-4 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-full p-4 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        @if($claims->count())
            <div class="overflow-x-auto rounded-2xl shadow-lg">
                <table class="min-w-full divide-y divide-gray-200 rounded-2xl overflow-hidden">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase">Item</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($claims as $claim)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                    #{{ $claim->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $claim->item->name ?? 'N/A' }}
                                    <div class="text-gray-500 text-xs">
                                        {{ $claim->item->description ?? '' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $isReturned = !is_null($claim->returned_at) || (!empty($claim->item) && !is_null($claim->item->returned_at));
                                    @endphp
                                    @if($isReturned)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Returned
                                        </span>
                                    @elseif($claim->status === 'pending')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending Approval
                                        </span>
                                    @elseif($claim->status === 'approved')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Pending Pickup
                                        </span>
                                    @elseif($claim->status === 'rejected')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $claim->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($claim->status === 'rejected')
                                        @if($claim->appeal_count < 2)
                                            <a href="{{ route('claims.appeal', $claim->id) }}"
                                               class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Appeal
                                            </a>
                                            <span class="text-xs text-gray-500 ml-2">
                                                (Appeals left: {{ 2 - $claim->appeal_count }})
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-500">
                                                Max appeals reached
                                            </span>
                                        @endif
                                    @endif

                                    <form action="{{ route('claims.destroy', $claim->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this claim?');"
                                          style="display:inline; margin-left: 8px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-full text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
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
</div>
@endsection
