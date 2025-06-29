<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login | MindEase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        /* Reset + Box sizing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fdf6f0;
            font-family: 'Open Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-box {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 90vw;              /* Responsive width */
            max-width: 400px;         /* Prevents overflow on large screens */
        }

        .login-box h2 {
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #c084fc, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        label {
            font-weight: bold;
            color: #333;
            font-size: 0.95rem;
            margin-bottom: 6px;
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            color: #333;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 6px rgba(167, 139, 250, 0.4);
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            background: linear-gradient(135deg, #ec4899, #a78bfa);
            color: white;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #d946ef, #7c3aed);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .error-message {
            color: #d32f2f;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 10px;
        }

        @media screen and (max-width: 480px) {
            .login-box {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
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
</div>

</body>
</html>
