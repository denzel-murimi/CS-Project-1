<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get statistics
        $stats = [
            'lost_items' => Item::lost()->active()->count(),
            'found_items' => Item::found()->active()->count(),
            'returned_items' => Item::returned()->count(),
            'my_reports' => Item::where('user_id', Auth::id())->count(),
        ];

        // Get recent items (last 7 days, limit to 5 each)
        $recentLostItems = Item::lost()
            ->active()
            ->recent(7)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentFoundItems = Item::found()
            ->active()
            ->recent(7)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentLostItems', 'recentFoundItems'));
    }
}