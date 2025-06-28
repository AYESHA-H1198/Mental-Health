@extends('layout.user')

@section('title', 'Book Appointment')

@section('content')
    <h2 style="color: #1d3557;">Book Appointment with {{ $doctor->name }}</h2>

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

        <button type="submit">Book Appointment</button>
    </form>

    <br>
    <a href="{{ route('user.dashboard') }}" class="link-button" style="background-color: #6c757d;">⬅ Back to Dashboard</a>
@endsection
