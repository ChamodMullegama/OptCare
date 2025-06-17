<?php

namespace domain\Services\DoctorArea;

use App\Mail\NeedHelpReply;
use App\Models\PatientOctAnalysis;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class NeedHelpService
{
   protected $analysis;

    public function __construct()
    {
        $this->analysis = new PatientOctAnalysis();
    }

    public function getNeedHelpRequests()
    {
        try {
            $requests = $this->analysis->where('need_help', 1)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('DoctorArea.Pages.oct.responseCustomerOctAnalysis', compact('requests'));
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch requests: ' . $e->getMessage());
        }
    }

    public function deleteRequest($id)
    {
        try {
            $request = $this->analysis->where('need_help', 1)
                ->where('id', $id)
                ->firstOrFail();

            // Delete image if it exists
            if (Storage::disk('public')->exists($request->image_path)) {
                Storage::disk('public')->delete($request->image_path);
            }

            // Delete the record
            $request->delete();

            return true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Exception('Request not found');
        } catch (\Exception $e) {
            throw new \Exception('Failed to delete request: ' . $e->getMessage());
        }
    }

   public function replyRequest($id, $replyMessage,$doctorId,$doctorName)
    {
        $request = PatientOctAnalysis::findOrFail($id);

          $request->update([
        'reply_message' => strip_tags($replyMessage),
        'replied_by_doctor_id' => $doctorId,
        'replied_by_doctor_name' => $doctorName,
        'need_help' => 0,
        'replied_at' => now(),
    ]);


        // Send email notification
        if ($request->customer_email) {
            Mail::to($request->customer_email)->send(new NeedHelpReply($request));
        }
    }

}
