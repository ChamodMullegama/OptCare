<?php

namespace domain\Services\AdminArea;

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

    public function all()
    {
        return $this->subscription->all();
    }

    public function store(array $data)
    {
        $data['subscriptionId'] = 'SUB' . Str::random(6);
        return $this->subscription->create($data);
    }

    public function delete($id)
    {
        $subscription = $this->subscription->findOrFail($id);
        $subscription->delete();
        return true;
    }

    public function sendBroadcast($subject, $message)
    {
        $subscribers = $this->subscription->all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new SubscriptionBroadcast($subject, $message));
        }
        return $subscribers;
    }

    // In SubscriptionService.php
// public function sendBroadcast($subject, $message)
// {
//     $subscribers = $this->subscription->all();

//     foreach ($subscribers as $subscriber) {
//         Mail::to($subscriber->email)
//             ->queue(new SubscriptionBroadcast($subject, $message));
//     }

//     return true;
// }
}
