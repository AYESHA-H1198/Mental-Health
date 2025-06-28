<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'User Portal')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: #fdf6f0;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #a8dadc;
            padding: 1rem 2rem;
            color: #1d3557;
            font-size: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout {
            font-size: 0.9rem;
            background-color: #1d3557;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
        }
        main {
            padding: 2rem;
            max-width: 900px;
            margin: auto;
        }
        form {
            background: #f1faee;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        input, button {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            background-color: #457b9d;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 0.75rem;
            text-align: center;
        }
        th {
            background-color: #f1faee;
        }
        .message {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .link-button {
            background-color: #1d3557;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center;">
    <div>Mental Health Portal</div>
    @if(Route::is('doctor.*'))
        <a href="{{ route('doctor.logout') }}" style="color: #1d3557; text-decoration: none; font-weight: bold;">🚪 Logout</a>
    @elseif(Route::is('user.*'))
        <a href="{{ route('user.logout') }}" style="color: #1d3557; text-decoration: none; font-weight: bold;">🚪 Logout</a>
    @endif
</header>

    <main>
        @yield('content')
    </main>
</body>
</html>
