<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\TeamFacade;
use Illuminate\Http\Request;

class TeamController extends Controller
{
      public function All()
    {
        try {
            $teams = TeamFacade::all();
            return view('AdminArea.Pages.Team.index', compact('teams'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            TeamFacade::store($data);
            return back()->with('success', 'Team member added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            TeamFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Team member updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:teams,id',
            ]);

            TeamFacade::delete($request->id);
            return back()->with('success', 'Team member deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
