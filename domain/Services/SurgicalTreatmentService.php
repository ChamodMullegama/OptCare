<?php

namespace domain\Services;

use App\Models\SurgicalTreatment;
use Illuminate\Support\Facades\Storage;

class SurgicalTreatmentService
{
    protected $surgicalTreatment;

    public function __construct()
    {
        $this->surgicalTreatment = new SurgicalTreatment();
    }

    public function get($id)
    {
        return $this->surgicalTreatment->findOrFail($id);
    }

    public function all()
    {
        return $this->surgicalTreatment->all();
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image_path'] = $data['image']->store('uploads/surgical_treatment_images', 'public');
            unset($data['image']);
        }
        return $this->surgicalTreatment->create($data);
    }

    public function delete($id)
    {
        $treatment = $this->surgicalTreatment->findOrFail($id);
        if ($treatment->image_path && Storage::disk('public')->exists($treatment->image_path)) {
            Storage::disk('public')->delete($treatment->image_path);
        }
        return $treatment->delete();
    }

    public function update(array $data, $id)
    {
        $treatment = $this->surgicalTreatment->findOrFail($id);

        if (isset($data['image'])) {
            if ($treatment->image_path && Storage::disk('public')->exists($treatment->image_path)) {
                Storage::disk('public')->delete($treatment->image_path);
            }
            $data['image_path'] = $data['image']->store('surgical_treatment_images', 'public');
            unset($data['image']);
        }

        $treatment->update($data);
        return $treatment;
    }
}
