<?php

namespace App\Http\Controllers;

use App\Models\Alasan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class alasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        // Search logic
        $alasanQuery = Alasan::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('urutan', 'asc');

        $alasan = $alasanQuery->paginate($perPage)->withQueryString();

        return view('adminpage.alasan', compact('alasan'));
    }

    public function create()
    {
        // Return the new form view for creating an item.
        return view('adminpage.alasanform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:alasan,urutan',
        ]);
        $data = $request->only(['title', 'description', 'urutan']);
        // Handle file upload
        if ($request->hasFile('icon')) {
            // Store the file in `storage/app/public/alasan_icons` and get the path
            $path = $request->file('icon')->store('alasan_icons', 'public');
            $data['icon'] = $path;
        }
        $data['id'] = Str::uuid();
        Alasan::create($data);

        return redirect()->route('alasan.index')->with('success', 'Alasan berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alasan $alasan)
    {
        // The edit method now returns the form view with the specific item to edit.
        return view('adminpage.alasanform', [
            'alasan' => $alasan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alasan $alasan)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:alasan,urutan,' . $alasan->id,
        ]);

        // Handle file update
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($alasan->icon) {
                Storage::disk('public')->delete($alasan->icon);
            }

            // Store the new icon
            $path = $request->file('icon')->store('alasan_icons', 'public');
            $data['icon'] = $path;
        }

        $alasan->update($data);

        return redirect()->route('alasan.index')->with('success', 'Alasan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alasan $alasan)
    {
        if ($alasan->icon) {
            Storage::disk('public')->delete($alasan->icon);
        }

        $alasan->delete();
        return redirect()->route('alasan.index')->with('success', 'Alasan berhasil dihapus.');
    }
}
