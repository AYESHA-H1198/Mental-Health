@extends('layout.user')

@section('title', 'User Dashboard')

@section('content')
    <h2>Welcome, {{ $user->name ?? $user->email }}!</h2>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <h3>🩺 Available Doctors</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doc)
            <tr>
                <td>{{ $doc->name }}</td>
                <td>{{ $doc->phone }}</td>
                <td>{{ $doc->email }}</td>
                <td><a href="{{ route('appointment.form', $doc->DID) }}" class="link-button">Book</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 2rem;">📅 Your Appointments</h3>
    <table>
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Day</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->doctor_name }}</td>
                <td>{{ $appointment->day }}</td>
                <td>{{ $appointment->time }}</td>
                <td>{{ $appointment->status ?? 'Pending' }}</td>
                <td>
                    <a href="{{ route('payment.form', $appointment->Anum) }}" class="link-button">Pay</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

  
@endsection
