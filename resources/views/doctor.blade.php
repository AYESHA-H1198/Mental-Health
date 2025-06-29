@extends('layout.user')

@section('title', 'Available Doctors')

@section('content')
    <style>
        h2 {
            text-align: center;
            color: #1d3557;
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #a78bfa;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td {
            color: #333;
        }

        a {
            display: inline-block;
            background-color: #6c757d;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            background-color: #5a6268;
        }
    </style>

    <h2>Available Doctors</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Book</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->email }}</td>
                <td><a href="{{ route('appointment.form', $doctor->DID) }}">Book Appointment</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
