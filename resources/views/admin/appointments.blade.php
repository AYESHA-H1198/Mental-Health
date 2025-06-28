@extends('layout.master')

@section('title', 'All Appointments')

@section('content')
    <div class="container">
        <h2 class="heading">All Appointments</h2>

        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Appointment No</th>
                    <th>User Name</th>
                    <th>Doctor Name</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                    <tr>
                        <td>{{ $app->Anum }}</td>
                        <td>{{ $app->user_name }}</td>
                        <td>{{ $app->doctor_name }}</td>
                        <td>{{ $app->day }}</td>
                        <td>{{ $app->time }}</td>
                        <td>{{ $app->status ?? 'Pending' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .container {
            padding: 20px;
            background: #fefefe;
        }

        .heading {
            font-size: 24px;
            color: #5e4b8b;
            margin-bottom: 20px;
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .appointments-table th, .appointments-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .appointments-table th {
            background-color: #d8e4f0;
            color: #333;
        }

        .appointments-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .appointments-table td {
            color: #444;
        }

        .back-btn {
            text-decoration: none;
            background: #f3c1c6;
            padding: 8px 16px;
            border-radius: 6px;
            color: #333;
            border: 1px solid #e0b3b8;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #e9b0b7;
        }
    </style>
@endsection
