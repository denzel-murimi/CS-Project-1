<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('items.search');
    }

    public function search(Request $request)
    {
        $query = Item::with('user')->active();

        if ($request->has('type') && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        if (in_array($sortBy, ['created_at', 'name', 'date_lost_found'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $items = $query->paginate(12)->withQueryString();

        $categories = Item::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort();

        return view('items.search', compact('items', 'categories'));
    }

    public function show(Item $item)
    {
        $item->load('user');

        $potentialMatches = collect();

        if ($item->isLost()) {
            $potentialMatches = Item::found()
                ->active()
                ->where('id', '!=', $item->id)
                ->where(function ($query) use ($item) {
                    $query->where('category', $item->category)
                          ->orWhere('name', 'like', "%{$item->name}%")
                          ->orWhere('location', $item->location);
                })
                ->limit(5)
                ->get();
        }

        return view('items.show', compact('item', 'potentialMatches'));
    }

    public function createLost()
    {
        $categories = $this->getCategories();
        $locations = $this->getLocations();

        return view('items.create-lost', compact('categories', 'locations'));
    }

    public function createFound(Request $request)
    {
        $categories = $this->getCategories();
        $locations = $this->getLocations();

        $prefill = null;

        if ($request->has('from_lost')) {
            $lostItem = Item::find($request->from_lost);

            if ($lostItem && $lostItem->isLost()) {
                $prefill = $lostItem;
            }
        }

        return view('items.create-found', compact('categories', 'locations', 'prefill'));
    }

    public function storeLost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'unique_identifiers' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['type'] = 'lost';
        $validated['status'] = 'active';

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $validated['unique_identifiers'] = $request->input('unique_identifiers');

        $item = Item::create($validated);

        // --- FOUND/LOST MATCHING AND NOTIFICATION LOGIC ---
        // Try to find a matching found item (by name, status active)
        $foundItem = Item::where('type', 'found')
            ->where('name', $item->name)
            ->where('status', 'active')
            ->first();
        if ($foundItem) {
            // Mark both as inactive
            $item->status = 'inactive';
            $item->save();
            $foundItem->status = 'inactive';
            $foundItem->save();
            // Send notification to the found item's user
            \App\Models\Notification::create([
                'user_id' => $foundItem->user_id,
                'action_url' => url('/items/confirm-lost/' . $item->id),
            ]);
        }
        // --- END MATCHING LOGIC ---

        return redirect()->route('items.show', $item)
            ->with('success', 'Lost item reported successfully! We\'ll notify you if someone finds a match.');
    }

    public function storeFound(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'private_identifiers' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'unique_identifiers' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['type'] = 'found';
        $validated['status'] = 'active';

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $validated['private_identifiers'] = $request->input('private_identifiers');
        $validated['unique_identifiers'] = $request->input('unique_identifiers');

        $item = Item::create($validated);

        // --- LOST/FOUND MATCHING AND NOTIFICATION LOGIC ---
        // Try to find a matching lost item (by name, status active)
        $lostItem = Item::where('type', 'lost')
            ->where('name', $item->name)
            ->where('status', 'active')
            ->first();
        if ($lostItem) {
            // Mark both as inactive
            $item->status = 'inactive';
            $item->save();
            $lostItem->status = 'inactive';
            $lostItem->save();
            // Send notification to the lost item's user
            \App\Models\Notification::create([
                'user_id' => $lostItem->user_id,
                'action_url' => url('/notifications/verify-found/' . $item->id),
                'message' => 'Someone has reported finding an item matching your lost report. Please verify if it is yours.',
            ]);
        }
        // --- END MATCHING LOGIC ---

        return redirect()->route('items.show', $item)
            ->with('success', 'Found item reported successfully! The owner can now contact you to claim it.');
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        $categories = $this->getCategories();
        $locations = $this->getLocations();

        return view('items.edit', compact('item', 'categories', 'locations'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,returned,claimed',
            'unique_identifiers' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $validated['unique_identifiers'] = $request->input('unique_identifiers');

        $item->update($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        $item->delete();

        return redirect()->route('items.search')
            ->with('success', 'Item deleted successfully!');
    }

    public function markAsReturned(Item $item)
    {
        $this->authorize('update', $item);

        $item->markAsReturned();

        $message = $item->isLost()
            ? 'Congratulations! Your lost item has been marked as found!'
            : 'Great! The found item has been returned to its owner.';

        return redirect()->route('items.show', $item)
            ->with('success', $message);
    }

    public function markAsClaimed(Item $item)
    {
        $this->authorize('update', $item);

        $item->markAsClaimed();

        $message = $item->isLost()
            ? 'The lost item has been claimed by the owner!'
            : 'The found item has been claimed successfully.';

        return redirect()->route('items.show', $item)
            ->with('success', $message);
    }

    private function getCategories()
    {
        return [
            'electronics' => 'Electronics',
            'clothing' => 'Clothing',
            'accessories' => 'Accessories',
            'books' => 'Books & Stationery',
            'keys' => 'Keys',
            'wallet' => 'Wallets & Purses',
            'phone' => 'Mobile Phones',
            'bag' => 'Bags & Backpacks',
            'jewelry' => 'Jewelry',
            'documents' => 'Documents & Cards',
            'sports' => 'Sports Equipment',
            'other' => 'Other',
        ];
    }

    private function getLocations()
    {
        return [
            'Library',
            'Student Center',
            'Cafeteria',
            'Lecture Theatre 1',
            'Lecture Theatre 2',
            'Computer Lab',
            'Sports Complex',
            'Parking Lot',
            'Administration Block',
            'Chapel',
            'Other',
        ];
    }

    public function destroyMyItem(Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($item->type !== 'lost') {
            abort(403, 'This item cannot be deleted directly.');
        }

        $item->delete();

        return back()->with('success', 'Lost item deleted successfully.');
    }

    public function showDeleteReasonForm(Item $item)
    {
        if ($item->user_id !== auth()->id() || $item->type !== 'found') {
            abort(403, 'Unauthorized action.');
        }

        return view('found_items.delete_reason', compact('item'));
    }

    public function submitDeleteReason(Request $request, Item $item)
    {
        if ($item->user_id !== auth()->id() || $item->type !== 'found') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        FoundItemDeletionRequest::create([
            'item_id' => $item->id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('my.items.index', ['type' => 'found'])
            ->with('success', 'Your deletion request has been submitted for admin approval.');
    }

    public function myItems($type, Request $request)
    {
        $query = Item::where('user_id', auth()->id())
                     ->where('type', $type)
                     ->latest();

        if ($type === 'found') {
            $query->with('deletionRequest');
        }

        $items = $query->get();

        return view('my_items.index', [
            'type' => $type,
            'items' => $items
        ]);
    }
}
