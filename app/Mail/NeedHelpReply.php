<?php

namespace App\Mail;

use App\Models\PatientOctAnalysis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NeedHelpReply extends Mailable
{
  use Queueable, SerializesModels;

    public $request;

    public function __construct(PatientOctAnalysis $request)
    {
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('Reply to Your OCT Analysis Request')
                    ->view('emails.need_help_reply')
                    ->with([
                        'replyMessage' => $this->request->reply_message,
                        'prediction' => $this->request->prediction,
                        'recommendation' => $this->request->recommendation,
                        'doctorName' => $this->request->replied_by_doctor_name ?? 'Doctor',
                        'doctorId' => $this->request->replied_by_doctor_id ?? '',
                        'repliedAt' => $this->request->replied_at?->format('F j, Y \a\t H:i') ?? 'Just now'

                    ]);
    }
}
