<?php

namespace domain\Services;

use App\Models\EyeIssue;
use App\Models\EyeIssueImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EyeIssueService
{
    protected $eyeIssue;
    protected $eyeIssueImage;

    public function __construct()
    {
        $this->eyeIssue = new EyeIssue();
        $this->eyeIssueImage = new EyeIssueImage();
    }

    public function getAll()
    {
        return $this->eyeIssue->all();
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:eye_issues,name',
            'description' => 'required|string',
            'symptoms' => 'required|string',
            'causes' => 'required|string',
            'treatments' => 'required|string',
        ], [
            'name.unique' => 'The eye issue name must be unique. Please choose another name.',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $data['eyeIssueId'] = 'EI' . Str::random(6);
        return $this->eyeIssue->create($data);
    }

    public function update($id, array $data)
    {
        $eyeIssue = $this->eyeIssue->findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:eye_issues,name,' . $eyeIssue->id,
            'description' => 'required|string',
            'symptoms' => 'required|string',
            'causes' => 'required|string',
            'treatments' => 'required|string',
        ], [
            'name.unique' => 'The eye issue name must be unique. Please choose another name.',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $eyeIssue->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'symptoms' => $data['symptoms'],
            'causes' => $data['causes'],
            'treatments' => $data['treatments'],
        ]);

        return $eyeIssue;
    }

    public function delete($id)
    {
        $eyeIssue = $this->eyeIssue->findOrFail($id);
        $eyeIssue->delete();
        return true;
    }

    public function addImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eyeIssueId' => 'required|exists:eye_issues,eyeIssueId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $data = $request->all();
        $data['eyeIssueImageId'] = 'EII' . Str::random(6);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/eye_issues', 'public');
            $data['image'] = $path;
        }

        return $this->eyeIssueImage->create($data);
    }

    public function getImages($eyeIssueId)
    {
        return $this->eyeIssueImage->where('eyeIssueId', $eyeIssueId)->get();
    }

    public function deleteImage($id)
    {
        $eyeIssueImage = $this->eyeIssueImage->findOrFail($id);
        if ($eyeIssueImage->image && file_exists(public_path('storage/' . $eyeIssueImage->image))) {
            unlink(public_path('storage/' . $eyeIssueImage->image));
        }
        $eyeIssueImage->delete();
        return true;
    }

    public function setPrimary($id)
    {
        $item = $this->eyeIssueImage->findOrFail($id);
        if ($item->isPrimary == 0) {
            $this->eyeIssueImage->where('id', '!=', $id)->update(['isPrimary' => 0]);
            $item->isPrimary = 1;
        } else {
            $item->isPrimary = 0;
        }
        $item->save();
        return $item->isPrimary ? 'Image activated successfully!' : 'Image deactivated successfully!';
    }
}
