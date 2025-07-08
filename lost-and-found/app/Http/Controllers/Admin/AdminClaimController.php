<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

class AdminClaimController extends Controller
{
    public function index()
    {
         if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $claims = Claim::latest()->get();

        return view('admin.claims.index', compact('claims'));
    }
}
