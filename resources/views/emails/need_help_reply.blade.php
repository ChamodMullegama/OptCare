<!DOCTYPE html>
<html>
<head>
    <title>Reply to Your OCT Analysis Request</title>
</head>
<body>
    <p>Dear Patient,</p>

    <p>Dr. {{ $doctorName }} has replied to your OCT analysis request:</p>

    <h3>Original Prediction</h3>
    <p>{{ $prediction }}</p>

    <h3>Doctor's Reply</h3>
    <p>{!! nl2br(e($replyMessage)) !!}</p>

    <h3>Clinical Recommendation</h3>
    {!! $recommendation !!}

    <p>Thank you,</p>
    <p>Healthcare Team</p>
</body>
</html>
