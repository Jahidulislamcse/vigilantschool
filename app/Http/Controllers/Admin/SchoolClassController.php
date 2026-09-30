<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with('teacher')->orderBy('order', 'asc')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::where('is_active', true)->orderBy('name', 'asc')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'description' => 'nullable|string',
            'age_range' => 'required|string|max:100',
            'time_schedule' => 'required|string|max:100',
            'capacity' => 'required|string|max:100',
            'fee' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/classes', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        SchoolClass::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'School Class created successfully!');
    }

    public function edit(SchoolClass $class)
    {
        $teachers = Teacher::where('is_active', true)->orderBy('name', 'asc')->get();
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'description' => 'nullable|string',
            'age_range' => 'required|string|max:100',
            'time_schedule' => 'required|string|max:100',
            'capacity' => 'required|string|max:100',
            'fee' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/classes', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'School Class updated successfully!');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'School Class deleted successfully!');
    }
}
