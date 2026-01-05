<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display the package selection form for license activation.
     */
    public function showPackageSelection(Request $request)
    {
        // Get all active packages with their features
        $pakets = Paket::with('fiturs')
            ->where('is_active', true)
            ->orderBy('harga', 'asc')
            ->get();

        // Get school ID from various sources
        $sekolahId = $this->getSekolahId($request);

        return view('payment.paketselect', [
            'pakets' => $pakets,
            'sekolahId' => $sekolahId
        ]);
    }

    /**
     * Process the package selection form submission.
     */
    public function processPackageSelection(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'id_sekolah' => 'required|string|max:10',
            'pilih_paket' => 'required|uuid|exists:paket,id',
            'pilih_periode' => 'required|in:bulanan,tahunan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the selected package
        $selectedPaket = Paket::with('fiturs')->find($request->pilih_paket);

        if (!$selectedPaket || !$selectedPaket->is_active) {
            return redirect()->back()
                ->withErrors(['pilih_paket' => 'Paket yang dipilih tidak tersedia.'])
                ->withInput();
        }

        // Verify school ID exists
        $user = User::where('id_sekolah', $request->id_sekolah)->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['id_sekolah' => 'ID Sekolah tidak ditemukan.'])
                ->withInput();
        }

        // Calculate pricing based on period selection
        $pricingData = $this->calculatePricing($selectedPaket, $request->pilih_periode);

        // Store selection data in session for next step
        session([
            'license_activation' => [
                'id_sekolah' => $request->id_sekolah,
                'user_id' => $user->id,
                'paket_id' => $selectedPaket->id,
                'periode' => $request->pilih_periode,
                'pricing' => $pricingData
            ]
        ]);

        // Redirect to payment method selection
        return redirect()->route('payment.payment-methods');
    }

    /**
     * Show payment method selection page.
     */
    public function showPaymentMethods()
    {
        $activationData = session('license_activation');

        if (!$activationData) {
            return redirect()->route('payment.packages')
                ->withErrors(['error' => 'Data aktivasi tidak ditemukan. Silakan pilih paket terlebih dahulu.']);
        }

        // Get full package data
        $paket = Paket::with('fiturs')->find($activationData['paket_id']);

        return view('payment.pay-options', [
            'activationData' => $activationData,
            'paket' => $paket
        ]);
    }

    /**
     * Process payment method selection.
     */
    public function processPaymentMethodSelection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|string|in:qris,virtual_bni,virtual_bri,atm_bni,atm_bri'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $activationData = session('license_activation');

        if (!$activationData) {
            return redirect()->route('payment.packages')
                ->withErrors(['error' => 'Data aktivasi tidak ditemukan.']);
        }

        // Add payment method to session data
        $activationData['payment_method'] = $request->payment_method;
        session(['license_activation' => $activationData]);

        // Redirect to confirmation page
        return redirect()->route('payment.confirmation');
    }

    /**
     * Show payment confirmation page.
     */
    public function showConfirmation()
    {
        $activationData = session('license_activation');

        if (!$activationData) {
            return redirect()->route('payment.packages')
                ->withErrors(['error' => 'Data aktivasi tidak ditemukan. Silakan pilih paket terlebih dahulu.']);
        }

        // Check if payment method is selected
        if (!isset($activationData['payment_method'])) {
            return redirect()->route('payment.payment-methods')
                ->withErrors(['error' => 'Silakan pilih metode pembayaran terlebih dahulu.']);
        }

        // Get full package and user data
        $paket = Paket::with('fiturs')->find($activationData['paket_id']);
        $user = User::find($activationData['user_id']);

        return view('payment.confirmation', [
            'activationData' => $activationData,
            'paket' => $paket,
            'user' => $user
        ]);
    }

    /**
     * Process the final payment confirmation.
     */
    public function processPayment(Request $request)
    {
        $activationData = session('license_activation');

        if (!$activationData) {
            return redirect()->route('payment.packages')
                ->withErrors(['error' => 'Data aktivasi tidak ditemukan.']);
        }

        // Here you would typically:
        // 1. Create payment record
        // 2. Generate invoice
        // 3. Integrate with payment gateway
        // 4. Send confirmation emails

        // For now, let's create a basic payment record structure
        // You'll need to create appropriate models for this

        try {
            // Example: Create payment/subscription record
            // $payment = Payment::create([
            //     'user_id' => $activationData['user_id'],
            //     'paket_id' => $activationData['paket_id'],
            //     'amount' => $activationData['pricing']['total'],
            //     'periode' => $activationData['periode'],
            //     'payment_method' => $activationData['payment_method'],
            //     'status' => 'pending'
            // ]);

            // Clear session data
            session()->forget('license_activation');

            return redirect()->back()->with('payment_success', true);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memproses aktivasi. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Show payment success page.
     */
    public function showSuccess()
    {
        return view('payment.success');
    }

    /**
     * Get school ID from various sources (authenticated user, request parameter, etc.)
     */
    private function getSekolahId(Request $request)
    {
        // Priority order: request parameter -> authenticated user -> session
        if ($request->has('id_sekolah')) {
            return $request->input('id_sekolah');
        }

        if (Auth::check()) {
            return Auth::user()->id_sekolah;
        }

        return session('temp_sekolah_id', '');
    }

    /**
     * Calculate pricing based on package and period selection.
     */
    private function calculatePricing(Paket $paket, string $periode)
    {
        $pricing = [
            'periode' => $periode,
            'harga_normal' => $paket->harga_normal,
            'harga_paket' => $paket->harga,
            'diskon_persen' => $paket->diskon_persen ?? 0,
            'diskon_amount' => 0,
            'total' => 0
        ];

        if ($periode === 'tahunan') {
            // Calculate total based on harga_normal * 12
            $totalHargaNormalTahunan = $paket->harga_normal * 12;
            $pricing['total'] = $paket->harga; // Use discounted annual price
            $pricing['diskon_amount'] = $totalHargaNormalTahunan - $paket->harga;
        } else {
            // Use normal monthly price
            $pricing['total'] = $paket->harga_normal;
        }

        return $pricing;
    }

    /**
     * API endpoint to get package details (for AJAX requests)
     */
    public function getPackageDetails(Request $request)
    {
        $paketId = $request->input('paket_id');

        $paket = Paket::with('fiturs')
            ->where('id', $paketId)
            ->where('is_active', true)
            ->first();

        if (!$paket) {
            return response()->json(['error' => 'Paket tidak ditemukan'], 404);
        }

        $hargaTahunan = $paket->harga_normal * 12;
        $diskonAmount = $hargaTahunan - $paket->harga;

        return response()->json([
            'paket' => $paket,
            'pricing' => [
                'bulanan' => $paket->harga_normal,
                'tahunan' => $paket->harga,
                'diskon_persen' => $paket->diskon_persen,
                'diskon_amount' => $diskonAmount
            ]
        ]);
    }

    /**
     * Get payment method display name
     */
    public function getPaymentMethodName($method)
    {
        $methods = [
            'qris' => 'QRIS',
            'virtual_bni' => 'Virtual Account BNI',
            'virtual_bri' => 'Virtual Account BRI',
            'atm_bni' => 'ATM BNI',
            'atm_bri' => 'ATM BRI'
        ];

        return $methods[$method] ?? $method;
    }
}
