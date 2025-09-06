<?php

namespace domain\Services\AdminArea;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorService
{
    protected $doctor;
     protected $appointment;
    protected $doctorReview;

    public function __construct()
    {
        $this->doctor = new Doctor();
             $this->appointment = new Appointment();
        $this->doctorReview = new DoctorReview();
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
    if (isset($data['profile_image']) && $data['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
        if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
            Storage::disk('public')->delete($doctor->profile_image);
        }
        $path = $data['profile_image']->store('uploads/doctors', 'public');
        $data['profile_image'] = $path;
    } else {
        unset($data['profile_image']); 
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

    // public function getProfile($id)
    // {
    //     $doctor = $this->doctor->findOrFail($id);
    //     $doctor->patients_count = rand(1000, 5000); // Simulated data
    //     $doctor->patients_percentage = rand(50, 80) . '%';
    //     $doctor->surgeries_count = rand(100, 1000); // Simulated data
    //     $doctor->surgeries_percentage = rand(20, 40) . '%';
    //     $doctor->reviews_count = rand(100, 3000); // Simulated data
    //     $doctor->reviews_percentage = rand(20, 40) . '%';
    //     return $doctor;
    // }

     public function getProfile($id)
    {
        try {
            $doctor = $this->doctor->findOrFail($id);

            // Fetch appointment counts
            $totalAppointments = $this->appointment->where('doctorId', $doctor->doctorId)->count();
            $completedAppointments = $this->appointment->where('doctorId', $doctor->doctorId)
                ->where('status', 'completed')
                ->count();
            $dueAppointments = $this->appointment->where('doctorId', $doctor->doctorId)
                ->whereIn('status', ['pending', 'accepted'])
                ->where('date', '>=', Carbon::today()->toDateString())
                ->count();

            // Fetch total reviews
            $totalReviews = $this->doctorReview->where('doctorId', $doctor->doctorId)->count();

            // Fetch today's appointments
            $todayAppointments = $this->appointment->where('doctorId', $doctor->doctorId)
                ->where('date', Carbon::today()->toDateString())
                ->orderBy('time', 'asc')
                ->get();

            // Fetch due appointments
            $dueAppointmentsList = $this->appointment->where('doctorId', $doctor->doctorId)
                ->whereIn('status', ['pending', 'accepted'])
                ->where('date', '>=', Carbon::today()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();

            // Fetch latest 3 reviews
            $latestReviews = $this->doctorReview->where('doctorId', $doctor->doctorId)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            // Simulated data (as in original getProfile)
            $doctor->patients_count = $totalAppointments; // Use actual appointment count instead of random
            $doctor->patients_percentage = rand(50, 80) . '%';
            $doctor->surgeries_count = rand(100, 1000); // Keep as simulated
            $doctor->surgeries_percentage = rand(20, 40) . '%';
            $doctor->reviews_count = $totalReviews; // Use actual review count
            $doctor->reviews_percentage = rand(20, 40) . '%';

            return compact(
                'doctor',
                'totalAppointments',
                'completedAppointments',
                'dueAppointments',
                'totalReviews',
                'todayAppointments',
                'dueAppointmentsList',
                'latestReviews'
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to load doctor profile: ' . $e->getMessage());
        }
    }
}
