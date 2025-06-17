<?php

namespace domain\Services\PublicArea;

use App\Models\EyeHospital;

class EyeHospitalService
{
    protected $eyeHospital;

    public function __construct()
    {
        $this->eyeHospital = new EyeHospital();
    }

    public function all()
    {
        return $this->eyeHospital->all();
    }

    public function search(?string $searchTerm)
    {
        // If search term is null or empty, return all records
        if (empty($searchTerm)) {
            return $this->all();
        }

        return $this->eyeHospital->where('hospital_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('location', 'like', '%' . $searchTerm . '%')
            ->orWhere('address', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->get();
    }

    public function getDetails(string $hospitalId)
    {
        return $this->eyeHospital->where('hospitalId', $hospitalId)->firstOrFail();
    }

    public function getRecentHospitals(string $excludedHospitalId, int $limit = 5)
    {
        return $this->eyeHospital->where('hospitalId', '!=', $excludedHospitalId)
            ->latest()
            ->take($limit)
            ->get();
    }
}
