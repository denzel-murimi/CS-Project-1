<?php
namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
{
    $recentItems = Item::latest()->take(10)->get();
    
    $stats = [
        'items_reunited' => Item::where('status', 'reunited')->count(),
        'success_rate' => '89%', 
        'active_users' => User::where('created_at', '>=', now()->subMonths(3))->count(),
        'pending_items' => Item::where('status', 'pending')->count(),
    ];
    
    return view('home', compact('recentItems', 'stats'));
}
}

