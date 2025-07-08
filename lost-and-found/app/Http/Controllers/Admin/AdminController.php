<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Claim;
use App\Models\Report;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        // Get statistics for dashboard cards
        $statistics = [
            'totalItems' => Item::count(),
            'activeClaims' => Claim::where('status', 'active')->count(),
            'totalUsers' => User::count(),
            //'totalReports' => Report::count(),
        ];

        // You can also add more detailed statistics
        $additionalStats = [
            'pendingClaims' => Claim::where('status', 'pending')->count(),
            'resolvedClaims' => Claim::where('status', 'resolved')->count(),
            'newUsersThisMonth' => User::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->count(),
            'itemsAddedThisWeek' => Item::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
        ];

        return view('admin.dashboard', array_merge($statistics, $additionalStats));
    }
}
