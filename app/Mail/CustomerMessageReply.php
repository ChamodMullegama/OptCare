<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerMessageReply extends Mailable
{
   use Queueable, SerializesModels;

    public $message;
    public $reply;

    public function __construct($message, $reply)
    {
        $this->message = $message;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Reply to Your Message: ' . $this->message->subject)
                    ->markdown('emails.customer_message_reply')
                    ->with([
                        'customerName' => $this->message->name,
                        'originalMessage' => $this->message->message,
                        'replyMessage' => $this->reply,
                    ]);
    }
}
