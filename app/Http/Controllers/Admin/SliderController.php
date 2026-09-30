<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btn_text_1' => 'nullable|string|max:100',
            'btn_url_1' => 'nullable|string|max:255',
            'btn_text_2' => 'nullable|string|max:100',
            'btn_url_2' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/sliders', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Hero Slider created successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btn_text_1' => 'nullable|string|max:100',
            'btn_url_1' => 'nullable|string|max:255',
            'btn_text_2' => 'nullable|string|max:100',
            'btn_url_2' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/sliders', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Hero Slider updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Hero Slider deleted successfully!');
    }
}
