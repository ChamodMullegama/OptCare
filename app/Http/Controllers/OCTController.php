<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OCTController extends Controller
{
    public function showUploadForm()
    {
        try {
            return view('PublicArea.Pages.OCTAnalysis.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


 public function uploadAndPredict(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Store image
            $imagePath = $request->file('image')->store('oct-scans', 'public');

            // Call Python API
            $client = new Client([
                'timeout' => 30,
                'verify' => false // Only for development, remove in production
            ]);

            $response = $client->post('http://localhost:5000/predict', [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(storage_path("app/public/{$imagePath}"), 'r'),
                        'filename' => 'oct_scan.jpg'
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['error'])) {
                throw new \Exception($result['error']);
            }

            return back()
                ->with('success', 'Analysis completed')
                ->with('prediction', $result['prediction'] ?? 'Unknown')
                ->with('recommendation', $result['recommendation'] ?? 'No recommendations available')
                ->with('image', $imagePath);

        } catch (\Exception $e) {
            $errorMessage = 'Analysis failed: ' . $e->getMessage();

            // If we have a prediction but recommendation failed
            if (isset($result['prediction'])) {
                return back()
                    ->with('warning', 'Partial analysis completed')
                    ->with('prediction', $result['prediction'])
                    ->with('recommendation',
                        '<p>Could not generate full recommendations. Please consult an ophthalmologist.</p>')
                    ->with('image', $imagePath ?? null);
            }

            return back()->with('error', $errorMessage);
        }
    }
}
