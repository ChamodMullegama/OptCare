<?php

namespace domain\Services\AdminArea;

use App\Models\EyeHospital;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EyeHospitalService
{
    protected $eyeHospital;

    public function __construct()
    {
        $this->eyeHospital = new EyeHospital();
    }

    public function getAll()
    {
        return $this->eyeHospital->all();
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'hospital_name' => 'required|string|max:255|unique:eye_hospitals,hospital_name',
            'address' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'social_media_links' => 'nullable|array',
            'website_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'clinic_days' => 'nullable|array',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $data['hospitalId'] = 'EH' . strtoupper(str()->random(6));

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('uploads/eye_hospitals', 'public');
            $data['image'] = $path;
        }

        // Restructure clinic_days if provided
        if (isset($data['clinic_days']) && is_array($data['clinic_days'])) {
            $clinicDays = [];
            foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day) {
                if (isset($data['clinic_days'][$day]['from']) && isset($data['clinic_days'][$day]['to'])) {
                    $clinicDays[$day] = [
                        'from' => $data['clinic_days'][$day]['from'],
                        'to' => $data['clinic_days'][$day]['to'],
                    ];
                }
            }
            $data['clinic_days'] = $clinicDays;
        }

        // Restructure social_media_links if provided
        if (isset($data['social_media_links'])) {
            $socialMedia = [
                'whatsapp' => $data['social_media_links']['whatsapp'] ?? null,
                'instagram' => $data['social_media_links']['instagram'] ?? null,
                'linkedin' => $data['social_media_links']['linkedin'] ?? null,
                'facebook' => $data['social_media_links']['facebook'] ?? null,
                'x' => $data['social_media_links']['x'] ?? null,
            ];
            $data['social_media_links'] = $socialMedia;
        }

        return $this->eyeHospital->create($data);
    }

    public function getById($id)
    {
        return $this->eyeHospital->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $eyeHospital = $this->eyeHospital->findOrFail($id);

        $validator = Validator::make($data, [
            'hospital_name' => 'required|string|max:255|unique:eye_hospitals,hospital_name,' . $eyeHospital->id,
            'address' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'social_media_links' => 'nullable|array',
            'website_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'clinic_days' => 'nullable|array',
            'latitude' => '|numeric',
            'longitude' => '|numeric',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($eyeHospital->image && Storage::disk('public')->exists($eyeHospital->image)) {
                Storage::disk('public')->delete($eyeHospital->image);
            }
            $path = $data['image']->store('uploads/eye_hospitals', 'public');
            $data['image'] = $path;
        } elseif (!isset($data['image'])) {
            unset($data['image']); // Avoid overwriting image if not uploaded
        }

        // Restructure clinic_days if provided
        if (isset($data['clinic_days']) && is_array($data['clinic_days'])) {
            $clinicDays = [];
            foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day) {
                if (isset($data['clinic_days'][$day]['from']) && isset($data['clinic_days'][$day]['to'])) {
                    $clinicDays[$day] = [
                        'from' => $data['clinic_days'][$day]['from'],
                        'to' => $data['clinic_days'][$day]['to'],
                    ];
                }
            }
            $data['clinic_days'] = $clinicDays;
        }

        // Restructure social_media_links if provided
        if (isset($data['social_media_links'])) {
            $socialMedia = [
                'whatsapp' => $data['social_media_links']['whatsapp'] ?? null,
                'instagram' => $data['social_media_links']['instagram'] ?? null,
                'linkedin' => $data['social_media_links']['linkedin'] ?? null,
                'facebook' => $data['social_media_links']['facebook'] ?? null,
                'x' => $data['social_media_links']['x'] ?? null,
            ];
            $data['social_media_links'] = $socialMedia;
        }

        $eyeHospital->update($data);
        return $eyeHospital;
    }

    public function delete($id)
    {
        $eyeHospital = $this->eyeHospital->findOrFail($id);
        if ($eyeHospital->image && Storage::disk('public')->exists($eyeHospital->image)) {
            Storage::disk('public')->delete($eyeHospital->image);
        }
        $eyeHospital->delete();
        return true;
    }
}
