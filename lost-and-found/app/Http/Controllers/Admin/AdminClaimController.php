<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminClaimController extends Controller
{
    /**
     * Display a listing of claims, with optional filtering.
     */
    public function index(Request $request)
    {
        $query = Claim::with(['user', 'item']);

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $claims = $query->latest()->get();

        return view('admin.claims.index', compact('claims'));
    }

    /**
     * Show details of a single claim.
     */
    public function show(Claim $claim)
    {
        $claim->load([
            'item',
            'user',
            'lostItem'
        ]);

        return view('admin.claims.show', compact('claim'));
    }

    /**
     * Update the status of a claim.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $claim = Claim::findOrFail($id);

        // If approving, check for other approved claims for the same item
        if ($validated['status'] === 'approved') {
            $otherApproved = Claim::where('item_id', $claim->item_id)
                ->where('status', 'approved')
                ->where('id', '!=', $claim->id)
                ->exists();

            if ($otherApproved) {
                return redirect()->back()->with('error', 'Another claim for this item is already approved.');
            }
            // Mark the item as inactive so it can't be claimed again
            if ($claim->item) {
                $claim->item->status = 'inactive';
                $claim->item->save();
            }
        }

        $claim->status = $validated['status'];
        $claim->save();

        // If this is a found item being approved, notify the user who reported it lost
        if ($claim->item && $claim->item->type === 'found' && $validated['status'] === 'approved') {
            $lostReport = Item::where('type', 'lost')
                ->where('name', $claim->item->name)
                ->where('status', 'active')
                ->first();
            if ($lostReport) {
                $lostReport->status = 'inactive';
                $lostReport->save();
                Notification::create([
                    'user_id' => $lostReport->user_id,
                    'message' => 'A found item matching your lost report has been approved. Is this your item?',
                    'action_url' => url('/items/confirm/' . $claim->item->id),
                ]);
            }
        }

        return redirect()->route('admin.claims.index')->with('success', 'Claim status updated successfully.');
    }

}
