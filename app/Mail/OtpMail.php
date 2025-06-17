<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
   use Queueable, SerializesModels;

    public $otp;
    public $email;

    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')
                    ->view('emails.otp')
                    ->with([
                        'subjectText' => 'Email Verification OTP',
                        'messageBody' => "Your OTP for email verification is: {$this->otp}. This OTP is valid for 10 minutes. Please do not share it with anyone.\n\nIf you did not request this, please ignore this email or contact support.",
                    ]);
    }
}
