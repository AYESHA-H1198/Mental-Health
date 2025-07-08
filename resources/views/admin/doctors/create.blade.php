<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbeaff, #e0f7fa);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .top-bar {
            width: 100%;
            padding: 20px 40px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .back-button {
            background-color: #6a1b9a;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-button:hover {
            background-color: #4a148c;
        }

        .form-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h1 {
            text-align: center;
            color: #7e57c2;
            margin-bottom: 25px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #7e57c2;
            box-shadow: 0 0 8px #cba5f5;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #7e57c2;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #6a1b9a;
        }

        .error-list {
            color: #d32f2f;
            list-style: none;
            padding-left: 0;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- 🔙 Back to Dashboard button -->
    <div class="top-bar">
        <a href="{{ route('admin.dashboard') }}" class="back-button">← Back to Dashboard</a>
    </div>

    <div class="form-container">
        <h1>Add New Doctor</h1>

        {{-- Success message --}}
        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Doctor Name" value="{{ old('name') }}" required>
            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Set Password" required>
            <button type="submit">➕ Add Doctor</button>
        </form>
    </div>

</body>
</html>
