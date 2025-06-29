@extends('layout.user')

@section('title', 'Doctor Dashboard')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500&display=swap');

        .dashboard-wrapper {
            max-width: 960px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        .dashboard-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .dashboard-logo .main {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
        }

        .dashboard-logo .sub {
            font-family: 'Roboto', sans-serif;
            font-size: 1.1rem;
            color: #4a4a4a;
            margin-top: 5px;
        }

        .section-title {
            font-family: 'Roboto', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #1d3557;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: #fff;
        }

        th, td {
            padding: 14px;
            font-family: 'Roboto', sans-serif;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: #fce3ec;
            font-weight: 600;
            color: #4a4a4a;
        }

        .status-pill {
            padding: 6px 12px;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            font-size: 0.9rem;
        }

        .status-form {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .status-form select {
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
            transition: border-color 0.3s ease;
        }

        .status-form select:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
            outline: none;
        }

        .update-btn {
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.95rem;
            transition: 0.3s ease;
        }

        .update-btn:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transform: scale(1.03);
        }

        .back-btn {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 10px 20px;
            text-align: center;
            border-radius: 30px;
            background: linear-gradient(to right, #a78bfa, #f472b6);
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .back-btn:hover {
            background: linear-gradient(to right, #7c3aed, #ec4899);
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .message.error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 14px;
            border-radius: 10px;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 14px;
            border-radius: 10px;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>

    <div class="dashboard-wrapper">
        <!-- Logo -->
        <div class="dashboard-logo">
            <div class="main">MindEase</div>
            <div class="sub">👨‍⚕️ Doctor Portal</div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        <!-- Appointments Section -->
        <h3 class="section-title">📅 Your Appointments</h3>

        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                    <tr>
                        <td>{{ $app->patient_name }}</td>
                        <td>{{ $app->day }}</td>
                        <td>{{ $app->time }}</td>
                        <td><span class="status-pill">{{ $app->status ?? 'Pending' }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('appointment.updateStatus') }}" class="status-form">
                                @csrf
                                <input type="hidden" name="Anum" value="{{ $app->Anum }}">
                                <select name="status" required>
                                    <option value="completed">Completed</option>
                                    <option value="missed">Missed</option>
                                </select>
                                <button type="submit" class="update-btn">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('doctor.logout') }}" class="back-btn">⬅ Logout</a>
    </div>
@endsection
