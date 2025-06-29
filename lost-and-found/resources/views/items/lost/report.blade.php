@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Report Lost Item</h2>

<form action="{{ route('lost.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
        <label for="item_name" class="block font-medium">Item Name</label>
        <input type="text" id="item_name" name="item_name" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label for="category" class="block font-medium">Category</label>
        <select id="category" name="category" class="w-full border rounded p-2" required>
            <option value="">-- Select Category --</option>
            <option value="ID Card">ID Card</option>
            <option value="Phone">Phone</option>
            <option value="Electronics">Electronics</option>
            <option value="Books">Books</option>
            <option value="Clothing">Clothing</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div>
        <label for="description" class="block font-medium">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full border rounded p-2" required></textarea>
    </div>

    <div>
        <label for="lost_date" class="block font-medium">Date Lost</label>
        <input type="date" id="lost_date" name="lost_date" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label for="location" class="block font-medium">Last Seen Location</label>
        <input type="text" id="location" name="location" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label for="photo" class="block font-medium">Upload Photo (optional)</label>
        <input type="file" id="photo" name="photo" accept="image/*" class="w-full border rounded p-2">
    </div>

    <div class="text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Submit</button>
    </div>
</form>
@endsection
