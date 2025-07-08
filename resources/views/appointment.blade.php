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
        input[type="time"],
        select,
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background-color: #fefefe;
            transition: 0.3s ease;
        }

        input:focus, select:focus {
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
                <option value="">-- Select Date First --</option>
            </select>

            <label for="mode">Session Type:</label>
            <select name="mode" id="mode" required onchange="toggleSessionDetails()">
                <option value="">-- Choose --</option>
                <option value="Online">Online</option>
                <option value="Physical">Physical</option>
            </select>

            <div id="onlineSection" style="display: none; margin-top: 10px;">
                <label for="onlineEmail">Your Email for Online Session:</label>
                <input type="email" name="onlineEmail" id="onlineEmail">
            </div>

            <div id="physicalSection" style="display: none; margin-top: 10px; color: #1d3557;">
                <p><strong>Clinic Address:</strong> 3rd Floor, ABC Mental Health Center, Peshawar</p>
            </div>

            <button type="submit">Book Appointment</button>
        </form>

        <br>
        <a href="{{ route('user.dashboard') }}" class="link-button">⬅ Back to Dashboard</a>
    </div>
@endsection

@section('scripts')
<script>
    const doctorId = document.querySelector('input[name="DID"]').value;
    const dateInput = document.getElementById('day');
    const timeSelect = document.getElementById('time');

    dateInput.addEventListener('change', function () {
        const date = this.value;
        const dayOfWeek = new Date(date).getDay();

        if (dayOfWeek === 0 || dayOfWeek === 6) {
            alert("Appointments cannot be booked on weekends.");
            this.value = '';
            timeSelect.innerHTML = '<option value="">-- Select a Valid Date --</option>';
            return;
        }

        timeSelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`/available-slots?doctor_id=${doctorId}&date=${date}`)
            .then(response => response.json())
            .then(slots => {
                timeSelect.innerHTML = '';
                if (slots.length === 0) {
                    timeSelect.innerHTML = '<option value="">No slots available</option>';
                } else {
                    slots.forEach(slot => {
                        const opt = document.createElement('option');
                        opt.value = slot;
                        opt.textContent = convertTo12Hour(slot);
                        timeSelect.appendChild(opt);
                    });
                }
            })
            .catch(err => {
                console.error(err);
                timeSelect.innerHTML = '<option value="">Error loading slots</option>';
            });
    });

    function convertTo12Hour(time) {
    const [h, m, s] = time.split(':'); // works for HH:MM or HH:MM:SS
    const hour = parseInt(h, 10);
    const suffix = hour >= 12 ? 'PM' : 'AM';
    const hour12 = hour % 12 === 0 ? 12 : hour % 12;
    return `${hour12}:${m} ${suffix}`;
}

    function toggleSessionDetails() {
        const mode = document.getElementById('mode').value;
        document.getElementById('onlineSection').style.display = mode === 'Online' ? 'block' : 'none';
        document.getElementById('physicalSection').style.display = mode === 'Physical' ? 'block' : 'none';
    }
</script>
@endsection
