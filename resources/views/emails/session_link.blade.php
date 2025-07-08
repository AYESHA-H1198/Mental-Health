<!DOCTYPE html>
<html>
<head>
    <title>Online Session Details</title>
</head>
<body>
<p>Dear {{ $name }},</p>

    <p>You have an online session with {{ $name }}.</p>

<p><strong>Date:</strong> {{ $day }}</p>
<p><strong>Time:</strong> {{ $time }}</p>
<p><strong>Google Meet Link:</strong> <a href="{{ $link }}">{{ $link }}</a></p>

<p>Please be available at your selected time.</p>

<br>
<p>Regards,<br>MentalEase</p>



</body>
</html>
