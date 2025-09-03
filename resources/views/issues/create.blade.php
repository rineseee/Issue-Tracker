@extends('layouts.app')

@section('title', 'Create Issue')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold page-title">Create New Issue</h1>
    </div>

    <div class="form-card">
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label for="project_id" class="form-label">Project</label>
                <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="2">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    @foreach(['open' => 'Open', 'in_progress' => 'In Progress', 'closed' => 'Closed'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                    @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                        <option value="{{ $value }}" {{ old('priority') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('priority')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}">
                @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .page-title {
            color: #e5e7eb;
            font-size: 1.2rem;
        }

        .form-card {
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px 14px;
            max-width: 520px;
            margin: 0 auto;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.8rem;
            margin-bottom: 2px;
        }

        .form-control,
        .form-select {
            background: #f9fafb;
            border: 1px solid #d1d5db;
            color: #111827;
            border-radius: 4px;
            padding: 4px 6px;
            font-size: 0.85rem;
            height: 32px;
        }

        textarea.form-control {
            min-height: 60px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px rgba(59, 130, 246, 0.2);
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            padding: 4px 10px;
            font-size: 0.8rem;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #e5e7eb;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            font-size: 0.8rem;
            color: #111827;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }
    </style>
@endpush