@extends('layout.user')

@section('title', 'Doctor Dashboard')

@section('content')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        h2, h3 {
            font-family: 'Merriweather', serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        thead {
            background-color: #fce3ec;
        }
        .status-badge {
            background-color: #f1faee;
            padding: 6px 12px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
        }
        .form-inline {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }
        .btn {
            background: linear-gradient(135deg, #fce3ec, #e0c3fc);
            color: #4a4a4a;
            font-weight: bold;
            padding: 6px 16px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Roboto', sans-serif;
        }
        .btn:hover {
            background: linear-gradient(135deg, #fbcfe8, #c084fc);
        }
        .reschedule-btn {
            background-color: #f9a8d4;
            color: white;
            font-weight: bold;
            padding: 6px 14px;
            border-radius: 16px;
            margin-top: 8px;
            border: none;
            cursor: pointer;
        }
        .reschedule-btn:hover {
            background-color: #ec4899;
        }
        .record-btn {
            background-color: #a78bfa;
            color: white;
            font-weight: bold;
            padding: 6px 14px;
            border-radius: 16px;
            margin-top: 8px;
            border: none;
            cursor: pointer;
        }
        .record-btn:hover {
            background-color: #7c3aed;
        }
    </style>

    <h2 style="color: #7b4f75; font-size: 2rem;">👨‍⚕️ Welcome, {{ $doctor->name }}</h2>

    <div>
        <h3 style="color: #457b9d; font-size: 1.4rem;">📅 Your Appointments</h3>

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
                        <td>{{ \Carbon\Carbon::parse($app->time)->format('h:i A') }}</td>
                        <td><span class="status-badge">{{ ucfirst($app->status ?? 'pending') }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('appointment.updateStatus') }}" class="form-inline">
                                @csrf
                                <input type="hidden" name="Anum" value="{{ $app->Anum }}">
                                <select name="status" required style="padding: 6px 10px; border-radius: 10px; border: 1px solid #ccc;">
                                    <option value="completed">Completed</option>
                                    <option value="missed">Missed</option>
                                </select>
                                <button type="submit" class="btn">Update</button>
                            </form>

                            <form method="GET" action="{{ route('doctor.reschedule.form', $app->Anum) }}">
                                <button type="submit" class="reschedule-btn">Reschedule</button>
                            </form>

                            <!-- ✅ New Record Button -->
                            <form method="GET" action="{{ route('doctor.record.form', ['Anum' => $app->Anum]) }}">
                                <button type="submit" class="record-btn">Record</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
