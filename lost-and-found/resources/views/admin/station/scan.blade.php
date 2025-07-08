@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Scan Student ID</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.station.processScan') }}">
        @csrf
        <label class="block mb-2 text-sm font-medium">Student ID</label>
        <input type="text" name="student_id" class="border rounded w-full p-2 mb-4" placeholder="Scan or enter student ID">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Scan</button>
    </form>
</div>
@endsection
