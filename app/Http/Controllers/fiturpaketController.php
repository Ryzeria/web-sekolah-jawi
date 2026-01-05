<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Paket;
// No longer need to use FiturPaket directly
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FiturPaketController extends Controller
{
    /**
     * Display the feature management grid.
     * Eager loads relationships for efficiency.
     */
    public function index()
    {
        // Get all packages and eager load their related features and pivot data.
        $pakets = Paket::with('fiturs')->orderBy('harga', 'asc')->get();

        // Get all features, ordered by the 'urutan' field.
        $fiturs = Fitur::orderBy('urutan', 'asc')->get();

        // The 'includedMap' is no longer needed. The view will get the data from $paket->fiturs.
        return view('adminpage.fitur-paket', compact('pakets', 'fiturs'));
    }

    /**
     * Update the feature-package relationships using the sync method.
     * This is the modern, efficient way to handle pivot table updates.
     */
    public function update(Request $request)
    {
        $request->validate([
            'feature_matrix' => 'nullable|array',
        ]);

        // Get the submitted matrix data. Default to an empty array.
        $featureMatrix = $request->input('feature_matrix', []);

        DB::beginTransaction();
        try {
            // Get all packages that were submitted in the form.
            $pakets = Paket::find(array_keys($featureMatrix));

            foreach ($pakets as $paket) {
                // Get the features submitted for this specific package.
                $fiturData = $featureMatrix[$paket->id] ?? [];

                $syncData = [];
                foreach ($fiturData as $fiturId => $value) {
                    // We only want to sync features that have a meaningful value.
                    // '0' from an unchecked checkbox or a completely empty string should be ignored.
                    if ($value !== '0' && $value !== null && $value !== '') {
                        // Prepare the data for the sync method.
                        // The key is the fitur_id, and the value is an array of pivot attributes.
                        $syncData[$fiturId] = ['value' => $value];
                    }
                }

                // The sync() method used to automatically adds, updates, and removes pivot records
                // to match the state of the $syncData array.
                $paket->fiturs()->sync($syncData);
            }

            DB::commit();
            return redirect()->route('fitur_paket.index')->with('success', 'Fitur paket berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollBack();

            // Log the error.
            Log::error('Error updating feature-package relationships: ' . $e->getMessage());
            dump($e);

            return redirect()->route('fitur_paket.index')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
}
