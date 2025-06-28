<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Appointments for Dr. {{ $doctor->name }}</h2>

    @if($doctor->appointments->count() > 0)
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctor->appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No appointments found for this doctor.</p>
    @endif
     <a href="{{ route('appointments.create', $doctor->id) }}" class="btn btn-primary mb-3">
    ➕ New Appointment
</a>

    <a href="{{ route('doctors.index') }}" class="btn btn-secondary mt-3">⬅ Back to Doctors</a>
</div>
</body>
</html>
