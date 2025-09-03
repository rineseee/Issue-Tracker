@extends('layouts.app')

@section('content')
    <style>
        .form-container {
            max-width: 420px;
            margin: 60px auto;
            background: linear-gradient(135deg, #f9fafb, #eef2f7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            font-family: 'Inter', sans-serif;
        }

        .form-container h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .form-container label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #34495e;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
            transition: 0.3s;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 6px #3498db;
            outline: none;
        }

        .form-container textarea {
            resize: none;
            min-height: 100px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #1d4ed8;
            ;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        .form-container button:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="form-container">
        <h1>Create Tag</h1>
        <form method="POST" action="{{ route('tags.store') }}">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" required placeholder="Enter tag name">

            <label for="color">Color (Hex)</label>
            <input type="text" name="color" placeholder="#1e40af">

            <button type="submit">Save Tag</button>
        </form>
    </div>
@endsection