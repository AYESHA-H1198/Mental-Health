@extends('layout.user') {{-- Ensure you're using a styled layout --}}

@section('title', 'Make Payment')

@section('content')
    <h2 style="color: #1d3557;">💳 Payment for Appointment #{{ $appointment->Anum }}</h2>

    @if (session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('payment.process') }}" style="max-width: 500px; background-color: #f1faee; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        @csrf
        <input type="hidden" name="Anum" value="{{ $appointment->Anum }}">

        <label for="type" style="display: block; margin-top: 10px;">Payment Type:</label>
        <select name="type" id="type" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">-- Select Type --</option>
            <option value="Cash">Cash</option>
            <option value="Credit">Credit</option>
            <option value="Online">Online</option>
        </select>

        <label for="Amt" style="display: block; margin-top: 15px;">Amount:</label>
        <input type="number" name="Amt" id="Amt" step="0.01" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px;">

        <button type="submit" style="margin-top: 20px; background-color: #457b9d; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
            💰 Pay Now
        </button>
    </form>

    <br>
    <a href="{{ route('user.dashboard') }}" class="link-button" style="color: #1d3557;">⬅ Back to Dashboard</a>
@endsection
