<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function create(Request $request)
    {
        $item = Item::findOrFail($request->item);

        return view('claims.create', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'contact_info' => 'required|string|max:500',
        ]);

        Claim::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'message' => $validated['message'],
            'contact_info' => $validated['contact_info'],
            'status' => 'pending',
        ]);

        return redirect()->route('items.show', $item)
            ->with('success', 'Your claim has been submitted!');
    }
}
