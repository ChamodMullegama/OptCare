<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCT Analysis Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            font-size: 12px;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .report-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .report-info h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label, .info-value {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            width: 30%;
            color: #555;
        }

        .info-value {
            width: 70%;
        }

        .analysis-section {
            margin-bottom: 30px;
        }

        .section-title {
            background: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .oct-image-container {
            text-align: center;
            margin: 30px 0;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
        }

        .oct-image {
            max-width: 100%;
            max-height: 400px;
            border: 3px solid #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .image-caption {
            margin-top: 15px;
            font-style: italic;
            color: #666;
            font-size: 11px;
        }

        .prediction-box {
            background: #e8f5e8;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .prediction-box.warning {
            background: #fff3cd;
            border-color: #ffc107;
        }

        .prediction-box.danger {
            background: #f8d7da;
            border-color: #dc3545;
        }

        .prediction-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .prediction-value {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
            background: rgba(255,255,255,0.7);
            border-radius: 5px;
            display: inline-block;
            margin: 10px 0;
        }

        .recommendations {
            background: #f0f8ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .recommendations h3 {
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .recommendations ul {
            padding-left: 20px;
            margin: 10px 0;
        }

        .recommendations li {
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .disclaimer {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }

        .disclaimer h3 {
            color: #856404;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .disclaimer p {
            color: #856404;
            font-size: 11px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 50px;
            padding: 20px;
            background: #2c3e50;
            color: white;
            text-align: center;
            font-size: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        /* Print-specific styles */
        @media print {
            .header {
                break-inside: avoid;
            }

            .analysis-section {
                break-inside: avoid;
            }
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0,0,0,0.05);
            z-index: -1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">OCT ANALYSIS</div>

    <!-- Header -->
    <div class="header">
        <h1>OCT Analysis Report</h1>
        <p>Artificial Intelligence Powered Optical Coherence Tomography Analysis</p>
    </div>

    <div class="container">
        <!-- Report Information -->
        <div class="report-info">
            <h2>Report Information</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Report ID:</div>
                    <div class="info-value">{{ $patient_info['report_id'] ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Generated On:</div>
                    <div class="info-value">{{ $patient_info['generated_at'] ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Analysis Date:</div>
                    <div class="info-value">{{ $analysis_date ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Analysis Type:</div>
                    <div class="info-value">{{ $patient_info['analysis_type'] ?? 'AI-Powered OCT Analysis' }}</div>

                </div>
                 <div class="info-row">
                    <div class="info-label">Patient:</div>
                    <div class="info-value">{{ $customer_email ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- OCT Image -->
        @if($image_exists && isset($image_full_path))
        <div class="analysis-section">
            <div class="section-title">Uploaded OCT Scan</div>
            <div class="oct-image-container">
                <img src="{{ $image_full_path }}" alt="OCT Scan" class="oct-image">
                <div class="image-caption">
                    Original OCT scan uploaded for analysis
                </div>
            </div>
        </div>
        @endif

        <!-- AI Prediction Results -->
        <div class="analysis-section">
            <div class="section-title">AI Analysis Results</div>

            @php
                $predictionClass = 'prediction-box';
                if (isset($prediction)) {
                    if (stripos($prediction, 'normal') !== false) {
                        $predictionClass .= '';
                    } elseif (stripos($prediction, 'abnormal') !== false || stripos($prediction, 'disease') !== false) {
                        $predictionClass .= ' warning';
                    }
                }
            @endphp

            <div class="{{ $predictionClass }}">
                <div class="prediction-title">AI Prediction:</div>
                <div class="prediction-value">{{ $prediction ?? 'N/A' }}</div>

                <p style="margin-top: 15px; font-size: 11px; color: #666;">
                    This prediction is generated using advanced machine learning algorithms trained on extensive OCT imaging datasets. The AI model analyzes retinal layer patterns, structural abnormalities, and tissue characteristics to provide this classification.
                </p>
            </div>
        </div>

        <!-- Recommendations -->
        @if(isset($recommendation) && $recommendation)
        <div class="analysis-section">
            <div class="section-title">Medical Recommendations</div>
            <div class="recommendations">
                <h3>Suggested Next Steps:</h3>
                {!! $recommendation !!}

                <div style="margin-top: 20px; padding: 15px; background: rgba(52, 152, 219, 0.1); border-radius: 5px;">
                    <strong>Important:</strong> These recommendations are AI-generated suggestions based on the analysis results. They should be reviewed and validated by a qualified ophthalmologist or medical professional.
                </div>
            </div>
        </div>
        @endif

        <!-- Technical Details -->
        {{-- <div class="analysis-section">
            <div class="section-title">Technical Information</div>
            <div class="report-info">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">AI Model:</div>
                        <div class="info-value">Deep Learning OCT Analysis Model v2.1</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Processing Method:</div>
                        <div class="info-value">Convolutional Neural Network (CNN) Analysis</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Image Resolution:</div>
                        <div class="info-value">High-Resolution OCT Scan Analysis</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Analysis Duration:</div>
                        <div class="info-value">< 30 seconds</div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Medical Disclaimer -->
        <div class="disclaimer">
            <h3>⚠️ Important Medical Disclaimer</h3>
            <p>
                <strong>This AI analysis is for informational and educational purposes only and is not intended to replace professional medical advice, diagnosis, or treatment.</strong>
            </p>
            <br>
            <p>
                • This report should be reviewed by a qualified ophthalmologist or healthcare professional<br>
                • AI predictions may not be 100% accurate and should be correlated with clinical findings<br>
                • Emergency cases require immediate medical attention regardless of AI analysis results<br>
                • Always consult with healthcare professionals for proper medical evaluation and treatment decisions<br>
                • This system is designed to assist healthcare providers, not replace clinical judgment
            </p>
        </div>

        <!-- Contact Information -->
        <div class="analysis-section">
            <div class="section-title">Contact Information</div>
            <div class="report-info">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Hotline:</div>
                        <div class="info-value">(+94) 222 468 5678</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email Support:</div>
                        <div class="info-value">optcare@gmail.com</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Location:</div>
                        <div class="info-value">59 Street, Kandy, Sri Lanka</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Website:</div>
                        <div class="info-value">www.optcare.lk</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>This report was generated using AI technology. © {{ date('Y') }} OCT Analysis System. All rights reserved.</p>
        <p>Generated on {{ now()->format('F j, Y \a\t g:i A') }} | Report ID: {{ $patient_info['report_id'] ?? 'N/A' }}</p>
    </div>
</body>
</html>

