@extends('layout.master')

@section('title', 'All Appointments')

@section('content')
    <div class="container">
        <h2 class="heading">📋 All Appointments</h2>

        <div class="table-wrapper">
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>#</th>
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
                            <td>
                                <span class="status-badge {{ strtolower($app->status ?? 'pending') }}">
                                    {{ ucfirst($app->status ?? 'Pending') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #fdf6f0;
        }

        .container {
            padding: 40px 20px;
            max-width: 1000px;
            margin: auto;
        }

        .heading {
            font-family: 'Pacifico', cursive;
            font-size: 2.2rem;
            color: #a855f7;
            text-align: center;
            margin-bottom: 30px;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        .appointments-table th, .appointments-table td {
            padding: 16px;
            text-align: center;
            font-size: 0.95rem;
        }

        .appointments-table th {
            background: linear-gradient(to right, #fbcfe8, #e9d5ff);
            color: #333;
        }

        .appointments-table tr:nth-child(even) {
            background-color: #fef6fb;
        }

        .appointments-table td {
            color: #444;
        }

        .back-btn {
            text-decoration: none;
            background: linear-gradient(to right, #ec4899, #a78bfa);
            padding: 10px 24px;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .back-btn:hover {
            background: linear-gradient(to right, #d946ef, #7c3aed);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-badge.pending {
            background-color: #fde68a;
            color: #92400e;
        }

        .status-badge.completed {
            background-color: #bbf7d0;
            color: #065f46;
        }

        .status-badge.missed {
            background-color: #fecaca;
            color: #991b1b;
        }
    </style>
@endsection
