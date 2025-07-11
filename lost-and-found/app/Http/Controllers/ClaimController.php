<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            // Store the uploaded file in storage/app/public/claims
            $photoPath = $request->file('photo')->store('claims', 'public');
        }

        Claim::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'message' => $validated['message'],
            'contact_info' => $validated['contact_info'],
            'photo_path' => $photoPath,
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

        // If GET, show the appeal form
        if ($request->isMethod('get')) {
            return view('claims.appeal', compact('claim'));
        }

        // If POST, process the appeal
        $validated = $request->validate([
            'appeal_message' => 'required|string|max:2000',
            'appeal_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        $claim->status = 'pending';
        $claim->appeal_count += 1;
        $claim->appeal_message = $request->appeal_message;
        if ($request->hasFile('appeal_photo')) {
            $photoPath = $request->file('appeal_photo')->store('claims/appeals', 'public');
            $claim->photo_path = $photoPath;
        }
        $claim->save();

        return redirect()->route('claims.my')->with('success', 'Your appeal has been submitted.');
    }

    public function destroy($id)
    {
        $claim = Claim::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow delete if claim is approved and item is returned
        if ($claim->status === 'approved' && optional($claim->item)->status === 'returned') {
            $claim->delete();
            return redirect()->route('claims.my')->with('success', 'Claim deleted successfully.');
        }

        return redirect()->route('claims.my')->with('error', 'You can only delete claims that are approved and returned.');
    }
}
