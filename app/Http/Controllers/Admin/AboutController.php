<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutSection::firstOrCreate([], [
            'title' => 'Learn More About Our Work And Our Cultural Activities',
            'tagline' => 'About Our School',
            'description_1' => 'Our curriculum combines academic fundamentals with arts, music, and social development.',
            'description_2' => 'With certified child educators and state-of-the-art facilities, we provide a safe, nurturing second home.',
            'founder_name' => 'Dr. Johnathan Vance',
            'founder_role' => 'Founder & Principal',
            'founder_photo' => 'kider/img/user.jpg',
            'image_1' => 'kider/img/about-1.jpg',
            'image_2' => 'kider/img/about-2.jpg',
            'image_3' => 'kider/img/about-3.jpg',
            'cta_title' => 'Become A Teacher At Kider',
            'cta_description' => 'Join our passionate team of child educators and help shape the next generation.',
            'cta_button_text' => 'Apply Now',
            'cta_button_url' => '/contact',
            'cta_image' => 'kider/img/call-to-action.jpg',
        ]);

        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutSection::first();
        if (!$about) {
            $about = new AboutSection();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description_1' => 'required|string',
            'description_2' => 'nullable|string',
            'founder_name' => 'nullable|string|max:255',
            'founder_role' => 'nullable|string|max:255',
            'founder_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_url' => 'nullable|string|max:255',
            'cta_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imageFields = ['founder_photo', 'image_1', 'image_2', 'image_3', 'cta_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('uploads/about', 'public');
                $validated[$field] = 'storage/' . $path;
            } else {
                unset($validated[$field]);
            }
        }

        $about->fill($validated)->save();

        return redirect()->route('admin.about.index')
            ->with('success', 'About Us & CTA Section updated successfully!');
    }
}
