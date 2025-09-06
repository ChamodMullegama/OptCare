<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use App\Mail\MeetingLinkMail;
use App\Models\Appointment;
use Carbon\Carbon;
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

    public function TodayAppointments()
    {
        try {
            $doctorId = Session::get('doctor.doctorId');
            $today = Carbon::today()->toDateString();
            $appointments = Appointment::where('doctorId', $doctorId)
                                       ->where('date', $today)
                                       ->orderBy('time', 'asc')
                                       ->get();
            return view('DoctorArea.Pages.Appointment.todayAppointment', compact('appointments'));
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

    // public function GenerateMeeting(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'id' => 'required|exists:appointments,id',
    //             'meeting_link' => 'required|url'
    //         ]);

    //         $doctorId = Session::get('doctor.doctorId');
    //         $appointment = Appointment::where('id', $request->id)
    //                                 ->where('doctorId', $doctorId)
    //                                 ->firstOrFail();

    //         $appointment->meeting_link = $request->meeting_link;
    //         $appointment->save();

    //         Mail::to($appointment->email)->send(new MeetingLinkMail($appointment));

    //         return redirect()->route('appointment.all')->with('success', 'Meeting link sent to the patient successfully');
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
    //     }
    // }

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

        Mail::to($appointment->email)->send(new MeetingLinkMail($appointment));

        return redirect()->route('appointment.all')->with('success', 'Meeting link sent to the patient successfully');
    } catch (\Exception $e) {
        return redirect()->route('appointment.all')->with('error', 'An error occurred: ' . $e->getMessage());
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

    // public function SendSms(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'id' => 'required|exists:appointments,id',
    //             'meeting_link' => 'required|url'
    //         ]);

    //         $doctorId = Session::get('doctor.doctorId');
    //         $appointment = Appointment::where('id', $request->id)
    //                                 ->where('doctorId', $doctorId)
    //                                 ->firstOrFail();

    //         // Update meeting link if provided
    //         if ($request->meeting_link) {
    //             $appointment->meeting_link = $request->meeting_link;
    //             $appointment->save();
    //         }

    //         $smsResult = $this->sendMeetingLinkSms($appointment);

    //         if ($smsResult['success']) {
    //             return response()->json(['success' => true, 'message' => 'SMS sent to patient successfully']);
    //         } else {
    //             return response()->json(['success' => false, 'message' => $smsResult['message']]);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    //     }
    // }

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

        // Update meeting link if provided
        if ($request->meeting_link) {
            $appointment->meeting_link = $request->meeting_link;
            $appointment->save();
        }

        $smsResult = $this->sendMeetingLinkSms($appointment);

        if ($smsResult['success']) {
            return redirect()->route('appointment.all')->with('success', 'SMS sent to patient successfully');
        } else {
            return redirect()->route('appointment.all')->with('error', $smsResult['message']);
        }
    } catch (\Exception $e) {
        return redirect()->route('appointment.all')->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

//   protected function sendMeetingLinkSms($appointment)
// {
//     try {
//         $accountSid = env('TWILIO_ACCOUNT_SID');
//         $authToken = env('TWILIO_AUTH_TOKEN');
//         $fromNumber = env('TWILIO_PHONE_NUMBER');

//         // Validate Twilio credentials
//         if (empty($accountSid) || empty($authToken) || empty($fromNumber)) {
//             return ['success' => false, 'message' => 'Twilio credentials are not properly configured'];
//         }

//         // Format the phone number to E.164 for Sri Lanka (+94)
//         $toNumber = $this->formatPhoneNumber($appointment->phone);

//         // Validate phone number format
//         if (!preg_match('/^\+94[0-9]{9}$/', $toNumber)) {
//             return ['success' => false, 'message' => 'Invalid phone number format for Sri Lanka: ' . $toNumber];
//         }

//         $client = new Client([
//             'auth' => [$accountSid, $authToken],
//             'timeout' => 30,
//         ]);

//         $message = "Dear {$appointment->name}, Your appointment is scheduled on {$appointment->date} at {$appointment->time}. Join here: {$appointment->meeting_link}";

//         $response = $client->post("https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json", [
//             'form_params' => [
//                 'To' => $toNumber,
//                 'From' => $fromNumber,
//                 'Body' => $message
//             ]
//         ]);

//         $responseData = json_decode($response->getBody(), true);

//         if ($responseData['status'] === 'failed' || $responseData['status'] === 'undelivered') {
//             return ['success' => false, 'message' => 'SMS failed to deliver: ' . ($responseData['error_message'] ?? 'Unknown error')];
//         }

//         return ['success' => true, 'message' => 'SMS sent successfully'];

//     } catch (\GuzzleHttp\Exception\ClientException $e) {
//         $response = $e->getResponse();
//         $responseBody = $response->getBody()->getContents();
//         $errorData = json_decode($responseBody, true);

//         if (isset($errorData['code']) && $errorData['code'] == 21659) {
//             return ['success' => false, 'message' => 'Twilio phone number not verified for international SMS. Please add recipient numbers to Verified Caller IDs in your Twilio console.'];
//         }

//         return ['success' => false, 'message' => 'Twilio API error: ' . ($errorData['message'] ?? $e->getMessage())];

//     } catch (\Exception $e) {
//         return ['success' => false, 'message' => 'Failed to send SMS: ' . $e->getMessage()];
//     }
// }

protected function sendMeetingLinkSms($appointment)
{
    try {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $fromNumber = env('TWILIO_PHONE_NUMBER');

        // Validate Twilio credentials
        if (empty($accountSid) || empty($authToken) || empty($fromNumber)) {
            return ['success' => false, 'message' => 'Twilio credentials are not properly configured'];
        }

        $toNumber = $this->formatPhoneNumber($appointment->phone);

        if (!preg_match('/^\+94[0-9]{9}$/', $toNumber)) {
            return ['success' => false, 'message' => 'Invalid phone number format for Sri Lanka: ' . $toNumber];
        }

        $client = new Client([
            'auth' => [$accountSid, $authToken],
            'timeout' => 30,
        ]);

        $doctorName = Session::get('doctor.name', 'Doctor');

        // Format the SMS message as requested
         $message = "Ref No:" . str_pad($appointment->id, 10, '0', STR_PAD_LEFT) .
           ", DR " . strtoupper($doctorName) .
           ", Patient:" . strtoupper($appointment->name) . " " . $appointment->phone .
           ", Date:" . $appointment->date .
           ", App No:" . $appointment->id .
           ", Time:" . $appointment->time .
           ", Please join the meeting 5 minutes before. Link: " . $appointment->meeting_link .
           " - OptCare";

        $response = $client->post("your_curl", [
            'form_params' => [
                'To' => $toNumber,
                'From' => $fromNumber,
                'Body' => $message
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($responseData['status'] === 'failed' || $responseData['status'] === 'undelivered') {
            return ['success' => false, 'message' => 'SMS failed to deliver: ' . ($responseData['error_message'] ?? 'Unknown error')];
        }

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
            $phone = '+94' . substr($phone, 1);
        } elseif (strlen($phone) === 10 && substr($phone, 0, 2) === '07') {
            $phone = '+94' . substr($phone, 1);
        } elseif (strlen($phone) === 9) {
            $phone = '+94' . $phone;
        } elseif (!preg_match('/^\+/', $phone)) {
            $phone = '+94' . $phone;
        }

        return $phone;
    }

    public function Cancel(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:appointments,id'
            ]);

            $doctorId = Session::get('doctor.doctorId');
            $appointment = Appointment::where('id', $request->id)
                                    ->where('doctorId', $doctorId)
                                    ->firstOrFail();

            if ($appointment->status === 'completed' || $appointment->status === 'canceled') {
                return back()->withErrors(['error' => 'Cannot cancel a completed or already canceled appointment']);
            }

            $appointment->status = 'canceled';
            $appointment->save();

            return redirect()->route('appointment.all')->with('success', 'Appointment canceled successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function viewAdminAppointments()
    {
        try {
            $appointments = Appointment::with('doctor')->get();
            return view('AdminArea.Pages.Appointment.index', compact('appointments'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
