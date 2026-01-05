<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryBilling;
use Illuminate\Http\Request;

class historyBillingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $sortDirection = $request->input('direction', 'desc');

        // Validate that the direction is either 'asc' or 'desc'
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $search = $request->input('search');

        // Use with('billing.user') to eager load the relationships
        $history_billingQuery = HistoryBilling::with(['billing.user:id,username'])
            ->when($search, function ($query, $search) {
                // Search by username on the related users table
                $query->whereHas('billing.user', function ($subQuery) use ($search) {
                    $subQuery->where('username', 'like', "%{$search}%");
                })
                    // Also allow searching by status in the history_billing table
                    ->orWhere('status_baru', 'like', "%{$search}%");
            })
            // Order by the most recent history records first
            ->orderBy('tanggal', $sortDirection);

        $history_billing = $history_billingQuery->paginate($perPage)->withQueryString();

        return view('adminpage.history-billing', compact('history_billing'));
    }
}
