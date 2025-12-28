<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page Not Found | CSPD</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-box {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 80px;
            margin: 0;
            color: #003580;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #003580;
            color: #fff;
            padding: 10px 25px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="error-box">
        <h1>404</h1>
        <p>The page you are looking for does not exist.</p>

        <a href="{{ url('/admin') }}">Go to Home</a>
    </div>

</body>
</html>
