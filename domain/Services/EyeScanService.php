<?php

namespace domain\Services;

use App\Models\EyeScan;
use App\Models\EyeScanImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EyeScanService
{
    protected $eyeScan;
    protected $eyeScanImage;

    public function __construct()
    {
        $this->eyeScan = new EyeScan();
        $this->eyeScanImage = new EyeScanImage();
    }

    public function all()
    {
        return $this->eyeScan->all();
    }

    public function store(array $data)
    {
        $data['eyeScanId'] = 'ES' . Str::random(6);
        return $this->eyeScan->create($data);
    }

    public function update(array $data, $id)
    {
        $eyeScan = $this->eyeScan->findOrFail($id);
        $eyeScan->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'purpose' => $data['purpose'],
            'usage' => $data['usage'],
        ]);
        return $eyeScan;
    }

    public function delete($id)
    {
        $eyeScan = $this->eyeScan->findOrFail($id);
        $eyeScan->delete();
        return true;
    }

    public function eyeScanImageAdd(array $data)
    {
        if (!isset($data['eyeScanId']) || empty($data['eyeScanId'])) {
            throw new \Exception('eyeScanId is required for image creation.');
        }

        if (isset($data['image']) && is_string($data['image'])) {
            $data['eyeScanImageId'] = 'ESI' . Str::random(6);
        } else {
            throw new \Exception('Image path is invalid.');
        }

        return $this->eyeScanImage->create($data);
    }

    public function viewEyeScanImageAll($eyeScanId)
    {
        return $this->eyeScanImage->where('eyeScanId', $eyeScanId)->get();
    }

    public function viewEyeScanImageDelete($id)
    {
        $eyeScanImage = $this->eyeScanImage->findOrFail($id);
        if ($eyeScanImage->image && file_exists(public_path('storage/' . $eyeScanImage->image))) {
            unlink(public_path('storage/' . $eyeScanImage->image));
        }
        $eyeScanImage->delete();
        return true;
    }

    public function isPrimary($id)
    {
        $item = $this->eyeScanImage->findOrFail($id);
        if ($item->isPrimary == 0) {
            $this->eyeScanImage->where('id', '!=', $id)->update(['isPrimary' => 0]);
            $item->isPrimary = 1;
        } else {
            $item->isPrimary = 0;
        }
        $item->save();
        return $item->isPrimary ? 'Image activated successfully!' : 'Image deactivated successfully!';
    }
}
