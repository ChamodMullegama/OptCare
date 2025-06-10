<?php

namespace domain\Services;

use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorService
{
    protected $doctor;

    public function __construct()
    {
        $this->doctor = new Doctor();
    }

    public function getAll()
    {
        return $this->doctor->all();
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
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

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $data['doctorId'] = 'DR' . Str::random(6);

        if ($data['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['profile_image']->store('uploads/doctors', 'public');
            $data['profile_image'] = $path;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->doctor->create($data);
    }

    public function getById($id)
    {
        return $this->doctor->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $doctor = $this->doctor->findOrFail($id);

        $validator = Validator::make($data, [
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

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        if ($data['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $path = $data['profile_image']->store('uploads/doctors', 'public');
            $data['profile_image'] = $path;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $doctor->update($data);
        return $doctor;
    }

    public function delete($id)
    {
        $doctor = $this->doctor->findOrFail($id);
        if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
            Storage::disk('public')->delete($doctor->profile_image);
        }
        $doctor->delete();
        return true;
    }

    public function getProfile($id)
    {
        $doctor = $this->doctor->findOrFail($id);
        $doctor->patients_count = rand(1000, 5000); // Simulated data
        $doctor->patients_percentage = rand(50, 80) . '%';
        $doctor->surgeries_count = rand(100, 1000); // Simulated data
        $doctor->surgeries_percentage = rand(20, 40) . '%';
        $doctor->reviews_count = rand(100, 3000); // Simulated data
        $doctor->reviews_percentage = rand(20, 40) . '%';
        return $doctor;
    }
}
