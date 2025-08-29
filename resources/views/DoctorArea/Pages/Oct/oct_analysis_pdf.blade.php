<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OptCare OCT Analysis Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .report-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background: #fff;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .image-container {
            text-align: center;
            margin: 20px 0;
            background: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
        }
        .image-container img {
            max-width: 100%;
            max-height: 400px;
            border: 3px solid #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .image-container p {
            margin-top: 15px;
            font-style: italic;
            color: #666;
            font-size: 11px;
        }
        .recommendation {
            background: #f0f8ff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .recommendation h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .prediction-badge {
            background: #e8f5e8;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }
        .prediction-badge.warning {
            background: #fff3cd;
            border-color: #ffc107;
        }
        .prediction-badge.danger {
            background: #f8d7da;
            border-color: #dc3545;
        }
        .footer {
            margin-top: 50px;
            padding: 20px;
            background: #2c3e50;
            color: white;
            text-align: center;
            font-size: 10px;
        }
        .footer a {
            color: #e0ecf3;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <h1>OptCare OCT Analysis Report</h1>
            <p>Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
        </div>

        <div class="content-wrapper">
            <div class="row">
                <div class="col-6">
                    <div class="section">
                        <h2>Doctor Information</h2>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>Dr. {{ $analysis->doctor_name }}</td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <td>{{ $analysis->doctor_id }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <div class="section">
                        <h2>Patient Information</h2>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{ $analysis->patient_id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $analysis->patient_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $analysis->patient_email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $analysis->patient_phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ $analysis->patient_age ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Analysis Details</h2>
                <table class="table">
                    <tr>
                        <th>Eye Side</th>
                        <td>{{ ucfirst($analysis->eye_side) }} Eye</td>
                    </tr>
                    <tr>
                        <th>Prediction</th>
                        <td>
                            @php
                                $predictionClass = 'prediction-badge';
                                if ($analysis->prediction == 'NORMAL') {
                                    $predictionClass .= '';
                                } elseif (stripos($analysis->prediction, 'ABNORMAL') !== false) {
                                    $predictionClass .= ' warning';
                                }
                            @endphp
                            <span class="{{ $predictionClass }}">{{ $analysis->prediction }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Clinical Notes</th>
                        <td>{{ $analysis->clinical_notes ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Analysis Date</th>
                        <td>{{ $analysis->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2>OCT Scan Image</h2>
                <div class="image-container">
                    <img src="{{ public_path('storage/' . $analysis->image_path) }}" alt="{{ ucfirst($analysis->eye_side) }} Eye OCT Scan">
                    <p>{{ ucfirst($analysis->eye_side) }} Eye OCT Scan</p>
                </div>
            </div>

            <div class="section">
                <h2>Medical Recommendation</h2>
                <div class="recommendation">
                    <h3>Clinical Assessment</h3>
                    <div>{!! $analysis->recommendation !!}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>OptCare Eye Clinic</div>
            <div>No. 120, Galle Road, Colombo 03, Sri Lanka</div>
            <div>optcare@gmail.com • (+94) 702 74 0542</div>
            <div style="margin-top: 15px;">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
            <div style="margin-top: 15px;">OCT Analysis System | OptCare</div>
            <div>This report was generated using AI technology. © {{ date('Y') }} OCT Analysis System. All rights reserved.</div>
        </div>
    </div>
</body>
</html>
