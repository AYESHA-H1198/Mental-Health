@extends('layout.user') {{-- Ensure you're using the styled user layout --}}

@section('title', 'Make Payment')

@section('content')
    <style>
        .payment-wrapper {
            max-width: 520px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .payment-wrapper h2 {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            text-align: center;
            color: #a855f7;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            color: #444;
            margin-top: 1rem;
            display: block;
        }

        select,
        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s ease;
        }

        select:focus,
        input[type="number"]:focus {
            border-color: #a78bfa;
            outline: none;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
        }

        .message {
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }

        .success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 24px;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: scale(1.02);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #7c3aed;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="payment-wrapper">
        <h2>💳 Payment for Appointment #{{ $appointment->Anum }}</h2>

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('payment.process') }}">
            @csrf
            <input type="hidden" name="Anum" value="{{ $appointment->Anum }}">

            <label for="type">Payment Type:</label>
            <select name="type" id="type" required>
                <option value="">-- Select Type --</option>
                <option value="Cash">Cash</option>
                <option value="Credit">Credit</option>
                <option value="Online">Online</option>
            </select>

            <label for="Amt">Amount:</label>
            <input type="number" name="Amt" id="Amt" step="0.01" required>

            <button type="submit">💰 Pay Now</button>
        </form>

        <a href="{{ route('user.dashboard') }}" class="back-link">⬅ Back to Dashboard</a>
    </div>
@endsection
