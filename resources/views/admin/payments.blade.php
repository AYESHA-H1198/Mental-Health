@extends('layout.master')

@section('title', 'All Payments')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fdf6f0;
            margin: 0;
            color: #333;
        }

        /* HEADER STYLING */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            background-color: #f5ebf7;
            border-bottom: 1px solid #e4d8ec;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .header h1 {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
        }

        .payment-container {
            max-width: 1000px;
            margin: 0 auto 40px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        h2 {
            font-family: 'Merriweather', serif;
            font-size: 1.6rem;
            color: #5c4d7d;
            margin-bottom: 25px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.95rem;
        }

        th {
            background: linear-gradient(to right, #fbcfe8, #e9d5ff);
            color: #4a4a4a;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #fef6fb;
        }

        td {
            color: #444;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            background: linear-gradient(to right, #a78bfa, #f472b6);
            color: white;
            padding: 10px 26px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.95rem;
            border-radius: 30px;
            transition: 0.3s ease;
        }

        .back-btn:hover {
            background: linear-gradient(to right, #7c3aed, #ec4899);
            transform: scale(1.04);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            text-align: center;
        }
    </style>

    <!-- Header -->
    <div class="header">
        <h1>MindEase</h1>
    </div>

    <div class="payment-container">
        <h2>💰 All Payments</h2>

        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Day</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->PID }}</td>
                        <td>{{ $payment->user_name }}</td>
                        <td>Rs. {{ number_format($payment->Amt) }}</td>
                        <td>{{ $payment->day }}</td>
                        <td>{{ $payment->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="btn-container">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
@endsection
