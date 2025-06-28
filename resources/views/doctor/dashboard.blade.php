@extends('layout.user') {{-- Uses the shared layout with top-right logout --}}

@section('title', 'Doctor Dashboard')

@section('content')
    <h2 style="color: #1d3557;">👨‍⚕️ Welcome {{ $doctor->name }}</h2>

    <div style="margin-top: 20px;">
        <h3 style="color: #457b9d;">📅 Your Appointments</h3>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead style="background-color: #f1faee;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px;">Patient</th>
                    <th style="border: 1px solid #ccc; padding: 8px;">Day</th>
                    <th style="border: 1px solid #ccc; padding: 8px;">Time</th>
                    <th style="border: 1px solid #ccc; padding: 8px;">Status</th>
                    <th style="border: 1px solid #ccc; padding: 8px;">Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $app->patient_name }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $app->day }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $app->time }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $app->status ?? 'Pending' }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">
                        <form method="POST" action="{{ route('appointment.updateStatus') }}" style="display: flex; gap: 6px;">
                            @csrf
                            <input type="hidden" name="Anum" value="{{ $app->Anum }}">
                            <select name="status" required style="padding: 4px 8px; border-radius: 6px;">
                                <option value="completed">Completed</option>
                                <option value="missed">Missed</option>
                            </select>
                            <button type="submit" style="background-color: #457b9d; color: white; padding: 6px 12px; border: none; border-radius: 6px;">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
