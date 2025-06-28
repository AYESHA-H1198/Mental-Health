<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mental Health Portal')</title>
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
            padding: 1rem;
            text-align: center;
            color: #1d3557;
            font-size: 1.5rem;
        }
        main {
            padding: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #f1faee;
        }
        button, input[type="submit"] {
            background-color: #457b9d;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        a {
            color: #1d3557;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

    @yield('styles')
</head>
<body>
    <header>
        Mental Health Counselling Portal
    </header>
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
