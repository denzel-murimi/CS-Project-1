@extends('layouts.app')

@section('title', 'Approved Claims')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">
        Approved Claims for {{ $user->name }} ({{ $user->student_id ?? 'N/A' }})
    </h1>

    @if($claims->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">Item Name</th>
                        <th class="px-4 py-2 text-left text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $claim)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ $claim->item->name ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $claim->item->description ?? 'No description' }}
                            </td>
                            <td class="px-4 py-2">
                                <form method="POST" action="{{ route('admin.station.returnItem', $claim->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                        Mark as Returned
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700">No approved claims found for this student.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('admin.station.scan') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
            ← Back to Scan
        </a>
    </div>
</div>
@endsection
