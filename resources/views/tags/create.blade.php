@extends('layouts.app')

@section('content')
    <style>
        .form-container {
            max-width: 420px;
            margin: 60px auto;
            background: #ffffff;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .form-container h1 {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 28px;
            color: #1f2937;
        }

        .form-container label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            color: #374151;
            font-size: 14px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 15px;
            background-color: #f9fafb;
            transition: all 0.25s;
        }

        .form-container input[type="text"]:focus {
            border-color: #6366f1;
            background-color: #fff;
            box-shadow: 0 0 6px rgba(99, 102, 241, 0.3);
            outline: none;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #1d4ed8;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.25s;
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