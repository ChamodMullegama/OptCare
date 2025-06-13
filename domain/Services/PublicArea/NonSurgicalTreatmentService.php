<?php

namespace domain\Services\PublicArea;

use App\Models\NonSurgicalTreatment;

class NonSurgicalTreatmentService
{
    protected $treatment;

    public function __construct()
    {
        $this->treatment = new NonSurgicalTreatment();
    }

    public function all()
    {
        return $this->treatment->all();
    }

    public function search(?string $searchTerm)
    {
        if (empty($searchTerm)) {
            return $this->all();
        }

        return $this->treatment->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->get();
    }

    public function getDetails($id)
    {
        return $this->treatment->findOrFail($id);
    }

    public function getRecentTreatments($excludedId, $limit = 5)
    {
        return $this->treatment->where('id', '!=', $excludedId)
            ->latest()
            ->take($limit)
            ->get();
    }
}
