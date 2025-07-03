<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | MindEase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fdf6f0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 2.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .logo-text {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            color: #7b4f75;
            margin-bottom: 8px;
        }

        h2 {
            font-family: 'Merriweather', serif;
            font-size: 1.4rem;
            color: #4a4a4a;
            margin-bottom: 1.8rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
        }

        button {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .back-btn {
            display: inline-block;
            margin-top: 1.2rem;
            text-decoration: none;
            color: #7b4f75;
            font-weight: bold;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .back-btn:hover {
            color: #ec4899;
        }

        .error-message {
            color: #e63946;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo-text">MindEase</div>
        <h2>🔐 Admin Login</h2>

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Back to Main Page Button -->
        <a href="{{ url('/') }}" class="back-btn">⬅ Back to Main Page</a>
    </div>

</body>
</html>
