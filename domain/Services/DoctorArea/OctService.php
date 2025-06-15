<?php

namespace App\Domain\Service\DoctorArea;

use App\Models\OctAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DoctorAreaOCTService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'verify' => false // Only for development, remove in production
        ]);
    }

    // public function showPatients()
    // {
    //     try {
    //         $patients = OctAnalysis::select('patient_id', 'patient_name', 'patient_email', 'patient_phone', 'patient_age')
    //             ->groupBy('patient_id', 'patient_name', 'patient_email', 'patient_phone', 'patient_age')
    //             ->orderBy('patient_name')
    //             ->paginate(10);
    //         return view('DoctorArea.Pages.Oct.patients', compact('patients'));
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    //     }
    // }

 public function showPatients()
    {
        try {
            $doctorId = session('doctor.doctorId'); // Get the current doctor's ID

            $patients = OctAnalysis::where('doctor_id', $doctorId)
                ->select('patient_id', 'patient_name', 'patient_email', 'patient_phone', 'patient_age')
                ->groupBy('patient_id', 'patient_name', 'patient_email', 'patient_phone', 'patient_age')
                ->orderBy('patient_name')
                ->paginate(10);

            return view('DoctorArea.Pages.Oct.patients', compact('patients'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function showUploadForm(Request $request)
    {
        try {
            $patient = null;
            if ($request->has('patient_id')) {
                $patient = OctAnalysis::where('patient_id', $request->patient_id)
                    ->select('patient_id', 'patient_name', 'patient_email', 'patient_phone', 'patient_age')
                    ->first();
            }

            $query = OctAnalysis::where('doctor_id', session('doctor.doctorId'));
            if ($request->has('patient_id')) {
                $query->where('patient_id', $request->patient_id);
            }
            $analyses = $query->orderBy('created_at', 'desc')->paginate(10);

            return view('DoctorArea.Pages.Oct.index', compact('patient', 'analyses'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    // public function uploadAndPredict(Request $request)
    // {
    //     try {
    //         $validationRules = [
    //             'patient_id' => 'required|string|max:255',
    //             'patient_name' => 'required|string|max:255',
    //             'patient_email' => [
    //                 'nullable',
    //                 'email',
    //                 'max:255',
    //                 Rule::unique('oct_analyses', 'patient_email')->where(function ($query) use ($request) {
    //                     return $query->where('patient_id', '!=', $request->patient_id);
    //                 }),
    //             ],
    //             'patient_phone' => 'nullable|string|max:20',
    //             'patient_age' => 'nullable|integer|min:1|max:100',
    //             'eye_side' => 'required|in:left,right,both',
    //             'clinical_notes' => 'nullable|string',
    //             'image_left' => [
    //                 'required_if:eye_side,left,both',
    //                 'image',
    //                 'mimes:jpeg,png,jpg',
    //                 'max:10240'
    //             ],
    //             'image_right' => [
    //                 'required_if:eye_side,right,both',
    //                 'image',
    //                 'mimes:jpeg,png,jpg',
    //                 'max:10240'
    //             ],
    //         ];

    //         $request->validate($validationRules);

    //         $predictions = [];
    //         $imagePaths = [];

    //         // Process left eye if required
    //         if ($request->eye_side === 'left' || $request->eye_side === 'both') {
    //             $leftImagePath = $request->file('image_left')->store('oct-scans', 'public');
    //             $imagePaths[] = $leftImagePath;

    //             $response = $this->client->request('POST', 'http://localhost:5000/predict', [
    //                 'multipart' => [
    //                     [
    //                         'name' => 'image',
    //                         'contents' => fopen(storage_path("app/public/{$leftImagePath}"), 'r'),
    //                         'filename' => 'oct_scan-left.jpg'
    //                     ]
    //                 ]
    //             ]);

    //             $result = json_decode($response->getBody(), true);
    //             if (isset($result['error'])) {
    //                 throw new \Exception("Left eye analysis failed: {$result['error']}");
    //             }

    //             $predictions['left'] = [
    //                 'prediction' => $result['prediction'] ?? 'Unknown',
    //                 'recommendation' => ucfirst($result['recommendation']) ?? 'No recommendations available',
    //                 'image' => $leftImagePath
    //             ];

    //             // Save left eye analysis
    //             OctAnalysis::create([
    //                 'patient_id' => $request->patient_id,
    //                 'doctor_id' => session('doctor.doctorId'),
    //                 'doctor_name' => session('doctor.name'),
    //                 'patient_name' => $request->patient_name,
    //                 'patient_email' => $request->patient_email,
    //                 'patient_phone' => $request->patient_phone,
    //                 'patient_age' => $request->patient_age,
    //                 'eye_side' => 'left',
    //                 'clinical_notes' => $request->clinical_notes,
    //                 'image_path' => $leftImagePath,
    //                 'prediction' => $result['prediction'] ?? 'Unknown',
    //                 'recommendation' => $result['recommendation'] ?? 'No recommendations available',
    //             ]);
    //         }

    //         // Process right eye if required
    //         if ($request->eye_side === 'right' || $request->eye_side === 'both') {
    //             $rightImagePath = $request->file('image_right')->store('oct-scans', 'public');
    //             $imagePaths[] = $rightImagePath;

    //             $response = $this->client->request('POST', 'http://localhost:5000/predict', [
    //                 'multipart' => [
    //                     [
    //                         'name' => 'image',
    //                         'contents' => fopen(storage_path("app/public/{$rightImagePath}"), 'r'),
    //                         'filename' => 'oct_scan-right.jpg'
    //                     ]
    //                 ]
    //             ]);

    //             $result = json_decode($response->getBody(), true);
    //             if (isset($result['error'])) {
    //                 throw new \Exception("Right eye analysis failed: {$result['error']}");
    //             }

    //             $predictions['right'] = [
    //                 'prediction' => $result['prediction'] ?? 'Unknown',
    //                 'recommendation' => $result['recommendation'] ?? 'No recommendations available',
    //                 'image' => $rightImagePath ];

    //             // Save right eye analysis
    //             OctAnalysis::create([
    //                 'patient_id' => $request->patient_id,
    //                 'doctor_id' => session('doctor.doctorId'),
    //                 'doctor_name' => session('doctor.name'),
    //                 'patient_name' => $request->patient_name,
    //                 'patient_email' => $request->patient_email,
    //                 'patient_phone' => $request->patient_phone,
    //                 'patient_age' => $request->patient_age,
    //                 'eye_side' => 'right',
    //                 'clinical_notes' => $request->clinical_notes,
    //                 'image_path' => $rightImagePath,
    //                 'prediction' => $result['prediction'] ?? 'Unknown',
    //                 'recommendation' => $result['recommendation'] ?? 'No recommendations available',
    //             ]);
    //         }

    //         return back()
    //             ->with('success', 'Analysis completed successfully')
    //             ->with('predictions', $predictions);
    //     } catch (\Exception $e) {
    //         $errorMessage = 'Analysis failed: ' . $e->getMessage();

    //         // Optionally delete uploaded images if analysis fails
    //         // foreach ($imagePaths as $path) {
    //         //     Storage::disk('public')->delete($path);
    //         // }

    //         return back()->with('error', $errorMessage);
    //     }
    // }



    public function uploadAndPredict(Request $request)
    {
        try {
            $doctorId = session('doctor.doctorId');

            $validationRules = [
                'patient_id' => 'required|string|max:255',
                'patient_name' => 'required|string|max:255',
                'patient_email' => [
                    'nullable',
                    'email',
                    'max:255',
                    Rule::unique('oct_analyses', 'patient_email')->where(function ($query) use ($request, $doctorId) {
                        return $query->where('doctor_id', $doctorId)
                                     ->where('patient_id', '!=', $request->patient_id);
                    }),
                ],
                'patient_phone' => 'nullable|string|max:20',
                'patient_age' => 'nullable|integer|min:1|max:100',
                'eye_side' => 'required|in:left,right,both',
                'clinical_notes' => 'nullable|string',
                'image_left' => [
                    'required_if:eye_side,left,both',
                    'image',
                    'mimes:jpeg,png,jpg',
                    'max:10240'
                ],
                'image_right' => [
                    'required_if:eye_side,right,both',
                    'image',
                    'mimes:jpeg,png,jpg',
                    'max:10240'
                ],
            ];

            $request->validate($validationRules);

            $predictions = [];
            $imagePaths = [];

            // Process left eye if required
            if ($request->eye_side === 'left' || $request->eye_side === 'both') {
                $leftImagePath = $request->file('image_left')->store('oct-scans', 'public');
                $imagePaths[] = $leftImagePath;

                $response = $this->client->request('POST', 'http://localhost:5000/predict', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(storage_path("app/public/{$leftImagePath}"), 'r'),
                            'filename' => 'oct_scan-left.jpg'
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody(), true);
                if (isset($result['error'])) {
                    throw new \Exception("Left eye analysis failed: {$result['error']}");
                }

                $predictions['left'] = [
                    'prediction' => $result['prediction'] ?? 'Unknown',
                    'recommendation' => ucfirst($result['recommendation']) ?? 'No recommendations available',
                    'image' => $leftImagePath
                ];

                // Save left eye analysis
                OctAnalysis::create([
                    'patient_id' => $request->patient_id,
                    'doctor_id' => $doctorId,
                    'doctor_name' => session('doctor.name'),
                    'patient_name' => $request->patient_name,
                    'patient_email' => $request->patient_email,
                    'patient_phone' => $request->patient_phone,
                    'patient_age' => $request->patient_age,
                    'eye_side' => 'left',
                    'clinical_notes' => $request->patient_clinical_notes,
                    'image_path' => $leftImagePath,
                    'prediction' => $result['prediction'] ?? 'Unknown',
                    'recommendation' => $result['recommendation'] ?? 'No recommendations available',
                ]);
            }

            // Process right eye if required
            if ($request->eye_side === 'right' || $request->eye_side === 'both') {
                $rightImagePath = $request->file('image_right')->store('oct-scans', 'public');
                $imagePaths[] = $rightImagePath;

                $response = $this->client->request('POST', 'http://localhost:5000/predict', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(storage_path("app/public/{$rightImagePath}"), 'r'),
                            'filename' => 'oct_scan-right.jpg'
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody(), true);
                if (isset($result['error'])) {
                    throw new \Exception("Right eye analysis failed: {$result['error']}");
                }

                $predictions['right'] = [
                    'prediction' => $result['prediction'] ?? 'Unknown',
                    'recommendation' => ucfirst($result['recommendation']) ?? 'No recommendations available',
                    'image' => $rightImagePath
                ];

                // Save right eye analysis
                OctAnalysis::create([
                    'patient_id' => $request->patient_id,
                    'doctor_id' => $doctorId,
                    'doctor_name' => session('doctor.name'),
                    'patient_name' => $request->patient_name,
                    'patient_email' => $request->patient_email,
                    'patient_phone' => $request->patient_phone,
                    'patient_age' => $request->patient_age,
                    'eye_side' => 'right',
                    'clinical_notes' => $request->clinical_notes,
                    'image_path' => $rightImagePath,
                    'prediction' => $result['prediction'] ?? 'Unknown',
                    'recommendation' => $result['recommendation'] ?? 'No recommendations available',
                ]);
            }

            return back()
                ->with('success', 'Analysis completed successfully')
                ->with('predictions', $predictions);
        } catch (\Exception $e) {
            $errorMessage = 'Analysis failed: ' . $e->getMessage();

            // Delete uploaded images if analysis fails
            foreach ($imagePaths as $path) {
                Storage::disk('public')->delete($path);
            }

            return back()->with('error', $errorMessage);
        }
    }

    public function viewAnalysis($id)
    {
        $analysis = OctAnalysis::where('doctor_id', session('doctor.doctorId'))->findOrFail($id);
        return view('DoctorArea.Pages.Oct.view', compact('analysis'));
    }

    public function downloadAnalysis($id)
    {
        try {
            $analysis = OctAnalysis::where('doctor_id', session('doctor.doctorId'))->findOrFail($id);

            // Load the PDF view
            $pdf = Pdf::loadView('DoctorArea.Pages.Oct.oct_analysis_pdf', compact('analysis'));

            // Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');

            // Stream the PDF for download
            return $pdf->download('oct_analysis_' . $analysis->patient_id . '_' . $analysis->id . '_' . time() . '.pdf');
        } catch (\Exception $e) {
            return redirect()->with('back')->back()->with('error', 'Failed to generate PDF report: ' . $e->getMessage());
        }
    }

    public function deleteAnalysis($id)
    {
        try {
            $analysis = OctAnalysis::where('doctor_id', session('doctor.doctorId'))->findOrFail($id);
            $patientId = $analysis->patient_id; // Store patient_id for redirect
            // Delete image if it exists
            if (Storage::disk('public')->exists($analysis->image_path)) {
                Storage::disk('public')->delete($analysis->image_path);
            }

            // Delete the analysis record
            $analysis->delete();

            return redirect()->route('oct.upload', ['patient_id' => $patientId])
                ->with('success', 'Analysis deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('oct.upload')
                ->with('error', 'Failed to delete analysis: ' . $e->getMessage());
        }
    }

    public function deleteMainAnalysis($id)
    {
        try {
            $analysis = OctAnalysis::findOrFail($id);

            // Delete image if it exists
            if (Storage::disk('public')->exists($analysis->image_path)) {
                Storage::disk('public')->delete($analysis->image_path);
            }

            // Delete the analysis record
            $analysis->delete();

            return back()->with('success', 'Analysis deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
