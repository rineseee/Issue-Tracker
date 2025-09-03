@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold page-title">{{ $project->name }}</h1>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="project-card mb-4 shadow-sm">
        <p class="mb-3 text-muted">{{ $project->description }}</p>
        <p class="mb-1"><strong>Start:</strong> {{ $project->start_date }}</p>
        <p class="mb-0"><strong>Deadline:</strong>
            <span class="badge badge-deadline">
                {{ $project->deadline }}
            </span>
        </p>
    </div>


    <div class="issues-section">
        <h3 class="fw-semibold mb-3">Issues</h3>

        @if($project->issues->count())
            <div class="list-group list-group-flush">
                @foreach($project->issues as $issue)
                    <a href="{{ route('issues.show', $issue) }}"
                        class="list-group-item issue-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold">{{ $issue->title }}</span>
                            <small class="d-block text-muted">
                                {{ ucfirst($issue->status) }} · Priority: {{ ucfirst($issue->priority) }}
                            </small>
                        </div>
                        <span class="badge badge-status {{ strtolower($issue->status) }}">
                            {{ ucfirst($issue->status) }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-muted">No issues for this project yet. 🎉</p>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .page-title {
            color: #111827;
            font-size: 1.8rem;
            font-family: 'Inter', sans-serif;
        }


        .project-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .project-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }


        .badge-deadline {
            background: #e5e7eb;
            color: #374151;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }


        .issue-item {
            background: #f9fafb;
            border: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            color: #111827;
            text-decoration: none;
        }

        .issue-item:hover {
            background: #f3f4f6;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }


        .badge-status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            color: #fff;
            min-width: 70px;
            text-align: center;
        }

        .badge-status.open {
            background-color: #3b82f6;

        }

        .badge-status.inprogress {
            background-color: #f59e0b;

        }

        .badge-status.closed {
            background-color: #10b981;

        }


        .btn-secondary {
            background: #e5e7eb;
            border: none;
            border-radius: 8px;
            color: #111827;
            padding: 6px 14px;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            color: #111827;
        }


        .text-muted {
            color: #6b7280 !important;
        }
    </style>
@endpush