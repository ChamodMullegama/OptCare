<?php

namespace domain\Services\AdminArea;

use App\Models\Team;
use Illuminate\Support\Str;

class TeamService
{
    protected $team;

    public function __construct()
    {
        $this->team = new Team();
    }

    public function all()
    {
        return $this->team->all();
    }

    public function store(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['teamId'] = 'TM' . Str::random(6);
            $data['image'] = $data['image']->store('uploads/team', 'public');
        }
        return $this->team->create($data);
    }

    public function update(array $data, $id)
    {
        $team = $this->team->find($id);
        if (!$team) {
            throw new \Exception('Team member not found.');
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($team->image && file_exists(public_path('storage/' . $team->image))) {
                unlink(public_path('storage/' . $team->image));
            }
            $data['image'] = $data['image']->store('uploads/team', 'public');
        } else {
            $data['image'] = $team->image;
        }

        $team->update([
            'name' => $data['name'],
            'role' => $data['role'],
            'image' => $data['image'],
        ]);

        return $team;
    }

    public function delete($id)
    {
        $team = $this->team->findOrFail($id);
        if ($team->image && file_exists(public_path('storage/' . $team->image))) {
            unlink(public_path('storage/' . $team->image));
        }
        $team->delete();
        return true;
    }
}
