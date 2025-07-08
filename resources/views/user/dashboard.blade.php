@extends('layout.user')

@section('title', 'User Dashboard')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafc;
            color: #333;
        }

        .dashboard-wrapper {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .logo-text {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
            text-align: center;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            font-family: 'Merriweather', serif;
            font-size: 1.5rem;
            color: #5c4d7d;
            margin-bottom: 30px;
        }

        h3 {
            font-family: 'Roboto', sans-serif;
            font-size: 1.25rem;
            color: #1d3557;
            margin-top: 40px;
            margin-bottom: 15px;
        }

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
        }

        .message.error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        th, td {
            padding: 14px;
            text-align: center;
            border: 1px solid #f1f1f1;
            font-size: 0.95rem;
        }

        th {
            background-color: #e0e7ff;
            color: #1e3a8a;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .link-button {
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .link-button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="dashboard-wrapper">
        <h1 class="logo-text">MindEase</h1>
        <h2>Welcome, {{ $user->name ?? $user->email }}</h2>

        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        <h3>🩺 Available Doctors</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doc)
                    <tr>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->phone }}</td>
                        <td>{{ $doc->email }}</td>
                        <td>
                            <a href="{{ route('appointment.form', $doc->DID) }}" class="link-button">Book</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>📅 Your Appointments</h3>
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Mode</th>
                    <th>Payment Status</th>
                    <th>Appointment Status</th>
                    <th>Action</th>
                    <th>Medical Record</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor_name }}</td>
                        <td>{{ $appointment->day }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ ucfirst($appointment->mode) }}</td>
                        <td>
                            @if ($appointment->payment_status === 'approved')
                                <span style="color: green;">Paid</span>
                            @elseif ($appointment->payment_status === 'pending')
                                <span style="color: orange;">Pending</span>
                            @else
                                <span style="color: red;">Not Paid</span>
                            @endif
                        </td>
                        <td>
                            @if ($appointment->appointment_status === 'Waiting')
                                <span style="color: orange;">Waiting</span>
                            @elseif ($appointment->appointment_status === 'Completed')
                                <span style="color: green;">Completed</span>
                            @elseif ($appointment->appointment_status === 'Rescheduled')
                                <span style="color: blue;">Rescheduled</span>
                            @elseif ($appointment->appointment_status === 'Missed')
                                <span style="color: red;">Missed</span>
                            @else
                                <span style="color: gray;">{{ ucfirst($appointment->appointment_status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if (empty($appointment->payment_status) && !empty($appointment->Anum))
                                <a href="{{ route('payment.form', ['Anum' => $appointment->Anum]) }}" class="link-button">Pay</a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                             @if ($appointment->record_id)
                                   <a href="{{ route('user.record.view', $appointment->Anum) }}" class="link-button">View Record</a>
                             @else
                                     <span style="color: gray;">N/A</span>
                             @endif
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
