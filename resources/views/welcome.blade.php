<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MindEase | Mental Health Portal</title>

    <!-- Professional Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* Base Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fdfdfd;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            padding: 16px 32px;
            background-color: #f5f1fa;
            border-bottom: 1px solid #d4cfe4;
        }

        .header img {
            height: 42px;
            margin-right: 12px;
        }

        .header h1 {
            font-family: 'Merriweather', serif;
            font-size: 1.9rem;
            color: #5c4d7d;
        }

        /* Banner */
        .banner {
            background: url('https://www.thechicagoschool.edu/insightadmin/2020/09/CMHC-Careers-770x404.jpg') no-repeat center center;
            background-size: cover;
            height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }

        .banner h2 {
            font-family: 'Merriweather', serif;
            font-size: 2.6rem;
            color: #fff;
            margin-bottom: 32px;
            text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.4);
        }

        /* Buttons */
        .button-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            text-align: center;
        }

        .button-group a {
            background: linear-gradient(135deg, #e3d7f5, #cde6f9);
            padding: 14px 36px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .button-group a:hover {
            background: linear-gradient(135deg, #d2bdfc, #9ec9f9);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Footer */
        footer {
            background-color: #f5f1fa;
            padding: 16px;
            text-align: center;
            font-size: 0.9rem;
            border-top: 1px solid #d4cfe4;
            color: #555;
            margin-top: auto;
        }

        footer p {
            margin: 6px 0;
        }

        /* Responsive Layout */
        @media (min-width: 768px) {
            .button-group {
                flex-direction: row;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header" role="banner">
        <img src="https://cdn-icons-png.flaticon.com/512/4206/4206320.png" alt="MindEase Logo" />
        <h1>MindEase</h1>
    </header>

    <!-- Banner Section -->
    <section class="banner" aria-label="Welcome Banner">
        <div class="banner-content">
            <h2>Your Trusted Partner in Mental Health and Well-being</h2>
            <div class="button-group">
                <a href="{{ url('/admin/login') }}">Administrator Login</a>
                <a href="{{ url('/doctor/login') }}">Practitioner Login</a>
                <a href="{{ url('/register') }}">Client Sign Up</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer role="contentinfo">
        <p>For inquiries: <a href="mailto:support@mentalhealthportal.com">support@mentalhealthportal.com</a></p>
        <p>Call us: +92 300 1234567</p>
        <p>&copy; 2025 MindEase. All rights reserved.</p>
    </footer>

</body>
</html>
