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
        $data = $request->except(['_token', '_method', 'site_logo', 'site_favicon']);

        foreach ($data as $key => $value) {
            $group = 'general';
            if (str_contains($key, 'contact_') || $key === 'working_hours' || $key === 'google_map_iframe') {
                $group = 'contact';
            } elseif (str_contains($key, '_url')) {
                $group = 'social';
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

        Cache::forget('all_settings_grouped');

        return redirect()->route('admin.settings.index')
            ->with('success', 'School settings updated successfully!');
    }
}
