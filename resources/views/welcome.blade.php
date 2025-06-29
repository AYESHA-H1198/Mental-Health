<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MindEase</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #fff;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            background-color: #fef1f6;
            border-bottom: 1px solid #e4c8d3;
        }

        .header img {
            height: 40px;
            margin-right: 10px;
        }

        .header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            color: #7b4f75;
        }

        /* Banner Image Section */
        .banner {
            background: url('https://www.thechicagoschool.edu/insightadmin/2020/09/CMHC-Careers-770x404.jpg') no-repeat center center;
            background-size: cover;
            height: 85vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* dark overlay */
            z-index: 0;
        }

        .banner-content {
            position: relative;
            z-index: 1;
        }

        .banner h2 {
            font-family: 'Pacifico', cursive;
            font-size: 2.7rem;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #fce3ec, #c8d8e4, #e0c3fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.7);
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .button-group a {
            background: linear-gradient(135deg, #fce3ec, #e0c3fc);
            color: #4a4a4a;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .button-group a:hover {
            background: linear-gradient(135deg, #eab6cc, #d1a3ff);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Footer */
        footer {
            background-color: #fef1f6;
            text-align: center;
            padding: 15px;
            font-size: 0.9rem;
            border-top: 1px solid #e3cfe4;
            color: #555;
        }

        footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="https://cdn-icons-png.flaticon.com/512/4206/4206320.png" alt="Logo">
        <h1>MindEase</h1>
    </div>

    <!-- Banner Section -->
    <div class="banner">
        <div class="banner-content">
            <h2>Mental Health Counselling Portal</h2>
            <div class="button-group">
                <a href="{{ url('/admin/login') }}">Admin</a>
                <a href="{{ url('/doctor/login') }}">Doctor</a>
                <a href="{{ url('/register') }}">User</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>Contact us: support@mentalhealthportal.com</p>
        <p>Phone: +92 300 1234567</p>
        <p>© 2025 MindEase | All rights reserved</p>
    </footer>

</body>
</html>
