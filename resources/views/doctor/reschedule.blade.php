@extends('layout.user')

@section('title', 'Reschedule Appointment')

@section('content')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .top-nav {
            max-width: 600px;
            margin: 30px auto 10px auto;
            display: flex;
            justify-content: flex-start;
        }

        .back-button {
            background-color: #6c757d;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .container {
            max-width: 600px;
            margin: 0 auto 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            font-family: 'Merriweather', serif;
            color: #5c4d7d;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            color: #1d3557;
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background-color: #fefefe;
        }

        input:focus,
        select:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
            outline: none;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: translateY(-2px);
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

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>

    {{-- Back to Dashboard --}}
    <div class="top-nav">
        <a href="{{ route('doctor.dashboard') }}" class="back-button">← Back to Dashboard</a>
    </div>

    <div class="container">
        <h2>Reschedule Appointment for {{ $appointment->patient_name }}</h2>

        {{-- Display error or success message --}}
        @if(session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('doctor.reschedule.submit') }}">
            @csrf
            <input type="hidden" name="Anum" value="{{ $appointment->Anum }}">

            <label for="new_day">New Date:</label>
            <input type="date" 
                   name="new_day" 
                   id="new_day" 
                   required 
                   min="{{ now()->toDateString() }}" 
                   max="{{ now()->addDays(14)->toDateString() }}">

            <label for="new_time">New Time:</label>
            <select name="new_time" id="new_time" required>
                <option value="">Select</option>
                @foreach(['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '02:00', '02:30', '03:00'] as $slot)
                    <option value="{{ $slot }}">{{ \Carbon\Carbon::parse($slot)->format('h:i A') }}</option>
                @endforeach
            </select>

            <button type="submit">Submit Reschedule</button>
        </form>
    </div>
@endsection
