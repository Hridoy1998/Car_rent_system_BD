<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->get();

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:settings,key|max:50',
            'value' => 'nullable|string',
            'description' => 'nullable|string|max:255',
        ]);

        Setting::create($validated);

        return back()->with('success', 'Registry key "'.$validated['key'].'" established.');
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        $setting->update($validated);

        return back()->with('success', 'Registry key "'.$setting->key.'" updated.');
    }

    public function destroy(Setting $setting)
    {
        $key = $setting->key;
        $setting->delete();

        return back()->with('success', 'Registry key "'.$key.'" decommissioned.');
    }
}
