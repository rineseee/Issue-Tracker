@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="fw-bold page-title">Create New Project</h1>
            <p class="text-muted">Fill in the details below to start a new project.</p>
        </div>

        <div class="form-card shadow-sm p-4">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" id="deadline"
                            class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}">
                        @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        body {
            background: #f4f5f7;
            font-family: 'Inter', sans-serif;
        }

        .page-title {
            color: #111827;
            font-size: 1.5rem;
        }

        .form-card {
            background: #ffffff;
            border-radius: 12px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            font-weight: 500;
            color: #4b5563;
            font-size: 0.9rem;
        }

        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 8px 12px;
            background: #f9fafb;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
        }

        .invalid-feedback {
            font-size: 0.8rem;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline-secondary {
            border: 1px solid #d1d5db;
            color: #374151;
            border-radius: 8px;
            padding: 6px 16px;
        }

        .btn-outline-secondary:hover {
            background: #e5e7eb;
        }
    </style>
@endpush