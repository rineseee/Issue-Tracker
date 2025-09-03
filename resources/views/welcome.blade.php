<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #fff;
        }

        .card {
            background: #ffffff;
            color: #111827;
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 600px;
            width: 90%;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #1d4ed8;
            font-weight: 700;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #6b7280;
        }

        .btn-primary {
            background: #85b1f8;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #0f46bd;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Welcome to Mini Issue Tracker 🚀</h2>
        <p>Manage your projects and issues with ease.</p>
        <a href="/login" class="btn btn-primary">Login</a>
        <br>
        <a href="/register" class="btn btn-primary">Register</a>
    </div>

</body>

</html>