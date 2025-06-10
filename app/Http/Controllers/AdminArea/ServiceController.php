<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use domain\Facades\ServiceFacade;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function All()
    {
        try {
            $services = ServiceFacade::all();
            return view('AdminArea.Pages.Service.index', compact('services'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:services,title',
            'description' => 'required|string',
        ], [
            'title.unique' => 'The service title must be unique. Please choose another title.',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            ServiceFacade::store($data);
            return back()->with('success', 'Service added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:services,title,' . $request->id,
            'description' => 'required|string',
        ], [
            'title.unique' => 'The service title must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            ServiceFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:services,id',
            ]);

            ServiceFacade::delete($request->id);
            return back()->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ServiceImageAdd(Request $request)
    {
        $request->validate([
            'serviceId' => 'required|exists:services,serviceId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            ServiceFacade::serviceImageAdd($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewServiceImageAll($serviceId)
    {
        try {
            $service_images = ServiceFacade::viewServiceImageAll($serviceId);
            return view('AdminArea.Pages.Service.viewServiceImage', compact('service_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewServiceImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|exists:service_images,id',
            ]);

            ServiceFacade::viewServiceImageDelete($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            ServiceFacade::isPrimary($id);
            $message = ServiceImage::findOrFail($id)->isPrimary ? 'Item activated successfully!' : 'Item deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
