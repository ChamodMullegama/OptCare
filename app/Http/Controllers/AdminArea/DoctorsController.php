<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorsController extends Controller
{
     public function All()
    {
        try {
            $doctors = Doctor::all();
            return view('AdminArea.Pages.Doctors.index', compact('doctors'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function AddPage()
    {
        try {
            return view('AdminArea.Pages.Doctors.addDoctor');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:25|max:80',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:doctors,email',
            'mobile_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:255',
            'marital_status' => 'nullable|in:married,unmarried',
            'qualification' => 'nullable|in:MBBS,MD,MBBS,MS,MBBS',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|in:USA,Canada,Brazil,India,China',
            'state' => 'nullable|in:Alabama,Alaska,Arizona,California,Florida',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'availability.*.from' => 'nullable|in:7AM,8AM,9AM,10AM,11AM,12PM',
            'availability.*.to' => 'nullable|in:1PM,2PM,3PM,4PM,5PM,6PM',
            'username' => 'nullable|string|max:255|unique:doctors,username',
            'password' => 'nullable|string|min:8|max:20|confirmed',
        ]);

        try {
            $data = $request->all();
            $data['doctorId'] = 'DR' . Str::random(6);

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $path = $file->store('uploads/doctors', 'public');
                $data['profile_image'] = $path;
            }

            // Hash password if provided
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            Doctor::create($data);
            return redirect()->route('doctors.all')->with('success', 'Doctor added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EditPage($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            return view('AdminArea.Pages.Doctors.editDoctor', compact('doctor'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $doctor = Doctor::findOrFail($request->id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:25|max:80',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'mobile_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:255',
            'marital_status' => 'nullable|in:married,unmarried',
            'qualification' => 'nullable|in:MBBS,MD,MBBS,MS,MBBS',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|in:USA,Canada,Brazil,India,China',
            'state' => 'nullable|in:Alabama,Alaska,Arizona,California,Florida',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'availability.*.from' => 'nullable|in:7AM,8AM,9AM,10AM,11AM,12PM',
            'availability.*.to' => 'nullable|in:1PM,2PM,3PM,4PM,5PM,6PM',
            'username' => 'nullable|string|max:255|unique:doctors,username,' . $doctor->id,
            'password' => 'nullable|string|min:8|max:20|confirmed',
        ]);

        try {
            $data = $request->all();

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
                    Storage::disk('public')->delete($doctor->profile_image);
                }
                $file = $request->file('profile_image');
                $path = $file->store('uploads/doctors', 'public');
                $data['profile_image'] = $path;
            }

            // Hash password if provided
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $doctor->update($data);
            return redirect()->route('doctors.all')->with('success', 'Doctor updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:doctors,id',
            ]);

            $doctor = Doctor::findOrFail($request->id);
            if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $doctor->delete();
            return back()->with('success', 'Doctor deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function Profile($id)
{
    try {
        $doctor = Doctor::findOrFail($id);
        // Placeholder for stats (can be enhanced with actual counts if tracked)
        $doctor->patients_count = rand(1000, 5000); // Simulated data
        $doctor->patients_percentage = rand(50, 80) . '%';
        $doctor->surgeries_count = rand(100, 1000); // Simulated data
        $doctor->surgeries_percentage = rand(20, 40) . '%';
        $doctor->reviews_count = rand(100, 3000); // Simulated data
        $doctor->reviews_percentage = rand(20, 40) . '%';

        return view('AdminArea.Pages.Doctors.doctorProfile', compact('doctor'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}
}
