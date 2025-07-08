@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Approved Claims for {{ $user->name }} ({{ $user->student_id }})</h2>

    @if ($claims->isEmpty())
        <p>No approved claims found.</p>
    @else
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Item</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($claims as $claim)
                <tr>
                    <td class="border p-2">{{ $claim->item->name }}</td>
                    <td class="border p-2">{{ $claim->item->description }}</td>
                    <td class="border p-2">
                        <form method="POST" action="{{ route('admin.station.returnItem', $claim) }}">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">
                                Mark as Returned
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
