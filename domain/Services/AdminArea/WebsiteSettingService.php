<?php

namespace domain\Services\AdminArea;

use App\Models\WebsiteSetting;
use Illuminate\Support\Str;

class WebsiteSettingService
{
    protected $websiteSetting;

    public function __construct()
    {
        $this->websiteSetting = new WebsiteSetting();
    }

    public function all()
    {
        return $this->websiteSetting->first();
    }

    public function store(array $data)
    {
        if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            $data['rcode'] = 'WS' . Str::random(6);
            $data['logo'] = $data['logo']->store('uploads/settings', 'public');
        }
        return $this->websiteSetting->create($data);
    }

    public function update(array $data)
    {
        $settings = $this->websiteSetting->first();
        if (!$settings) {
            throw new \Exception('No settings record found.');
        }

        if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            if ($settings->logo && file_exists(public_path('uploads/' . $settings->logo))) {
                unlink(public_path('uploads/' . $settings->logo));
            }
            $data['logo'] = $data['logo']->store('uploads/settings', 'public');
        } else {
            $data['logo'] = $settings->logo;
        }

        $settings->fill($data)->save();
        return $settings;
    }
}
