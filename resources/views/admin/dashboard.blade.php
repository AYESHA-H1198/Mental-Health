@extends('layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-link {
            background-color: #e63946;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .summary-cards {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .card {
            background-color: #f1faee;
            padding: 1.5rem;
            border-radius: 12px;
            flex: 1 1 250px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #1d3557;
            font-size: 1.2rem;
        }

        .card p {
            font-size: 1.5rem;
            color: #457b9d;
        }

        .nav-buttons {
            margin-top: 3rem;
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nav-buttons a {
            background-color: #457b9d;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
            flex: 1 1 200px;
        }

        .nav-buttons a:hover {
            background-color: #1d3557;
        }
    </style>

    <div class="topbar">
        <h2 style="color: #1d3557;">👋 Welcome, Admin!</h2>
        <a href="{{ route('admin.logout') }}" class="logout-link">🚪 Logout</a>
    </div>

    <div class="summary-cards">
        <div class="card">
            <h3>Total Appointments</h3>
            <p>{{ $appointmentCount }}</p>
        </div>
        <div class="card">
            <h3>Total Payment Collected</h3>
            <p>Rs. {{ number_format($paymentTotal) }}</p>
        </div>
    </div>

    <div class="nav-buttons">
        <a href="{{ route('admin.viewAppointments') }}">🔍 View All Appointments</a>
        <a href="{{ route('admin.viewPayments') }}">💰 View All Payments</a>
    </div>
@endsection
