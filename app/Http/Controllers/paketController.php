<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class paketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        // Search logic
        $paketQuery = Paket::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('nama_paket', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->orderBy('harga', 'asc');

        $paket = $paketQuery->paginate($perPage)->withQueryString();

        return view('adminpage.paket', compact('paket'));
    }

    public function create()
    {
        // Return the new form view for creating an item.
        return view('adminpage.paketform');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data, including the new 'gte' rule
        $data = $request->validate([
            'nama_paket'   => 'required|string|max:100',
            'harga'          => 'required|numeric|min:0',
            'harga_normal'   => 'required|numeric|min:0|gte:harga', // Ensures harga_normal >= harga
            'deskripsi'      => 'nullable|string',
            'durasi_bulan'   => 'nullable|integer|min:1',
            'is_active'      => 'nullable|boolean',
        ]);

        // 2. Automatically calculate the discount percentage
        $diskon = 0; // Default to 0
        if (isset($data['harga_normal']) && $data['harga_normal'] > 0) {
            $diskon = round(100 - ($data['harga'] / $data['harga_normal'] * 100));
        }

        // 3. Add the calculated discount and other fields to the data for creation
        $data['diskon_persen'] = $diskon;
        $data['id'] = Str::uuid();
        $data['is_active'] = $request->has('is_active');
        $data['is_popular'] = $request->has('is_popular');

        // 4. Create the new Paket record
        Paket::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('adminpage.paketform', [
            'paket' => $paket
        ]);
    }


    public function update(Request $request, Paket $paket)
    {
        // 1. Validate the incoming data, including the new 'gte' rule
        $data = $request->validate([
            'nama_paket'   => 'required|string|max:100',
            'harga'          => 'required|numeric|min:0',
            'harga_normal'   => 'required|numeric|min:0|gte:harga', // Ensures harga_normal >= harga
            'deskripsi'      => 'nullable|string',
            'durasi_bulan'   => 'nullable|integer|min:1',
            'is_active'      => 'nullable|boolean',
        ]);

        // 2. Automatically calculate the discount percentage
        $diskon = 0; // Default to 0
        if (isset($data['harga_normal']) && $data['harga_normal'] > 0) {
            $diskon = round(100 - ($data['harga'] / $data['harga_normal'] * 100));
        }

        // 3. Add the calculated discount and is_active status to the data for update
        $data['diskon_persen'] = $diskon;
        $data['is_active'] = $request->has('is_active');

        // 4. Update the existing Paket record (Corrected from Paket::create)
        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
