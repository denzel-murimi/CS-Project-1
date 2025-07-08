<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Claim::with(['user', 'item']);

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $claims = $query->latest()->get();

        return view('admin.claims.index', compact('claims'));
    }


    public function update(Request $request, $id)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $claim = Claim::findOrFail($id);
        $claim->status = $request->status;
        $claim->save();

        return redirect()->route('admin.claims.index')->with('success', 'Claim status updated successfully.');
    }


}
