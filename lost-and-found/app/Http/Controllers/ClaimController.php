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

     public function myClaims()
    {
        $user = Auth::user();

        $claims = Claim::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('claims.my_claims', compact('claims'));
    }

    public function appeal(Request $request, $id)
{
    $claim = Claim::where('id', $id)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();

    if ($claim->status !== 'rejected') {
        return redirect()->route('claims.my')->with('error', 'Only rejected claims can be appealed.');
    }

    if ($claim->appeal_count >= 2) {
        return redirect()->route('claims.my')->with('error', 'You have reached the maximum number of appeals.');
    }

    $claim->status = 'pending';
    $claim->appeal_count += 1;
    $claim->save();

    return redirect()->route('claims.my')->with('success', 'Your appeal has been submitted.');
}
}
