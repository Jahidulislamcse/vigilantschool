<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('images')->orderBy('order', 'asc')->orderBy('event_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'album_images' => 'nullable|array',
            'album_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('uploads/events', 'public');
            $validated['cover_image'] = 'storage/' . $path;
        }

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Event::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $event = Event::create($validated);

        // Upload multiple album images
        if ($request->hasFile('album_images')) {
            $currentOrder = 1;
            foreach ($request->file('album_images') as $file) {
                $photoPath = $file->store('uploads/events/album', 'public');
                $event->images()->create([
                    'image' => 'storage/' . $photoPath,
                    'caption' => null,
                    'order' => $currentOrder++,
                ]);
            }
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'School Event & Album created successfully!');
    }

    public function edit(Event $event)
    {
        $event->load('images');
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug,' . $event->id,
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'album_images' => 'nullable|array',
            'album_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old cover if stored in storage/uploads/events
            if ($event->cover_image && str_starts_with($event->cover_image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $event->cover_image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('cover_image')->store('uploads/events', 'public');
            $validated['cover_image'] = 'storage/' . $path;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $event->update($validated);

        // Upload additional album images if provided
        if ($request->hasFile('album_images')) {
            $maxOrder = $event->images()->max('order') ?? 0;
            foreach ($request->file('album_images') as $file) {
                $photoPath = $file->store('uploads/events/album', 'public');
                $event->images()->create([
                    'image' => 'storage/' . $photoPath,
                    'caption' => null,
                    'order' => ++$maxOrder,
                ]);
            }
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'School Event & Album updated successfully!');
    }

    public function destroy(Event $event)
    {
        // Delete cover image
        if ($event->cover_image && str_starts_with($event->cover_image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $event->cover_image);
            Storage::disk('public')->delete($oldPath);
        }

        // Delete all album image files
        foreach ($event->images as $img) {
            if ($img->image && str_starts_with($img->image, 'storage/')) {
                $imgPath = str_replace('storage/', '', $img->image);
                Storage::disk('public')->delete($imgPath);
            }
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event and its entire photo album deleted successfully!');
    }

    public function destroyImage(EventImage $image)
    {
        if ($image->image && str_starts_with($image->image, 'storage/')) {
            $imgPath = str_replace('storage/', '', $image->image);
            Storage::disk('public')->delete($imgPath);
        }

        $image->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Album photo deleted successfully!',
            ]);
        }

        return back()->with('success', 'Photo removed from album successfully!');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|integer|exists:events,id',
            'orders.*.order' => 'required|integer|min:0',
        ]);

        foreach ($validated['orders'] as $item) {
            Event::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Events sequence updated successfully!',
        ]);
    }
}
