<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getAllGrouped();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'site_logo', 'site_favicon', 'og_image']);

        foreach ($data as $key => $value) {
            $group = 'general';
            if (str_contains($key, 'contact_') || $key === 'working_hours' || $key === 'google_map_iframe') {
                $group = 'contact';
            } elseif (str_contains($key, '_url')) {
                $group = 'social';
            } elseif (str_contains($key, 'meta_') || str_contains($key, 'google_') || $key === 'og_image') {
                $group = 'seo';
            }

            Setting::set($key, $value, $group);
        }

        // Handle Site Logo Upload
        if ($request->hasFile('site_logo')) {
            $request->validate(['site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048']);
            $logoPath = $request->file('site_logo')->store('uploads/branding', 'public');
            Setting::set('site_logo', 'storage/' . $logoPath, 'branding', 'image');
        }

        // Handle Site Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $request->validate(['site_favicon' => 'image|mimes:jpeg,png,jpg,gif,ico,webp|max:1024']);
            $faviconPath = $request->file('site_favicon')->store('uploads/branding', 'public');
            Setting::set('site_favicon', 'storage/' . $faviconPath, 'branding', 'image');
        }

        // Handle Social Share (OG) Image Upload
        if ($request->hasFile('og_image')) {
            $request->validate(['og_image' => 'image|mimes:jpeg,png,jpg,webp|max:3072']);
            $ogPath = $request->file('og_image')->store('uploads/seo', 'public');
            Setting::set('og_image', 'storage/' . $ogPath, 'seo', 'image');
        }

        Cache::forget('all_settings_grouped');

        return redirect()->route('admin.settings.index')
            ->with('success', 'School settings updated successfully!');
    }
}
