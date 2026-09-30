<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/gallery', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['order'] = $validated['order'] ?? 0;

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Photo added to gallery successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Photo removed from gallery successfully!');
    }
}
