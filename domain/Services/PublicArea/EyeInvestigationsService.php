<?php

namespace domain\Services\PublicArea;

use App\Models\EyeScan;

class EyeInvestigationsService
{
    protected $eyeScan;

    public function __construct()
    {
        $this->eyeScan = new EyeScan();
    }

    public function all()
    {
        return $this->eyeScan->all();
    }

    public function search(?string $searchTerm)
    {
        // If search term is null or empty, return all records
        if (empty($searchTerm)) {
            return $this->all();
        }

        return $this->eyeScan->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->orWhere('purpose', 'like', '%' . $searchTerm . '%')
            ->orWhere('usage', 'like', '%' . $searchTerm . '%')
            ->get();
    }

      public function getDetails($eyeScanId)
    {
        return $this->eyeScan->where('eyeScanId', $eyeScanId)->firstOrFail();
    }

    public function getRecentEyeScans($eyeScanId, $limit = 5)
    {
        return $this->eyeScan->where('eyeScanId', '!=', $eyeScanId)
            ->latest()
            ->take($limit)
            ->get();
    }
}
