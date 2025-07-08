@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    <ul>
        <li><a href="{{ route('admin.items.index') }}">Manage Items</a></li>
        <li><a href="{{ route('admin.claims.index') }}">Manage Claims</a></li>
        <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
        <li><a href="{{ route('admin.reports.index') }}">View Reports</a></li>
    </ul>
@endsection
