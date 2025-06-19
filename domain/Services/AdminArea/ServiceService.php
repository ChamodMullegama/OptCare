<?php

namespace domain\Services\AdminArea;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Support\Str;

class ServiceService
{
    protected $service;
    protected $serviceImage;

    public function __construct()
    {
        $this->service = new Service();
        $this->serviceImage = new ServiceImage();
    }

    public function all()
    {
        return $this->service->all();
    }

    public function store(array $data)
    {
        $data['serviceId'] = 'SV' . Str::random(6);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('uploads/services', 'public');
        } else {
            $data['image'] = null;
        }

        return $this->service->create($data);
    }

    public function update(array $data, $id)
    {
        $service = $this->service->find($id);
        if (!$service) {
            throw new \Exception('Service not found.');
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($service->image && file_exists(public_path('uploads/' . $service->image))) {
                unlink(public_path('uploads/' . $service->image));
            }
            $data['image'] = $data['image']->store('uploads/services', 'public');
        } else {
            $data['image'] = $service->image;
        }

        $service->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
        ]);

        return $service;
    }

    public function delete($id)
    {
        $service = $this->service->findOrFail($id);
        if ($service->image && file_exists(public_path('uploads/' . $service->image))) {
            unlink(public_path('uploads/' . $service->image));
        }
        $service->delete();
        return true;
    }


    public function serviceImageAdd(array $data)
    {
        // Validate that blogId is present
        if (!isset($data['serviceId']) || empty($data['serviceId'])) {
            throw new \Exception('serviceId is required for blog image creation.');
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['serviceImageId'] = 'SI' . Str::random(6);
            $data['image'] = $data['image']->store('uploads/service', 'public');
        } else {
            throw new \Exception('Image file is required or invalid.');
        }

        // Ensure blogId is included in the data for creation
        return $this->serviceImage->create($data);
    }


    public function viewServiceImageAll($serviceId)
    {
        return $this->serviceImage->where('serviceId', $serviceId)->get();
    }

    public function viewServiceImageDelete($id)
    {
        $serviceImage = $this->serviceImage->findOrFail($id);
        if ($serviceImage->image && file_exists(public_path('uploads/' . $serviceImage->image))) {
            unlink(public_path('uploads/' . $serviceImage->image));
        }
        $serviceImage->delete();
        return true;
    }

    public function isPrimary($id)
    {
        $item = $this->serviceImage->findOrFail($id);
        if ($item->isPrimary == 0) {
            $this->serviceImage->where('id', '!=', $id)->update(['isPrimary' => 0]);
            $item->isPrimary = 1;
        } else {
            $item->isPrimary = 0;
        }
        $item->save();
        return $item;
    }

   public function allForPublic()
{
    return Service::with(['images' => function($query) {
        $query->where('isPrimary', 1)->orWhere('isPrimary', 0);
    }])->orderBy('created_at', 'desc')->get();
}
}
