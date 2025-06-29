@extends('layout.user')

@section('title', 'User Dashboard')

@section('content')
    <style>
        .dashboard-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        h2 {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            color: #a855f7;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        h3 {
            color: #1d3557;
            margin: 30px 0 10px;
            font-size: 1.3rem;
        }

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        th, td {
            padding: 14px;
            text-align: center;
            border: 1px solid #eee;
        }

        th {
            background-color: #e0e7ff;
            color: #1e3a8a;
            font-weight: 600;
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
            display: inline-block;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .link-button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="dashboard-wrapper">
        <h2>👋 Welcome, {{ $user->name ?? $user->email }}!</h2>

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
                        <td><a href="{{ route('appointment.form', $doc->DID) }}" class="link-button">Book</a></td>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor_name }}</td>
                        <td>{{ $appointment->day }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->status ?? 'Pending' }}</td>
                        <td><a href="{{ route('payment.form', $appointment->Anum) }}" class="link-button">Pay</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
