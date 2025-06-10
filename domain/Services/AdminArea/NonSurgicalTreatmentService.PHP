<?php

namespace domain\Services\AdminArea;

use App\Models\NonSurgicalTreatment;
use Illuminate\Support\Facades\Storage;

class NonSurgicalTreatmentService
{
    protected $nonSurgicalTreatment;

    public function __construct()
    {
        $this->nonSurgicalTreatment = new NonSurgicalTreatment();
    }

    public function get($id)
    {
        return $this->nonSurgicalTreatment->findOrFail($id);
    }

    public function all()
    {
        return $this->nonSurgicalTreatment->all();
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image_path'] = $data['image']->store('uploads/non_surgical_treatment_images', 'public');
            unset($data['image']);
        }
        return $this->nonSurgicalTreatment->create($data);
    }

    public function delete($id)
    {
        $treatment = $this->nonSurgicalTreatment->findOrFail($id);
        if ($treatment->image_path && Storage::disk('public')->exists($treatment->image_path)) {
            Storage::disk('public')->delete($treatment->image_path);
        }
        return $treatment->delete();
    }

    public function update(array $data, $id)
    {
        $treatment = $this->nonSurgicalTreatment->findOrFail($id);

        if (isset($data['image'])) {
            if ($treatment->image_path && Storage::disk('public')->exists($treatment->image_path)) {
                Storage::disk('public')->delete($treatment->image_path);
            }
            $data['image_path'] = $data['image']->store('non_surgical_treatment_images', 'public');
            unset($data['image']);
        }

        $treatment->update($data);
        return $treatment;
    }
}
