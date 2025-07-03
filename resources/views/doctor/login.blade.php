<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login | MindEase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fdf6f0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 90%;
            max-width: 420px;
            text-align: center;
        }

        .logo-text {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
            margin-bottom: 10px;
        }

        .login-container h2 {
            font-family: 'Merriweather', serif;
            font-size: 1.4rem;
            margin-bottom: 30px;
            color: #4a4a4a;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 500;
            color: #333;
            font-size: 0.95rem;
            margin-top: 1rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
            outline: none;
        }

        .error-message {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 24px;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        @media screen and (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo-text">MindEase</div>
    <h2>Doctor Login</h2>

    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ url('/doctor/login') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>

        <button type="submit">Login</button>
    </form>
    <a href="{{ url('/') }}" class="back-btn">⬅ Back to Main Page</a>
</div>

</body>
</html>
