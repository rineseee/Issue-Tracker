@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold page-title">Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary px-3">+ New Project</a>
        </div>

        <div class="row g-4">
            @forelse($projects as $project)
                <div class="col-sm-6 col-lg-4">
                    <div class="project-card p-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-semibold mb-0">
                                <a href="{{ route('projects.show', $project) }}" class="project-link">
                                    {{ $project->name }}
                                </a>
                            </h5>
                            <span class="badge-deadline">
                                {{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}
                            </span>
                        </div>
                        <p class="small text-muted mb-3">Start:
                            {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</p>

                        <div class="d-flex gap-2">
                            @can('update', $project)
                                <a href="{{ route('projects.edit', $project) }}"
                                    class="btn btn-warning btn-sm d-flex align-items-center gap-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            @endcan

                            @can('delete', $project)
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No projects found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #f4f5f7;
            font-family: 'Inter', sans-serif;
        }

        .page-title {
            color: #111827;
            font-size: 1.6rem;
        }

        .project-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .project-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .project-link {
            color: #1d4ed8;
            text-decoration: none;
            transition: 0.2s;
        }

        .project-link:hover {
            color: #2563eb;
        }

        .badge-deadline {
            background: #e0e7ff;
            color: #1e3a8a;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-warning {
            background: #fbbf24;
            border: none;
            color: #111827;
            transition: 0.2s;
        }

        .btn-warning:hover {
            background: #f59e0b;
        }

        .btn-danger {
            background: #ef4444;
            border: none;
            color: #ffffff;
            transition: 0.2s;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-sm i {
            font-size: 0.85rem;
        }
    </style>
@endpush