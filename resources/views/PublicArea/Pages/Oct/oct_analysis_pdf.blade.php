<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OCT Analysis Report - Optcare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
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
        .report-info, .analysis-section, .order-items, .order-summary {
            margin-bottom: 20px;
        }
        .report-info h3, .analysis-section h3, .order-summary h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .report-info p {
            margin: 5px 0;
        }
        .order-items table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-items th, .order-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .order-items th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary td {
            padding: 5px;
        }
        .summary-total {
            font-weight: bold;
            font-size: 14px;
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
        .oct-image-container {
            text-align: center;
            margin: 20px 0;
            background: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 8px;
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
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .recommendations h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
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
            margin: 20px 0;
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
        @media print {
            .header {
                break-inside: avoid;
            }
            .analysis-section {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">OCT ANALYSIS</div>

    <!-- Header -->
    <div class="header">
        <h1>OCT Analysis Report - Optcare</h1>
        <p>Artificial Intelligence Powered Optical Coherence Tomography Analysis</p>
    </div>

    <div class="container">
        <!-- Report Information -->
        <div class="report-info">
            <h3>Report Information</h3>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Report ID:</div>
                    <div class="info-value">{{ $patient_info['report_id'] ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Generated On:</div>
                    <div class="info-value">{{ $patient_info['generated_at'] ?? now()->format('d M Y, h:i A') }}</div>
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
            <h3>Uploaded OCT Scan</h3>
            <div class="oct-image-container">
                <img src="{{ $image_full_path }}" alt="OCT Scan" class="oct-image">
                <div class="image-caption">Original OCT scan uploaded for analysis</div>
            </div>
        </div>
        @endif

        <!-- AI Prediction Results -->
        <div class="analysis-section">
            <h3>AI Analysis Results</h3>
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
            <h3>Medical Recommendations</h3>
            <div class="recommendations">
                <h3>Suggested Next Steps:</h3>
                {!! $recommendation !!}
                <div style="margin-top: 20px; padding: 15px; background: rgba(52, 152, 219, 0.1); border-radius: 5px;">
                    <strong>Important:</strong> These recommendations are AI-generated suggestions based on the analysis results. They should be reviewed and validated by a qualified ophthalmologist or medical professional.
                </div>
            </div>
        </div>
        @endif

        <!-- Medical Disclaimer -->
        <div class="disclaimer">
            <h3>⚠️ Important Medical Disclaimer</h3>
            <p>
                <strong>This AI analysis is for informational and educational purposes only and is not intended to replace professional medical advice, diagnosis, or treatment.</strong>
            </p>
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
            <h3>Contact Information</h3>
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
        <div>Connect with us</div>
        <div class="social-links">
            <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>
        <div class="divider"></div>
        <div>No. 120, Galle Road, Colombo 03, Sri Lanka</div>
        <div>optcare@gmail.com • (+94) 702 74 0542</div>
        <div style="margin-top: 15px;">
            <a href="#">Unsubscribe</a>
            <a href="#">Privacy Policy</a>
        </div>
        <p>This report was generated using AI technology. © {{ date('Y') }} OCT Analysis System. All rights reserved.</p>
        <p>Generated on {{ now()->format('d M Y, h:i A') }} | Report ID: {{ $patient_info['report_id'] ?? 'N/A' }}</p>
    </div>
</body>
</html>
