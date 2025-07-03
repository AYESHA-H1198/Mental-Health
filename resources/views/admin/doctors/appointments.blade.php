<!-- resources/views/admin/doctors/appointments.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #fdfbfb, #ebedee);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .btn-back {
            border-radius: 12px;
            padding: 10px 20px;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 12px;
        }

        .badge-completed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #664d03;
        }

        .badge-cancelled {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="card p-4">
        <h2 class="text-center text-primary mb-4">Appointments for  {{ $doctor->name }}</h2>

        @if($doctor->appointments && $doctor->appointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctor->appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->user->name ?? 'Unknown' }}</td>
                                <td>{{ $appointment->day ?? 'N/A' }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td>
                                    @php
                                        $status = strtolower($appointment->status);
                                    @endphp
                                    <span class="badge badge-status 
                                        {{ $status === 'completed' ? 'badge-completed' : 
                                           ($status === 'pending' ? 'badge-pending' : 
                                           'badge-cancelled') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center">No appointments found for this doctor.</p>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-back">⬅ Back to Doctors</a>
        </div>
    </div>
</div>
</body>
</html>
