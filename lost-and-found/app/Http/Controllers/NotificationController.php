<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        // Ensure the notification belongs to the current user
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['read' => true]);

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function delete(Notification $notification)
    {
        // Ensure the notification belongs to the current user
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted.');
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('read', false)
            ->update(['read' => true]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function clearAll()
    {
        Notification::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }

    // Show the found item and ask for verification
    public function verifyFound($foundItemId)
    {
        $foundItem = Item::findOrFail($foundItemId);
        // Only the user who reported the matching lost item can verify
        $user = Auth::user();
        // Find the notification for this user and found item
        $notification = Notification::where('user_id', $user->id)
            ->where('action_url', url('/notifications/verify-found/' . $foundItemId))
            ->firstOrFail();
        // Find the matching lost item (inactive, same name)
        $lostItem = Item::where('type', 'lost')
            ->where('name', $foundItem->name)
            ->where('status', 'inactive')
            ->where('user_id', $user->id)
            ->first();
        if (!$lostItem) {
            abort(403, 'No matching lost item for verification.');
        }
        return view('notifications.verify-found', compact('foundItem', 'lostItem', 'notification'));
    }

    // User confirms the found item is theirs
    public function confirmFoundMatch($foundItemId)
    {
        $user = Auth::user();
        $foundItem = Item::findOrFail($foundItemId);
        $lostItem = Item::where('type', 'lost')
            ->where('name', $foundItem->name)
            ->where('status', 'inactive')
            ->where('user_id', $user->id)
            ->firstOrFail();

        DB::transaction(function () use ($foundItem, $lostItem, $user) {
            // Auto-approve claim
            Claim::create([
                'user_id' => $user->id,
                'item_id' => $foundItem->id, // required by DB
                'lost_item_id' => $lostItem->id,
                'status' => 'approved',
                'message' => 'Auto-approved claim for matched found item.',
                'contact_info' => $user->contact_info ?? '',
            ]);
            // Both items remain inactive
            // Delete the notification
            Notification::where('user_id', $user->id)
                ->where('action_url', url('/notifications/verify-found/' . $foundItem->id))
                ->delete();
        });
        return redirect()->route('notifications.index')->with('success', 'Claim approved. The item has been marked as claimed.');
    }

    // User rejects the found item
    public function rejectFoundMatch($foundItemId)
    {
        $user = Auth::user();
        $foundItem = Item::findOrFail($foundItemId);
        $lostItem = Item::where('type', 'lost')
            ->where('name', $foundItem->name)
            ->where('status', 'inactive')
            ->where('user_id', $user->id)
            ->firstOrFail();

        DB::transaction(function () use ($foundItem, $lostItem, $user) {
            // Reactivate the found item
            $foundItem->status = 'active';
            $foundItem->save();
            // Delete the notification for the lost item owner
            Notification::where('user_id', $user->id)
                ->where('action_url', url('/notifications/verify-found/' . $foundItem->id))
                ->delete();
            // Notify the finder
            Notification::create([
                'user_id' => $foundItem->user_id,
                'message' => 'The owner rejected your found item claim. The item is now active again.',
                'action_url' => null,
            ]);
        });
        return redirect()->route('notifications.index')->with('success', 'You have rejected the match. The finder has been notified.');
    }
}
