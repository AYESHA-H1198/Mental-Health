@extends('layout.user')

@section('title', 'Book Appointment')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafc;
            color: #333;
        }

        .appointment-form {
            max-width: 500px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #5c4d7d;
            font-family: 'Merriweather', serif;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
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
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: translateY(-2px);
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
            transition: background-color 0.3s ease;
        }

        .link-button:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="appointment-form">
        <h2>Book an Appointment with {{ $doctor->name }}</h2>

       @if (session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('appointment.book') }}">
        @csrf
        <input type="hidden" name="DID" value="{{ $doctor->DID }}">

        <label for="day">Select Date:</label>
        <input 
            type="date" 
            name="day" 
            id="day" 
            required 
            min="{{ date('Y-m-d') }}" 
            max="{{ now()->addDays(14)->format('Y-m-d') }}"
        >

        <label for="time">Select Time:</label>
        <select name="time" id="time" required>
            <option value="">-- Select Time Slot --</option>
            <option value="09:00">09:00 AM</option>
            <option value="09:30">09:30 AM</option>
            <option value="10:00">10:00 AM</option>
            <option value="10:30">10:30 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="11:30">11:30 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="02:00">02:00 PM</option>
            <option value="02:30">02:30 PM</option>
            <option value="03:00">03:00 PM</option>
        </select>

        <button type="submit">Book Appointment</button>
    </form>

    <br>
    <a href="{{ route('user.dashboard') }}" class="link-button" style="background-color: #6c757d;">⬅ Back to Dashboard</a>
@endsection

@section('scripts')
<script>
    document.getElementById('day').addEventListener('change', function () {
        const day = new Date(this.value).getDay();
        if (day === 0 || day === 6) {
            alert("Appointments cannot be booked on weekends.");
            this.value = '';
        }
    });
</script>
@endsection