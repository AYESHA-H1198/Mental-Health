@extends('layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #fdf6f0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fef1f6;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .topbar h2 {
            font-family: 'Pacifico', cursive;
            color: #a855f7;
            font-size: 1.8rem;
        }

        .logout-link {
            background: linear-gradient(to right, #f472b6, #c084fc);
            color: white;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-link:hover {
            background: linear-gradient(to right, #ec4899, #8b5cf6);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .summary-cards {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .card {
            flex: 1 1 250px;
            padding: 1.5rem;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            color: #7c3aed;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .card p {
            font-size: 1.6rem;
            color: #1d3557;
            font-weight: bold;
        }

        .nav-buttons {
            margin-top: 3rem;
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .nav-buttons a {
            flex: 1 1 200px;
            text-align: center;
            text-decoration: none;
            padding: 1rem 2rem;
            background: linear-gradient(to right, #a78bfa, #f472b6);
            color: white;
            font-weight: bold;
            border-radius: 30px;
            transition: 0.3s ease;
        }

        .nav-buttons a:hover {
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
    </style>

    <div class="topbar">
        <h2>👋 Welcome, Admin!</h2>
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
        <a href="{{ route('admin.viewAppointments') }}">📋 View All Appointments</a>
        <a href="{{ route('admin.viewPayments') }}">💰 View All Payments</a>
    </div>
@endsection
