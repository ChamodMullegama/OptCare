<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingLinkMail extends Mailable
{
  use Queueable, SerializesModels;

    public $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Your Appointment Meeting Link')
                    ->view('emails.meeting_link')
                    ->with([
                        'patientName' => $this->appointment->name,
                        'meetingLink' => $this->appointment->meeting_link,
                        'date' => $this->appointment->date,
                        'time' => $this->appointment->time,
                    ]);
    }
}
