<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FiturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        // Search logic
        $fiturQuery = Fitur::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('urutan', 'asc');

        $fitur = $fiturQuery->paginate($perPage)->withQueryString();

        return view('adminpage.fitur', compact('fitur'));
    }

    public function create()
    {
        // Return the new form view for creating an item.
        return view('adminpage.fiturform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:fitur,urutan',
            'type' => 'required|string',
        ]);

        $data = $request->only(['title', 'description', 'urutan']);
        // Handle file upload
        if ($request->hasFile('icon')) {
            // Store the file in `storage/app/public/fitur_icons` and get the path
            $path = $request->file('icon')->store('fitur_icons', 'public');
            $data['icon'] = $path;
        }
        $data['is_active'] = $request->has('is_active');
        $data['id'] = Str::uuid();
        Fitur::create($data);

        return redirect()->route('fitur.index')->with('success', 'Fitur berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fitur $fitur)
    {
        return view('adminpage.fiturform', [
            'fitur' => $fitur
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fitur $fitur)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:fitur,urutan,' . $fitur->id,
            'type' => 'required|string',
        ]);

        // Handle file update
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($fitur->icon) {
                Storage::disk('public')->delete($fitur->icon);
            }

            // Store the new icon
            $path = $request->file('icon')->store('fitur_icons', 'public');
            $data['icon'] = $path;
        }
        $data['is_active'] = $request->has('is_active');
        $fitur->update($data);

        return redirect()->route('fitur.index')->with('success', 'Fitur berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fitur $fitur)
    {
        if ($fitur->icon) {
            Storage::disk('public')->delete($fitur->icon);
        }
        $fitur->delete();
        return redirect()->route('fitur.index')->with('success', 'Fitur berhasil dihapus.');
    }
}
