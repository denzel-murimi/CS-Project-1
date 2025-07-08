<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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
        $user = auth()->user();

        $recentLostItems = Item::where('type', 'lost')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentFoundItems = Item::where('type', 'found')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'lost_items' => Item::where('type', 'lost')->where('user_id', $user->id)->count(),
            'found_items' => Item::where('type', 'found')->where('user_id', $user->id)->count(),
            'returned_items' => Item::where('status', 'returned')->where('user_id', $user->id)->count(),
            'my_reports' => Item::where('user_id', $user->id)->count(),
        ];

        return view('dashboard', compact('recentLostItems', 'recentFoundItems', 'stats'));
    }

    public function myItems(Request $request)
    {
        $type = $request->get('type', 'lost');

        $items = Item::where('type', $type)
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('my_items.index', compact('items', 'type'));
    }

    public function destroyMyItem(Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Item deleted.');
    }

}
