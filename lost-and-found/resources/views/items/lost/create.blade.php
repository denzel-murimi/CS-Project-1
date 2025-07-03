@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">📍 Report a Lost Item</h2>

    <form action="{{ route('items.lost.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="item_name" class="block text-sm font-semibold text-gray-700 mb-1">Item Name <span class="text-red-500">*</span></label>
            <input type="text" id="item_name" name="item_name" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
            <select id="category" name="category" class="w-full border border-gray-300 rounded-md p-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
            <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="lost_date" class="block text-sm font-semibold text-gray-700 mb-1">Date Lost <span class="text-red-500">*</span></label>
                <input type="date" id="lost_date" name="lost_date" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Last Seen Location <span class="text-red-500">*</span></label>
                <input type="text" id="location" name="location" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div>
            <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1">Upload Photo <span class="text-gray-400 text-sm">(optional)</span></label>
            <input type="file" id="photo" name="photo" accept="image/*" class="w-full border border-gray-300 rounded-md p-2 file:bg-gray-100 file:border-none file:rounded file:px-4 file:py-2 file:mr-4">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition duration-150 ease-in-out">
                Submit Report
            </button>
        </div>
    </form>
</div>
@endsection
