<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use App\Mail\MeetingLinkMail;
use App\Models\Appointment;
use domain\Facades\DoctorArea\Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class AppointmentController extends Controller
{
      public function All()
    {
        try {
            $doctorId = Session::get('doctor.doctorId');
            $appointments = Appointment::where('doctorId', $doctorId)->get();
            return view('DoctorArea.Pages.Appointment.index', compact('appointments'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:appointments,id'
            ]);

            $doctorId = Session::get('doctor.doctorId');
            $appointment = Appointment::where('id', $request->id)
                                    ->where('doctorId', $doctorId)
                                    ->firstOrFail();

            $appointment->delete();
            return redirect()->route('appointment.all')->with('success', 'Appointment deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Accept(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:appointments,id'
            ]);

            $doctorId = Session::get('doctor.doctorId');
            $appointment = Appointment::where('id', $request->id)
                                    ->where('doctorId', $doctorId)
                                    ->firstOrFail();

            $appointment->status = 'accepted';
            $appointment->save();

            return redirect()->route('appointment.all')->with('success', 'Appointment accepted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function GenerateMeeting(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:appointments,id',
                'meeting_link' => 'required|url'
            ]);

            $doctorId = Session::get('doctor.doctorId');
            $appointment = Appointment::where('id', $request->id)
                                    ->where('doctorId', $doctorId)
                                    ->firstOrFail();

            $appointment->meeting_link = $request->meeting_link;
            $appointment->save();

            // Check if email should be sent
            if ($request->has('send_email')) {
                Mail::to($appointment->email)->send(new MeetingLinkMail($appointment));
            }

            return response()->json(['success' => true, 'message' => 'Meeting link saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


     public function Complete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:appointments,id'
            ]);

            $doctorId = Session::get('doctor.doctorId');
            $appointment = Appointment::where('id', $request->id)
                                    ->where('doctorId', $doctorId)
                                    ->firstOrFail();

            $appointment->status = 'completed';
            $appointment->save();

            return redirect()->route('appointment.all')->with('success', 'Appointment marked as completed');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

 public function SendSms(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|exists:appointments,id',
            'meeting_link' => 'required|url'
        ]);

        $doctorId = Session::get('doctor.doctorId');
        $appointment = Appointment::where('id', $request->id)
                                ->where('doctorId', $doctorId)
                                ->firstOrFail();

        $smsResult = $this->sendMeetingLinkSms($appointment);

        if ($smsResult['success']) {
            return redirect()->route('appointment.all')->with('success', 'SMS sent successfully');
        } else {
            return redirect()->route('appointment.all')->withErrors(['error' => $smsResult['message']]);
        }
    } catch (\Exception $e) {
        return redirect()->route('appointment.all')->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

    protected function sendMeetingLinkSms($appointment)
    {
        try {
            $accountSid = env('TWILIO_ACCOUNT_SID');
            $authToken = env('TWILIO_AUTH_TOKEN');
            $fromNumber = env('TWILIO_PHONE_NUMBER');

            // Format the phone number to E.164 for Sri Lanka (+94)
            $toNumber = $this->formatPhoneNumber($appointment->phone);

            $client = new Client([
                'auth' => [$accountSid, $authToken]
            ]);

            $message = "Dear {$appointment->name}, Your appointment is scheduled on {$appointment->date} at {$appointment->time}. Join here: {$appointment->meeting_link}";

            $response = $client->post("add_your_api", [
                'form_params' => [
                    'To' => $toNumber,
                    'From' => $fromNumber,
                    'Body' => $message
                ]
            ]);

            return ['success' => true, 'message' => 'SMS sent successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to send SMS: ' . $e->getMessage()];
        }
    }

    protected function formatPhoneNumber($phone)
    {
        // Remove any non-digit characters
        $phone = preg_replace('/\D/', '', $phone);

        // Handle Sri Lankan numbers (+94)
        if (strlen($phone) === 9 && substr($phone, 0, 1) === '0') {
            $phone = '+94' . substr($phone, 1); // Remove leading 0 and add +94
        } elseif (strlen($phone) === 10 && substr($phone, 0, 2) === '07') {
            $phone = '+94' . substr($phone, 1); // Remove leading 07 and add +94
        } elseif (strlen($phone) === 9) {
            $phone = '+94' . $phone; // Add +94 for 9-digit numbers
        } elseif (!preg_match('/^\+/', $phone)) {
            $phone = '+94' . $phone; // Default to +94 if no country code
        }

        return $phone;
    }
}
