<?php

namespace domain\Services\PublicArea;

use App\Models\OpticCenter;

class OpticCenterService
{
    protected $opticCenter;

    public function __construct()
    {
        $this->opticCenter = new OpticCenter();
    }

    public function all()
    {
        return $this->opticCenter->all();
    }

    public function search(?string $searchTerm)
    {
        if (empty($searchTerm)) {
            return $this->all();
        }

        return $this->opticCenter->where('hospital_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('location', 'like', '%' . $searchTerm . '%')
            ->orWhere('address', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->get();
    }

    public function getDetails($hospitalId)
    {
        return $this->opticCenter->where('hospitalId', $hospitalId)->firstOrFail();
    }

    public function getRecentCenters($excludedHospitalId, $limit = 5)
    {
        return $this->opticCenter->where('hospitalId', '!=', $excludedHospitalId)
            ->latest()
            ->take($limit)
            ->get();
    }
}
