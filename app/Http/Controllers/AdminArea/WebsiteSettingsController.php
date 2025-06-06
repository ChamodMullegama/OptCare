<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteSettingsController extends Controller
{
    public function All()
    {
        try {
            $settings = WebsiteSetting::first();
            return view('AdminArea.Pages.WebsiteSettings.index', compact('settings'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'websiteName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNo1' => 'required|string|max:20',
            'contactNo2' => 'nullable|string|max:20',
            'addressLine1' => 'required|string|max:255',
            'addressLine2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'whatsappLink' => 'nullable|url',
            'instagramLink' => 'nullable|url',
            'facebookLink' => 'nullable|url',
            'linkedinLink' => 'nullable|url',
            'twitterLink' => 'nullable|url',
            'footerText' => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->all();
            $data['rcode'] = 'WS' . Str::random(6);
            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('uploads/settings', 'public');
            }
            WebsiteSetting::create($data);
            return redirect()->back()->with('success', 'Settings added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'websiteName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNo1' => 'required|string|max:20',
            'contactNo2' => 'nullable|string|max:20',
            'addressLine1' => 'required|string|max:255',
            'addressLine2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'whatsappLink' => 'nullable|url',
            'instagramLink' => 'nullable|url',
            'facebookLink' => 'nullable|url',
            'linkedinLink' => 'nullable|url',
            'twitterLink' => 'nullable|url',
            'footerText' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $settings = WebsiteSetting::first();
            if (!$settings) {
                return back()->withErrors(['error' => 'No settings record found.']);
            }
            $data = $request->all();
            if ($request->hasFile('logo')) {
                if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                    Storage::disk('public')->delete($settings->logo);
                }
                $data['logo'] = $request->file('logo')->store('uploads/settings', 'public');
            } else {
                $data['logo'] = $settings->logo;
            }
            $settings->fill($data)->save();
            return redirect()->back()->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
