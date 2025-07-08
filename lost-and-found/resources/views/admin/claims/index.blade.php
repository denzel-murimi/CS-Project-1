@extends('layouts.app')

@section('content')
    <h1>Manage Claims</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Item</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($claims as $claim)
            <tr>
                <td>{{ $claim->id }}</td>
                <td>{{ $claim->user->name }}</td>
                <td>{{ $claim->item->name }}</td>
                <td>{{ $claim->status }}</td>
                <td>
                    <a href="#">Approve</a>
                    <a href="#">Reject</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
