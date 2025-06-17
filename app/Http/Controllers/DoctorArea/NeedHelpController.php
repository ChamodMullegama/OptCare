<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use domain\Facades\DoctorArea\NeedHelpFacade;
use Illuminate\Http\Request;

class NeedHelpController extends Controller
{
   public function All()
    {
        try {
            return NeedHelpFacade::getNeedHelpRequests();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:patient_oct_analyses,id',
            ]);

            NeedHelpFacade::deleteRequest($request->id);
            return back()->with('success', 'Request deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

public function Reply(Request $request)
{
    $doctorId = session('doctor.doctorId');
    $doctorName = session('doctor.name', 'Doctor');

    NeedHelpFacade::replyRequest(
        $request->id,
        $request->reply_message,
        $doctorId,
        $doctorName
    );

    return back()->with('success', 'Reply sent successfully!');
}
}
