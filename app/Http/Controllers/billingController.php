<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class billingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        // Search logic
        $billingQuery = Billing::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'asc');

        $billing = $billingQuery->paginate($perPage)->withQueryString();

        return view('adminpage.billing', compact('billing'));
    }
}
