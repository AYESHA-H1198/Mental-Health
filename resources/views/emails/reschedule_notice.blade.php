<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Rescheduled</title>
</head>
<body>
   
    <p>Your appointment has been <strong>rescheduled</strong>.</p>
     <h2>Dear {{ $patientName }},</h2>

<p>Your appointment with Dr. {{ $doctorName }} has been rescheduled.</p>

<p><strong>New Date:</strong> {{ \Carbon\Carbon::parse($newDay)->format('F d, Y') }}</p>
<p><strong>New Time:</strong> {{ \Carbon\Carbon::parse($newTime)->format('h:i A') }}</p>



    <p>Thanks,<br>Mental Health Counseling Team</p>
</body>
</html>
