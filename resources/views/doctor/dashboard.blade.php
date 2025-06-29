@extends('layout.user') {{-- Uses the shared layout with top-right logout --}}

@section('title', 'Doctor Dashboard')

@section('content')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        h2, h3 {
            font-family: 'Merriweather', serif;
        }
    </style>

    <h2 style="color: #7b4f75; font-size: 2rem; margin-bottom: 1rem;">
        👨‍⚕️ Welcome, {{ $doctor->name }}
    </h2>

    <div style="margin-top: 20px;">
        <h3 style="color: #457b9d; font-size: 1.4rem; margin-bottom: 10px;">📅 Your Appointments</h3>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
            <thead style="background-color: #fce3ec;">
                <tr style="color: #4a4a4a;">
                    <th style="padding: 12px;">Patient</th>
                    <th style="padding: 12px;">Day</th>
                    <th style="padding: 12px;">Time</th>
                    <th style="padding: 12px;">Status</th>
                    <th style="padding: 12px;">Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                <tr style="text-align: center; font-family: 'Roboto', sans-serif;">
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $app->patient_name }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $app->day }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $app->time }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">
                        <span style="background-color: #f1faee; padding: 6px 12px; border-radius: 20px; display: inline-block; font-weight: bold;">
                            {{ $app->status ?? 'Pending' }}
                        </span>
                    </td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">
                        <form method="POST" action="{{ route('appointment.updateStatus') }}" style="display: flex; gap: 10px; align-items: center; justify-content: center;">
                            @csrf
                            <input type="hidden" name="Anum" value="{{ $app->Anum }}">
                            <select name="status" required style="padding: 6px 10px; border-radius: 10px; border: 1px solid #ccc; font-size: 0.95rem; font-family: 'Roboto', sans-serif;">
                                <option value="completed">Completed</option>
                                <option value="missed">Missed</option>
                            </select>
                            <button type="submit" style="background: linear-gradient(135deg, #fce3ec, #e0c3fc); color: #4a4a4a; font-weight: bold; padding: 6px 16px; border: none; border-radius: 20px; cursor: pointer; transition: 0.3s; font-family: 'Roboto', sans-serif;">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
