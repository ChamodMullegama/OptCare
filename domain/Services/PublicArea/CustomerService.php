<?php

namespace domain\Services\PublicArea;

use App\Mail\OtpMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CustomerService
{
  protected $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['age'] = $this->calculateAge($data['birth_date']);
        $data['otp'] = rand(100000, 999999);
        $data['otp_expires_at'] = Carbon::now()->addMinutes(10);
        $data['verified_account'] = 0; // Default to unverified

        $customer = $this->customer->create($data);

        // Log before sending email
        \Log::info('Attempting to send OTP to email: ' . $customer->email . ' with OTP: ' . $customer->otp);

        // Send OTP via custom email template with error handling
        try {
            Mail::to($customer->email)->send(new OtpMail($customer->otp, $customer->email));
            \Log::info('OTP email sent successfully to: ' . $customer->email);
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email to ' . $customer->email . ': ' . $e->getMessage());
            // Fallback: Store OTP in session for manual verification if email fails
            Session::flash('otp_fallback', $customer->otp);
        }

        return $customer;
    }

    public function verifyOtp($email, $otp)
    {
        $customer = $this->customer->where('email', $email)->first();
        $fallbackOtp = Session::get('otp_fallback');
        if ($customer && ($customer->otp == $otp || $fallbackOtp == $otp) && Carbon::now()->lt($customer->otp_expires_at)) {
            $customer->otp = null;
            $customer->otp_expires_at = null;
            $customer->verified_account = 1; // Mark as verified
            $customer->save();
            Session::forget('otp_fallback');
            return $customer;
        }
        return null;
    }

    public function login($email, $password)
    {
        $customer = $this->customer->where('email', $email)->first();
        if ($customer && Hash::check($password, $customer->password) && $customer->verified_account) {
            return $customer;
        }
        return null;
    }

    private function calculateAge($birthDate)
    {
        return Carbon::parse($birthDate)->age;
    }
}
