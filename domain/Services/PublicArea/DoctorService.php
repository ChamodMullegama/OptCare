<?php

namespace domain\Services\PublicArea;

use App\Models\Doctor;

class DoctorService
{
    protected $doctor;

    public function __construct()
    {
        $this->doctor = new Doctor();
    }

    public function all()
    {
        return $this->doctor->all();
    }

    public function search(?string $searchTerm)
    {
        if (empty($searchTerm)) {
            return $this->all();
        }

        return $this->doctor->where('first_name', 'like', '%'.$searchTerm.'%')
                        ->orWhere('last_name', 'like', '%'.$searchTerm.'%')
                        ->orWhere('qualification', 'like', '%'.$searchTerm.'%')
                        ->orWhere('designation', 'like', '%'.$searchTerm.'%')
                        ->get();
    }

    public function getDetails($id)
    {
        return $this->doctor->findOrFail($id);
    }
}
