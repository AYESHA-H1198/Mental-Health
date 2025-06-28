@extends('layout.master')

@section('title', 'All Payments')

@section('content')
    <h2 style="color: #1d3557;">💰 All Payments</h2>

    <table>
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Day</th>
                <th>Time</th>
                <!-- <th>Payment Date</th> -->
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
                    <!-- <td>{{ $payment->created_at ?? 'N/A' }}</td> -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('admin.dashboard') }}">⬅ Back to Dashboard</a>
@endsection
