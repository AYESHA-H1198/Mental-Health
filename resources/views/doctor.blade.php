@extends('layout.user')

@section('title', 'Available Doctors')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #5c4d7d;
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            text-align: center;
            border: 1px solid #e0e0e0;
            font-size: 0.95rem;
        }

        th {
            background: linear-gradient(135deg, #c4b5fd, #a5b4fc);
            color: white;
            font-weight: 600;
            font-family: 'Roboto', sans-serif;
        }

        tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        td {
            color: #444;
        }

        a.appointment-button {
            background-color: #6c63ff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
        }

        a.appointment-button:hover {
            background-color: #5a54d1;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 20px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                background: white;
                border-radius: 10px;
                padding: 10px;
            }

            td {
                border: none;
                text-align: left;
                padding: 10px 15px;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 4px;
                color: #5c4d7d;
            }
        }
    </style>

    <h2>Our Available Mental Health Practitioners</h2>

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
                <td data-label="Name">{{ $doctor->name }}</td>
                <td data-label="Phone">{{ $doctor->phone }}</td>
                <td data-label="Email">{{ $doctor->email }}</td>
                <td data-label="Book">
                    <a href="{{ route('appointment.form', $doctor->DID) }}" class="appointment-button">
                        Book Appointment
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
