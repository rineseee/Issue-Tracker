@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Issues</h1>
            <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <a href="{{ route('issues.create') }}" class="btn btn-primary mb-3">+ New Issue</a>


        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search issues...">
        </div>


        <form id="filters-form" method="GET" action="{{ route('issues.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">-- All --</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select name="priority" id="priority" class="form-select">
                        <option value="">-- All --</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label for="tag" class="form-label">Tag</label>
                    <select name="tag" id="tag" class="form-select">
                        <option value="">-- All --</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary mt-md-4">Filter</button>
                </div>
            </div>
        </form>


        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Tags</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="issues-container">
                    @include('issues.partials.list', ['issues' => $issues])
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let timer;
        const searchInput = document.getElementById('search');
        const filtersForm = document.getElementById('filters-form');
        const container = document.getElementById('issues-container');

        function fetchIssues() {
            const formData = new FormData(filtersForm);
            let params = new URLSearchParams(formData);
            if (searchInput.value) {
                params.append('search', searchInput.value);
            }

            fetch(`{{ route('issues.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;
                });
        }

        searchInput.addEventListener('keyup', function () {
            clearTimeout(timer);
            timer = setTimeout(fetchIssues, 300);
        });

        filtersForm.addEventListener('change', fetchIssues);


        document.getElementById('sidebarToggle').addEventListener('click', () => {
            document.body.classList.toggle('sidebar-open');
        });
    </script>

    <style>
        body.sidebar-open #sidebar {
            transform: translateX(0);
        }

        #sidebar {
            transition: transform 0.3s ease;
            transform: translateX(-100%);
        }

        @media (min-width: 768px) {
            #sidebar {
                transform: translateX(0);
            }
        }
    </style>
@endsection