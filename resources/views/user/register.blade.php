@extends('layout.user')

@section('title', 'User Registration')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafc;
            color: #333;
        }

        .registration-wrapper {
            max-width: 520px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .logo-text {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
            text-align: center;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            color: #5c4d7d;
            font-family: 'Merriweather', serif;
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        .message.error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .message.error ul {
            margin: 0;
            padding-left: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .link-button {
            display: block;
            max-width: 200px;
            margin: 20px auto 0 auto;
            background-color: #6c757d;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            font-size: 0.95rem;
            transition: background-color 0.3s ease;
        }

        .link-button:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="registration-wrapper">
        <h1 class="logo-text">MindEase</h1>
        <h2>Create Your Account</h2>

        @if ($errors->any())
            <div class="message error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <a href="{{ route('user.dashboard') }}" class="link-button">← Back to Dashboard</a>
    </div>
@endsection
