<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Show the scan form.
     */
    public function scanForm()
    {
        return view('admin.station.scan');
    }

    /**
     * Process scan and display approved claims.
     */
    public function processScan(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string',
        ]);

        $studentId = $validated['student_id'];

        // Find the user by student_id
        $user = User::where('student_id', $studentId)->first();

        if (!$user) {
            return redirect()
                ->route('admin.station.scan')
                ->with('error', 'Student not found.');
        }

        // Fetch approved claims for this user
        $claims = Claim::with(['item'])
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->get();

        return view('admin.station.approved_claims', [
            'claims' => $claims,
            'user'   => $user,
        ]);
    }

    /**
     * Mark claim as returned and delete linked lost report if applicable.
     */
    public function markReturned(Request $request, Claim $claim)
    {
        $claim->status = 'returned';
        $claim->save();

        // Optionally delete linked lost item
        if ($claim->item && $claim->item->type === 'lost') {
            $claim->item->delete();
        }

        return redirect()
            ->route('admin.station.scan')
            ->with('success', 'Item marked as returned. Linked lost report deleted if it existed.');
    }
}
