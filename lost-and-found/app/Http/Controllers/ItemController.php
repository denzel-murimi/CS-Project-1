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

    // Show all items with search functionality
    public function index()
    {
        return redirect()->route('items.search');
    }

    // Search/Browse items
    public function search(Request $request)
    {
        $query = Item::with('user')->active();

        // Filter by type (lost/found)
        if ($request->has('type') && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }

        // Search by keyword
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Sort options
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        if (in_array($sortBy, ['created_at', 'name', 'date_lost_found'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $items = $query->paginate(12)->withQueryString();

        // Get categories for filter dropdown
        $categories = Item::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort();

        return view('items.search', compact('items', 'categories'));
    }

    // Show single item
    public function show(Item $item)
    {
        $item->load('user');
        
        // Find potential matches if this is a lost item
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

    // Show form to report lost item
    public function createLost()
    {
        $categories = $this->getCategories();
        $locations = $this->getLocations();
        
        return view('items.create-lost', compact('categories', 'locations'));
    }

    // Show form to report found item
    public function createFound()
    {
        $categories = $this->getCategories();
        $locations = $this->getLocations();
        
        return view('items.create-found', compact('categories', 'locations'));
    }

    // Store lost item
    public function storeLost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reward_offered' => 'boolean',
            'reward_amount' => 'nullable|numeric|min:0|max:999999.99',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['type'] = 'lost';
        $validated['status'] = 'active';
        $validated['reward_offered'] = $request->boolean('reward_offered');

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $item = Item::create($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Lost item reported successfully! We\'ll notify you if someone finds a match.');
    }

    // Store found item
    public function storeFound(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['type'] = 'found';
        $validated['status'] = 'active';

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $item = Item::create($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Found item reported successfully! The owner can now contact you to claim it.');
    }

    // Edit item (only owner can edit)
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        
        $categories = $this->getCategories();
        $locations = $this->getLocations();
        
        return view('items.edit', compact('item', 'categories', 'locations'));
    }

    // Update item
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'contact_info' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,returned,claimed',
        ]);

        if ($item->isLost()) {
            $validated['reward_offered'] = $request->boolean('reward_offered');
            $validated['reward_amount'] = $request->reward_amount;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Item updated successfully!');
    }

    // Delete item (soft delete)
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        
        $item->delete();

        return redirect()->route('items.search')
            ->with('success', 'Item deleted successfully!');
    }

    // Mark item as returned/claimed
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

    // Get predefined categories
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

    // Get common campus locations
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
}