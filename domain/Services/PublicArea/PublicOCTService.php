<?php

namespace domain\Services\PublicArea;

use App\Models\PatientOctAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicOCTService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'verify' => false, // Remove in production
        ]);
    }

    public function showUploadForm()
    {
        try {
            return view('PublicArea.Pages.Oct.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    // public function analyzeOct(Request $request)
    // {
    //     try {
    //         // Check if user is logged in
    //         $userId = session('customer_id');
    //           $customerEmail = session('customer_email');
    //         if (!$userId) {
    //             return redirect()->route('login')->withErrors('error', 'Please log in to upload an OCT scan');
    //         }

    //         // Validate the image
    //         $request->validate([
    //             'oct_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Max 10MB
    //         ]);

    //         // Store the image
    //         $imagePath = $request->file('oct_image')->store('oct-scans', 'public');

    //         // Call the prediction API
    //         $response = $this->client->post('http://localhost:5000/predict', [
    //             'multipart' => [
    //                 [
    //                     'name' => 'image',
    //                     'contents' => fopen(storage_path("app/public/{$imagePath}"), 'r'),
    //                     'filename' => 'oct_scan.jpg',
    //                 ],
    //             ],
    //         ]);

    //         $result = json_decode($response->getBody(), true);
    //         if (isset($result['error'])) {
    //             Storage::disk('public')->delete($imagePath);
    //             throw new \Exception("Analysis failed: {$result['error']}");
    //         }

    //         // Save to patient_oct_analyses table
    //         $analysis = PatientOctAnalysis::create([
    //             'user_id' => $userId,
    //             'customer_email' => $customerEmail,
    //             'image_path' => $imagePath,
    //             'prediction' => $result['prediction'] ?? 'Unknown',
    //             'recommendation' => $result['recommendation'] ?? 'No recommendations available',
    //         ]);

    //         // Return success with predictions and image path
    //         return redirect()->back()->with([
    //             'success' => 'OCT scan analysis completed and saved',
    //             'prediction' => $result['prediction'] ?? 'Unknown',
    //             'recommendation' => $result['recommendation'] ?? 'No recommendations available',
    //             'image_path' => $imagePath,
    //         ]);
    //     } catch (\Exception $e) {
    //         // Delete the image if analysis fails
    //         if (isset($imagePath)) {
    //             Storage::disk('public')->delete($imagePath);
    //         }

    //         return redirect()->back()->with('error', 'Failed to process OCT scan: ' . $e->getMessage());
    //     }
    // }

    public function analyzeOct(Request $request)
{
    try {
        // Check if user is logged in
        $userId = session('customer_id');
        $customerEmail = session('customer_email');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in to the system to upload your OCT scan.');
        }

        // Validate the image
        $request->validate([
            'oct_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Max 10MB
        ]);

        // Store the image
        $imagePath = $request->file('oct_image')->store('oct-scans', 'public');

        // Initialize HTTP client
        $client = new \GuzzleHttp\Client([
            'timeout' => 30,
            'verify' => false // Only for development, remove in production
        ]);

        // Call the prediction API
        $response = $client->post('http://localhost:5000/predict', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen(storage_path("app/public/{$imagePath}"), 'r'),
                    'filename' => 'oct_scan.jpg',
                ],
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        // Check if the image is not an OCT scan
        if (isset($result['error']) && str_contains($result['error'], 'does not appear to be an OCT scan')) {
            // Delete the uploaded image
            Storage::disk('public')->delete($imagePath);

            // Return clean error message without technical details
            return redirect()->back()->with('error', 'The provided image is not an OCT scan. Please upload a valid OCT scan image.');
        }

        if (isset($result['error'])) {
            Storage::disk('public')->delete($imagePath);
            throw new \Exception("Analysis failed: {$result['error']}");
        }

        // Save to patient_oct_analyses table
        $analysis = PatientOctAnalysis::create([
            'user_id' => $userId,
            'customer_email' => $customerEmail,
            'image_path' => $imagePath,
            'prediction' => $result['prediction'] ?? 'Unknown',
            'recommendation' => $result['recommendation'] ?? 'No recommendations available',
            'is_oct_confidence' => $result['is_oct_confidence'] ?? 1.0,
        ]);

        // Return success with predictions and image path
        return redirect()->back()->with([
            'success' => 'OCT scan analysis completed and saved',
            'prediction' => $result['prediction'] ?? 'Unknown',
            'recommendation' => $result['recommendation'] ?? 'No recommendations available',
            'image_path' => $imagePath,
            'is_oct_confidence' => $result['is_oct_confidence'] ?? 1.0,
        ]);
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        // Handle 400 Bad Request errors specifically
        $response = $e->getResponse();
        $responseBody = $response->getBody()->getContents();
        $result = json_decode($responseBody, true);

        // Delete the uploaded image
        if (isset($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        // Check if it's an OCT detection error
        if (isset($result['error']) && str_contains($result['error'], 'does not appear to be an OCT scan')) {
            return redirect()->back()->with('error', 'The provided image is not an OCT scan. Please upload a valid OCT scan image.');
        }

        return redirect()->back()->with('error', 'Failed to process OCT scan: ' . $e->getMessage());
    } catch (\Exception $e) {
        // Delete the image if analysis fails
        if (isset($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->back()->with('error', 'Failed to process OCT scan. Please try again.');
    }
}

    public function downloadAnalysis(Request $request)
    {
        try {
            // Validate input data
            $request->validate([
                'image_path' => 'required|string',
                'prediction' => 'required|string',
                'recommendation' => 'nullable|string',
                'customer_email' => 'nullable|string',
            ]);

            // Prepare data for the report
            $data = [
                'patient_info' => [
                    'report_id' => 'OCT' . Str::random(8),
                    'generated_at' => now()->format('F j, Y g:i A'),
                    'analysis_type' => 'AI-Powered OCT Analysis',
                ],
                'analysis_date' => now()->format('F j, Y'),
                'prediction' => $request->input('prediction'),
                'recommendation' => $request->input('recommendation'),
                'customer_email' => $request->input('customer_email'),
                'image_exists' => true,
                'image_full_path' => storage_path('app/public/' . $request->input('image_path')),
            ];

            // Generate PDF
            $pdf = Pdf::loadView('PublicArea.Pages.Oct.oct_analysis_pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            // Return the PDF for download
            return $pdf->download('oct_analysis_report_' . time() . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to generate report: ' . $e->getMessage()]);
        }
    }

    public function requestDoctorAdvice($id)
    {
        try {
            // Check if user is logged in
            $userId = session('customer_id');
            if (!$userId) {
                return redirect()->route('customer.login')->with('error', 'Please log in to request doctor advice');
            }

            // Find the analysis record
            $analysis = PatientOctAnalysis::where('id', $id)
                ->where('user_id', $userId)
                ->firstOrFail();

            // Update need_help to 1
            $analysis->update(['need_help' => 1]);

            return redirect()->route('oct.uploadOctPublic')->with('success', 'Your request for doctor advice has been recorded. An optcare doctor will contact you soon.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Analysis record not found.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to request doctor advice: ' . $e->getMessage());
        }
    }
}
