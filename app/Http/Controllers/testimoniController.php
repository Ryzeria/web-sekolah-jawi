<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class testimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        // Search logic
        $testimoniQuery = Testimoni::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('pesan', 'like', "%{$search}%");
            })
            ->orderBy('urutan', 'asc');

        $testimoni = $testimoniQuery->paginate($perPage)->withQueryString();

        return view('adminpage.testimoni', compact('testimoni'));
    }

    public function create()
    {
        // Return the new form view for creating an item.
        return view('adminpage.testimoniform');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'profesi' => 'required|string|max:255',
            'pesan' => 'nullable|string',
            'foto_url' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:testimoni,urutan',
        ]);

        $data = $request->only(['nama', 'profesi', 'urutan', 'pesan']);
        // Handle file upload
        if ($request->hasFile('foto_url')) {
            // Store the file in `storage/app/public/testimoni_foto` and get the path
            $path = $request->file('foto_url')->store('testimoni_foto', 'public');
            $data['foto_url'] = $path;
        }
        $data['id'] = Str::uuid();
        Testimoni::create($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        return view('adminpage.testimoniform', [
            'testimoni' => $testimoni
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'profesi' => 'required|string|max:255',
            'pesan' => 'nullable|string',
            'foto_url' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:testimoni,urutan,' . $testimoni->id,
        ]);

        if ($request->hasFile('foto_url')) {
            // Delete old foto_url if it exists
            if ($testimoni->foto_url) {
                Storage::disk('public')->delete($testimoni->foto_url);
            }

            // Store the new foto_url
            $path = $request->file('foto_url')->store('testimoni_foto', 'public');
            $data['foto_url'] = $path;
        }

        $testimoni->update($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto_url) {
            Storage::disk('public')->delete($testimoni->foto_url);
        }
        $testimoni->delete();
        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
