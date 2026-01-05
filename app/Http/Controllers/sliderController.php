<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        // Search logic
        $slidersQuery = Slider::query()
            ->when($search, function ($query, $search) {
                // Apply search filter to 'title' and 'description' columns
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('urutan', 'asc');

        $sliders = $slidersQuery->paginate($perPage)->withQueryString();

        return view('adminpage.slider', compact('sliders'));
    }

    public function create()
    {
        // Return the new form view for creating an item.
        return view('adminpage.sliderform');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:sliders,urutan',
        ]);

        $data = $request->only(['title', 'description', 'urutan']);
        // Handle file upload
        if ($request->hasFile('image_url')) {
            // Store the file in `storage/app/public/slider_image` and get the path
            $path = $request->file('image_url')->store('slider_image', 'public');
            $data['image_url'] = $path;
        }
        $data['is_active'] = $request->has('is_active');
        $data['id'] = Str::uuid();
        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider baru berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('adminpage.sliderform', [
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'urutan' => 'nullable|integer|min:0|unique:sliders,urutan,' . $slider->id,
        ]);

        if ($request->hasFile('image_url')) {
            // Delete old image_url if it exists
            if ($slider->image_url) {
                Storage::disk('public')->delete($slider->image_url);
            }

            // Store the new image_url
            $path = $request->file('image_url')->store('slider_image', 'public');
            $data['image_url'] = $path;
        }
        $data['is_active'] = $request->has('is_active');

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image_url) {
            Storage::disk('public')->delete($slider->image_url);
        }
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider berhasil dihapus.');
    }
}
