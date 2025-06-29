<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'User Portal')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fdf6f0;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #fce3ec;
            padding: 1rem 2rem;
            color: #4a4a4a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .logo-text {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            color: #7b4f75;
        }

        .logout {
            font-size: 0.9rem;
            background: linear-gradient(135deg, #c3aed6, #a0c4ff);
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout:hover {
            background: linear-gradient(135deg, #a0c4ff, #c3aed6);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        main {
            padding: 2rem;
            max-width: 900px;
            margin: auto;
        }

        form {
            background: #fef6fb;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 15px rgba(0,0,0,0.06);
        }

        input, button {
            display: block;
            width: 100%;
            margin-bottom: 1.2rem;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: #b5838d;
            box-shadow: 0 0 5px #e0aaff;
        }

        button {
            background: linear-gradient(135deg, #fce3ec, #e0c3fc);
            color: #333;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #eab6cc, #d1a3ff);
            color: white;
        }

        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #eee;
            padding: 1rem;
            text-align: center;
        }

        th {
            background-color: #f1faee;
            color: #333;
        }

        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            font-weight: bold;
        }

        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }

        .link-button {
            background-color: #7b4f75;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            transition: 0.3s;
        }

        .link-button:hover {
            background-color: #5d3a5a;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo-text">MindEase</div>
        @if(Route::is('doctor.*'))
            <a href="{{ route('doctor.logout') }}" class="logout">🚪 Logout</a>
        @elseif(Route::is('user.*'))
            <a href="{{ route('user.logout') }}" class="logout">🚪 Logout</a>
        @endif
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

</body>
</html>
