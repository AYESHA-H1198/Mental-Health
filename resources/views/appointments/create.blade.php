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
        <input type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor->DID }}">

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Time</label>
            <select name="appointment_time" id="appointment_time" class="form-control" required>
                <option value="">Select a time slot</option>
            </select>
        </div>

        <button class="btn btn-success">Book Appointment</button>
    </form>

    <a href="{{ route('doctor.appointments', $doctor->DID) }}" class="btn btn-secondary mt-3">⬅ Back</a>
</div>

<script>
    document.getElementById('appointment_date').addEventListener('change', function () {
        const doctorId = document.getElementById('doctor_id').value;
        const date = this.value;
        const timeSelect = document.getElementById('appointment_time');

        timeSelect.innerHTML = '<option>Loading...</option>';

        fetch(`/available-slots?doctor_id=${doctorId}&date=${date}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '';

                if (data.length === 0) {
                    timeSelect.innerHTML = '<option>No slots available</option>';
                } else {
                    data.forEach(slot => {
                        timeSelect.innerHTML += `<option value="${slot}">${slot}</option>`;
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching slots:', error);
                timeSelect.innerHTML = '<option>Error loading slots</option>';
            });
    });
</script>

</body>
</html>
