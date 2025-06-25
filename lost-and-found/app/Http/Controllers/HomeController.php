<?php
namespace App\Http\Controllers;
use App\Models\Item;

class HomeController extends Controller
{
    public function index()
{
    $recentItems = Item::active()
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

    return view('home', compact('recentItems'));
}
}

