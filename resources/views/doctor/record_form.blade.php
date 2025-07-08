@extends('layout.user')

@section('title', 'Add Medical Record')

@section('content')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafb;
            color: #333;
        }

        .record-container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .record-container h2 {
            color: #5a4fcf;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: 500;
            color: #374151;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 8px;
            font-size: 15px;
            resize: vertical;
            font-family: 'Roboto', sans-serif;
        }

        .btn-submit {
            margin-top: 25px;
            background: linear-gradient(to right, #8ec5fc, #e0c3fc);
            border: none;
            color: #333;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(to right, #a5d8ff, #d3bdfc);
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            background: #f3f4f6;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: bold;
            color: #4b5563;
            transition: background 0.2s ease;
        }

        .back-link:hover {
            background: #e5e7eb;
        }
    </style>

    <div class="record-container">
        <a href="{{ route('doctor.dashboard') }}" class="back-link">← Back to Dashboard</a>

        <h2>📝 Add Medical Record for Appointment #{{ $appointment->Anum }}</h2>

        @if(session('success'))
            <div class="success-message">✅ {{ session('success') }}</div>
        @endif

        <form action="{{ url('/doctor/appointment/' . $appointment->Anum . '/record') }}" method="POST">
            @csrf

            <label for="issue">Issue:</label>
            <textarea name="issue" id="issue" rows="3" required oninvalid="this.setCustomValidity('Please describe the issue')" oninput="setCustomValidity('')">{{ $record->issue ?? '' }}</textarea>

            <label for="medicine">Medicine:</label>
            <textarea name="medicine" id="medicine" rows="2" required oninvalid="this.setCustomValidity('Please enter prescribed medicine')" oninput="setCustomValidity('')">{{ $record->medicine ?? '' }}</textarea>

            <label for="notes">Additional Notes:</label>
            <textarea name="notes" id="notes" rows="3">{{ $record->notes ?? '' }}</textarea>

            <button type="submit" class="btn-submit">💾 Save Record</button>
        </form>
    </div>
@endsection
