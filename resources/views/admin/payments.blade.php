@extends('layout.master')

@section('title', 'All Payments')

@section('content')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fdf6f0;
        }

        .header {
            text-align: center;
            padding: 30px 0;
            background-color: #f5ebf7;
            border-bottom: 1px solid #e4d8ec;
            margin-bottom: 30px;
        }

        .header h1 {
            font-family: 'Merriweather', serif;
            color: #7b4f75;
            font-size: 2.2rem;
        }

        .payment-container {
            max-width: 1100px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: linear-gradient(to right, #fbcfe8, #e9d5ff);
            color: #4a4a4a;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #fef6fb;
        }

        .btn-approve {
            padding: 6px 14px;
            background-color: #38b000;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-approve:hover {
            background-color: #2d8700;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
        }

        .badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge.approved {
            background-color: #d4edda;
            color: #155724;
        }

        .proof-link {
            text-decoration: underline;
            color: #2563eb;
            font-weight: 500;
        }

        .back-btn {
            display: inline-block;
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

    <div class="header">
        <h1>MindEase Admin Portal</h1>
    </div>

    <div class="payment-container">
        <h2 style="text-align:center; color:#5c4d7d; font-family:'Merriweather';">💰 All Payments</h2>

        @if (session('success'))
            <div style="color: green; font-weight: bold; text-align:center; margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>PID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Txn ID</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Action</th>
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
                        <td>{{ $payment->txn_id ?? 'N/A' }}</td>
                        <td>
                            @if($payment->proof)
                                <a href="{{ asset('storage/' . $payment->proof) }}" class="proof-link" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $payment->status === 'approved' ? 'approved' : 'pending' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td>
                            @if($payment->status !== 'approved')
                                <form action="{{ route('admin.approve.payment', $payment->PID) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-approve">Approve</button>
                                </form>
                            @else
                                ✅
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="btn-container">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
@endsection
