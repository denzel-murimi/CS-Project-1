<?php
namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
{
    $recentItems = Item::active()->orderBy('created_at', 'desc')->take(6)->get();

    $stats = [
        'items_reunited' => Item::whereIn('status', ['returned', 'claimed'])->count(),
        'pending_items' => Item::active()->count(),
        'active_users' => User::count(),
        'success_rate' => $this->calculateSuccessRate(), 
    ];

    return view('home', compact('recentItems', 'stats'));
}

private function calculateSuccessRate()
{
    $total = Item::count();
    $resolved = Item::whereIn('status', ['returned', 'claimed'])->count();

    if ($total === 0) return '0%';

    return round(($resolved / $total) * 100) . '%';
}
}

