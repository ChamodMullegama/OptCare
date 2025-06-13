<?php

namespace domain\Services\PublicArea;

use App\Models\CustomerMessage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerMessageReply;

class CustomerMessageService
{
    protected $message;

    public function __construct()
    {
        $this->message = new CustomerMessage();
    }

    public function all()
    {
        return $this->message->all();
    }

    public function store(array $data)
    {
        $data['messageId'] = 'MSG' . Str::random(6);
        return $this->message->create($data);
    }

    public function delete($id)
    {
        $message = $this->message->findOrFail($id);
        $message->delete();
        return true;
    }

    public function reply($id, $replyMessage)
    {
        $message = $this->message->findOrFail($id);
        $message->update([
            'reply_message' => $replyMessage,
            'replied_at' => now(),
        ]);

        // Send email to customer
        Mail::to($message->email)->send(new CustomerMessageReply($message, $replyMessage));

        return $message;
    }
}
