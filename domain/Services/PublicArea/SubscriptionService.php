<?php

namespace domain\Services\PublicArea;

use App\Models\Subscription;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionBroadcast;

class SubscriptionService
{
    protected $subscription;

    public function __construct()
    {
        $this->subscription = new Subscription();
    }

    public function store(array $data)
    {
        $data['subscriptionId'] = 'SUB' . Str::random(6);
        return $this->subscription->create($data);
    }

}
