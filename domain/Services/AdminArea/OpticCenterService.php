<?php

namespace domain\Services\AdminArea;

use App\Models\OpticCenter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OpticCenterService
{
    protected $opticCenter;

    public function __construct()
    {
        $this->opticCenter = new OpticCenter();
    }

    public function getAll()
    {
        return $this->opticCenter->all();
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'hospital_name' => 'required|string|max:255|unique:optic_centers,hospital_name',
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

        $data['hospitalId'] = 'OC' . strtoupper(str()->random(6));

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('uploads/optic_centers', 'public');
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

        return $this->opticCenter->create($data);
    }

    public function getById($id)
    {
        return $this->opticCenter->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $opticCenter = $this->opticCenter->findOrFail($id);

        $validator = Validator::make($data, [
            'hospital_name' => 'required|string|max:255|unique:optic_centers,hospital_name,' . $opticCenter->id,
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

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($opticCenter->image && Storage::disk('public')->exists($opticCenter->image)) {
                Storage::disk('public')->delete($opticCenter->image);
            }
            $path = $data['image']->store('uploads/optic_centers', 'public');
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

        $opticCenter->update($data);
        return $opticCenter;
    }

    public function delete($id)
    {
        $opticCenter = $this->opticCenter->findOrFail($id);
        if ($opticCenter->image && Storage::disk('public')->exists($opticCenter->image)) {
            Storage::disk('public')->delete($opticCenter->image);
        }
        $opticCenter->delete();
        return true;
    }
}
