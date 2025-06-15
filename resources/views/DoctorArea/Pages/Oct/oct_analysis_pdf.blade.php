<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OptCare OCT Analysis Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
        @page { margin: 10mm; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 9pt;
            color: #333;
            line-height: 1.3;
        }
        .report-container {
            max-width: 595pt;
            margin: 0 auto;
            border: 2px solid #0d6efd;
            border-radius: 5px;
            background: #fff;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            padding: 8px;
            text-align: center;
            border-bottom: 2px solid #0d6efd;
        }
        .header h1 {
            font-size: 14pt;
            margin: 0;
        }
        .header p {
            font-size: 8pt;
            margin: 2px 0 0;
            opacity: 0.9;
        }
        .content-wrapper {
            padding: 8px;
        }
        .section {
            padding: 6px;
            border: 1px solid #dee2e6;
            border-radius: 3px;
            margin-bottom: 6px;
        }
        .section h2 {
            font-size: 10pt;
            color: #0d6efd;
            margin-bottom: 4px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 2px;
        }
        .section h2 i {
            margin-right: 4px;
        }
        .table {
            font-size: 8pt;
            margin-bottom: 0;
        }
        .table th {
            background-color: #e9ecef;
            color: #333;
            font-weight: 600;
            padding: 3px 5px;
        }
        .table td {
            padding: 3px 5px;
            vertical-align: middle;
        }
        .image-container {
            text-align: center;
            margin: 6px 0;
            padding: 6px;
            border: 1px dashed #6c757d;
            border-radius: 3px;
        }
        .image-container img {
            max-width: 100%;
            max-height: 100px;
            border-radius: 3px;
        }
        .image-container p {
            font-size: 7pt;
            color: #6c757d;
            margin-top: 3px;
            font-style: italic;
        }
        .recommendation {
            background-color: #f8f9fa;
            padding: 6px;
            border-left: 2px solid #0d6efd;
            border-radius: 3px;
            font-size: 8pt;
        }
        .recommendation h3 {
            font-size: 9pt;
            color: #0d6efd;
            margin-bottom: 3px;
        }
        .prediction-badge {
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3px;
            margin-top: 3px;
        }
        .stats-card {
            background-color: #f8f9fa;
            padding: 3px;
            border-radius: 3px;
            text-align: center;
            font-size: 7pt;
            border: 1px solid #dee2e6;
        }
        .stats-number {
            font-size: 8pt;
            font-weight: bold;
            color: #0d6efd;
        }
        .stats-label {
            color: #6c757d;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 6px;
            border-top: 2px solid #0d6efd;
            border-radius: 0 0 3px 3px;
            font-size: 7pt;
        }
        .footer-divider {
            width: 30px;
            height: 1px;
            background-color: #0d6efd;
            margin: 0 auto 3px;
        }
        .footer a {
            color: #4dabf7;
            text-decoration: none;
            margin: 0 3px;
            font-size: 7pt;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <h1><i class="fas fa-eye me-2"></i>OptCare OCT Analysis Report</h1>
            <p><i class="fas fa-calendar-alt me-1"></i>Generated on {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
        </div>

        <div class="content-wrapper">
            <div class="row g-2">
                <div class="col-6">
                    <div class="section">
                        <h2><i class="fas fa-user-md"></i>Doctor Information</h2>
                        <table class="table table-bordered">
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
                        <h2><i class="fas fa-user"></i>Patient Information</h2>
                        <table class="table table-bordered">
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
                <h2><i class="fas fa-chart-line"></i>Analysis Details</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Eye Side</th>
                        <td>{{ ucfirst($analysis->eye_side) }} Eye</td>
                    </tr>
                    <tr>
                        <th>Prediction</th>
                        <td>
                            <span class="prediction-badge {{ $analysis->prediction == 'NORMAL' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $analysis->prediction }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Clinical Notes</th>
                        <td>{{ $analysis->clinical_notes ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Analysis Date</th>
                        <td>{{ $analysis->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                </table>
                {{-- <div class="stats-grid">
                    <div class="stats-card">
                        <div class="stats-number">{{ $analysis->confidence_level ?? '98.5' }}%</div>
                        <div class="stats-label">Confidence</div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-number">{{ $analysis->analysis_time ?? '2.3' }}s</div>
                        <div class="stats-label">Time</div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-number">{{ $analysis->image_resolution ?? '1024×768' }}</div>
                        <div class="stats-label">Resolution</div>
                    </div>
                </div> --}}
            </div>

            <div class="section">
                <h2><i class="fas fa-image"></i>OCT Scan Image</h2>
                <div class="image-container">
                    <img src="{{ public_path('storage/' . $analysis->image_path) }}" alt="{{ ucfirst($analysis->eye_side) }} Eye OCT Scan">
                    <p>{{ ucfirst($analysis->eye_side) }} Eye OCT Scan</p>
                </div>
            </div>

            <div class="section">
                <h2><i class="fas fa-file-medical"></i>Medical Recommendation</h2>
                <div class="recommendation">
                    <h3>Clinical Assessment</h3>
                    <div>{!! $analysis->recommendation !!}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-divider"></div>
            <div>OptCare Eye Clinic</div>
            <div>59 Street, Kandy, Sri Lanka</div>
            <div><i class="fas fa-envelope me-1"></i>optcare@gmail.com <i class="fas fa-phone ms-2 me-1"></i>(+94) 222 468 5678</div>
            <div class="footer-links">
                <a href="#"><i class="fas fa-shield-alt me-1"></i>Privacy</a>
                <a href="#"><i class="fas fa-file-alt me-1"></i>Terms</a>
            </div>
            <div class="mt-1"><i class="fas fa-cogs me-1"></i>OCT Analysis System | OptCare</div>
        </div>
    </div>
</body>
</html>
