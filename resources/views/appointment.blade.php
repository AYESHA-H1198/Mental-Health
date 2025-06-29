@extends('layout.user')

@section('title', 'Book Appointment')

@section('content')
    <style>
        .appointment-form {
            max-width: 500px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #a855f7;
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #1d3557;
        }

        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background-color: #fefefe;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
            outline: none;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }

        .message.error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }

        .link-button {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            background-color: #6c757d;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .link-button:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="appointment-form">
        <h2>📅 Book Appointment with {{ $doctor->name }}</h2>

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('appointment.book') }}">
            @csrf
            <input type="hidden" name="DID" value="{{ $doctor->DID }}">

            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" required>

            <label for="time">Select Time:</label>
            <input type="time" name="time" id="time" required>

            <button type="submit">✅ Book Appointment</button>
        </form>

        <a href="{{ route('user.dashboard') }}" class="link-button">⬅ Back to Dashboard</a>
    </div>
@endsection
