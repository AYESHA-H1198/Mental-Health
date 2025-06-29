@extends('layout.user')

@section('title', 'User Login')

@section('content')
    <style>
        .login-wrapper {
            max-width: 480px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            text-align: center;
            color: #a855f7;
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
            padding: 10px 12px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="login-wrapper">
        <h2>🔐 User Login</h2>

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
    </div>
@endsection
