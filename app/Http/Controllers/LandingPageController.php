<?php

namespace App\Http\Controllers;

use App\Models\Alasan;
use App\Models\Fitur;
use App\Models\Slider;
use App\Models\Testimoni;
use App\Models\Paket;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Fetch sliders 
        $sliders = Slider::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();
        // Fetch Fitur
        $fitur = Fitur::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();
        // Fetch data for layanan paket, "keunggulan" (alasan) and testimoni
        $paket = Paket::with('fiturs') // Eager loading
            ->where('is_active', true)
            ->orderBy('harga', 'asc')
            ->get();
        $alasan = Alasan::orderBy('urutan', 'asc')->get();
        $testimoni = Testimoni::orderBy('urutan', 'asc')->get();
        // Pass the collections to the view
        return view('landing-page.index', [
            'sliders' => $sliders,
            'paket' => $paket,
            'fitur' => $fitur,
            'alasan' => $alasan,
            'testimoni' => $testimoni,
        ]);
    }
}
