@extends('layout.user')

@section('title', 'User Login')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafc;
            color: #333;
        }

        .login-wrapper {
            max-width: 480px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
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
            transition: 0.3s ease;
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

    <div class="login-wrapper">
        <h1 class="logo-text">MindEase</h1>
        <h2>User Login</h2>

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <a href="{{ url('/') }}" class="link-button">← Back to Home</a>
    </div>
@endsection