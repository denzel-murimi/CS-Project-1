<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminItemController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $items = Item::latest()->get();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:available,claimed,inactive',
            'description' => 'nullable|string',
        ]);

        Item::create($request->all());

        return redirect()->route('admin.items.index')
            ->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('admin.items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:available,claimed,inactive',
            'description' => 'nullable|string',
        ]);

        $item->update($request->all());

        return redirect()->route('admin.items.index')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
