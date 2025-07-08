<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $totalItems = Item::count();
        $lostItems = Item::where('type', 'lost')->count();
        $foundItems = Item::where('type', 'found')->count();

        return view('admin.reports.index', compact('totalItems', 'lostItems', 'foundItems'));
    }
}
