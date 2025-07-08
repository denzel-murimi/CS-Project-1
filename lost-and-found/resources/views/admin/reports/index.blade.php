@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Reports</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Items -->
        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M3 3h18v18H3V3z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Items</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalItems }}</p>
                </div>
            </div>
        </div>

        <!-- Lost Items -->
        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Lost Items</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $lostItems }}</p>
                </div>
            </div>
        </div>

        <!-- Found Items -->
        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Found Items</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $foundItems }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
