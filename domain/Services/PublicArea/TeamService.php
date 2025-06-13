<?php

namespace domain\Services\PublicArea;

use App\Models\Team;

class TeamService
{
    protected $team;

    public function __construct()
    {
        $this->team = new Team();
    }

    public function all()
    {
        return $this->team->latest()->get();
    }
}
