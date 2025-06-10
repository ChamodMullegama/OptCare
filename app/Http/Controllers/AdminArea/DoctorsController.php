<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use domain\Facades\DoctorFacade;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorsController extends Controller
{
   public function All()
    {
        try {
            $doctors = DoctorFacade::getAll();
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
            'qualification' => 'nullable|string',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
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
            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $request->file('profile_image');
            }
            DoctorFacade::store($data);
            return redirect()->route('doctors.all')->with('success', 'Doctor added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EditPage($id)
    {
        try {
            $doctor = DoctorFacade::getById($id);
            return view('AdminArea.Pages.Doctors.editDoctor', compact('doctor'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $doctor = DoctorFacade::getById($request->id);

        $request->validate([
           'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:25|max:80',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'mobile_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:255',
            'marital_status' => 'nullable|in:married,unmarried',
            'qualification' => 'nullable|string',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
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
            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $request->file('profile_image');
            }
            DoctorFacade::update($request->id, $data);
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

            DoctorFacade::delete($request->id);
            return back()->with('success', 'Doctor deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Profile($id)
    {
        try {
            $doctor = DoctorFacade::getProfile($id);
            return view('AdminArea.Pages.Doctors.doctorProfile', compact('doctor'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
