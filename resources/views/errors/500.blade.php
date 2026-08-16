<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>500 - Server error</title>
    <style>
        body {
            background: #f8fafc;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        h1 {
            font-size: 80px;
            margin-bottom: 20px;
            color: #ff6b6b;
        }
        p {
            font-size: 24px;
            margin-bottom: 30px;
        }
        a {
            text-decoration: none;
            color: #3490dc;
            font-weight: bold;
            font-size: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>500</h1>
    <p>Oops! Server not respond Please Try again letter.</p>
    <a href="{{ url('/') }}">Go back to Home</a>
</body>
</html>
