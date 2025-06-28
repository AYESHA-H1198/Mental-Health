<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Book Appointment for Dr. {{ $doctor->name }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="appointment_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Time</label>
            <input type="time" name="appointment_time" class="form-control" required>
        </div>

        <button class="btn btn-success">Book Appointment</button>
    </form>

    <a href="{{ route('doctor.appointments', $doctor->id) }}" class="btn btn-secondary mt-3">⬅ Back</a>
</div>
</body>
</html>
