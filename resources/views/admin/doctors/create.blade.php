<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>

    <!-- Google Font -->
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
        input[type="email"] {
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
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Add New Doctor</h1>

        @if($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Doctor Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <button type="submit">➕ Add Doctor</button>
        </form>
    </div>

</body>
</html>
