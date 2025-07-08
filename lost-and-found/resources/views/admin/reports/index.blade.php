@extends('layouts.app')

@section('content')
    <h1>Reports</h1>

    <p>Total Items: {{ $totalItems }}</p>
    <p>Lost Items: {{ $lostItems }}</p>
    <p>Found Items: {{ $foundItems }}</p>
@endsection
