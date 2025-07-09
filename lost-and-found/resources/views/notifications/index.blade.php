@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Notifications</h1>
    
    <div class="bg-white shadow rounded-lg p-4">
        @forelse($notifications as $notification)
            <div class="flex items-center justify-between border-b py-2 {{ $notification->read ? 'opacity-60' : '' }}">
                <div class="flex-1">
                    <span class="{{ $notification->read ? 'text-gray-500' : 'text-blue-600 font-semibold' }}">
                        {{ $notification->message ?? 'A found/lost item matching your report has been added. Is this your item?' }}
                    </span>
                    @if($notification->created_at)
                        <div class="text-xs text-gray-400 mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
                
                <div class="flex items-center space-x-2">
                    @if($notification->action_url && str_contains($notification->action_url, 'verify-found'))
                        <a href="{{ $notification->action_url }}" 
                           class="text-indigo-600 hover:underline text-sm px-2 py-1 border border-indigo-600 rounded">
                            View
                        </a>
                    @endif
                    
                    @if(!$notification->read)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-green-600 hover:underline px-2 py-1">
                                Mark as read
                            </button>
                        </form>
                    @endif
                    
                    <!-- Add delete option for all notifications -->
                    <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-sm text-red-600 hover:underline px-2 py-1"
                                onclick="return confirm('Are you sure you want to delete this notification?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-gray-500 text-center py-8">
                <p>No notifications found.</p>
            </div>
        @endforelse
        
        @if($notifications->count() > 0)
            <div class="mt-4 pt-4 border-t flex justify-between">
                <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 hover:underline">
                        Mark all as read
                    </button>
                </form>
                
                <form action="{{ route('notifications.clear-all') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-sm text-red-600 hover:underline"
                            onclick="return confirm('Are you sure you want to clear all notifications?')">
                        Clear all notifications
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
