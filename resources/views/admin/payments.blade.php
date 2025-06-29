@extends('layout.master')

@section('title', 'All Payments')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #fdf6f0;
        }

        .payment-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            color: #a855f7;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }

        th {
            background: linear-gradient(to right, #fbcfe8, #e9d5ff);
            color: #333;
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
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            padding: 10px 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
            transition: 0.3s ease;
            text-align: center;
        }

        .back-btn:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
    </style>

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

        <div style="text-align: center;">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
@endsection
