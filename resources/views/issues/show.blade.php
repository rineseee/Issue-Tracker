@extends('layouts.app')

@section('content')
    <style>
        .issue-container {
            max-width: 800px;
            margin: 40px auto;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            padding: 0 16px;
        }

        .issue-container h1 {
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .issue-container p {
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 4px;
        }

        /* Tags */
        #tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: #e5e7eb;
            color: #111827;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 14px;
            flex-shrink: 0;
        }

        .tag-badge button {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0 6px;
            font-size: 12px;
            cursor: pointer;
        }

        .tag-badge button:hover {
            background-color: #dc2626;
        }

        #attach-tag-form {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        #attach-tag-form select,
        #attach-tag-form button {
            flex: 1;
            min-width: 100px;
        }

        /* Comments */
        #comments-list>div {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 10px;
        }

        #comment-form {
            margin-top: 12px;
        }

        #comment-form input,
        #comment-form textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        #comment-form button {
            padding: 8px 16px;
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }

        #comment-form button:hover {
            background-color: #059669;
        }

        /* Assigned Users */
        #assigned-users li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9fafb;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 6px;
        }

        #assigned-users li button {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 12px;
            cursor: pointer;
        }

        #assigned-users li button:hover {
            background-color: #dc2626;
        }

        #assign-user-form {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        #assign-user-form select,
        #assign-user-form button {
            flex: 1;
            min-width: 100px;
        }

        #assign-user-form button {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        #assign-user-form button:hover {
            background-color: #2563eb;
        }

        /* Back Button */
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 14px;
            background-color: #6b7280;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            width: 100%;
        }

        .btn-back:hover {
            background-color: #4b5563;
        }


        @media (max-width: 768px) {
            .issue-container h1 {
                font-size: 22px;
            }

            .section-title {
                font-size: 18px;
            }

            #attach-tag-form,
            #assign-user-form {
                flex-direction: column;
                align-items: stretch;
            }
        }

        @media (max-width: 480px) {
            .issue-container {
                margin: 20px auto;
                padding: 0 10px;
            }

            .btn-back {
                font-size: 14px;
                padding: 8px 12px;
            }
        }
    </style>

    <div class="issue-container">
        <h1>{{ $issue->title }}</h1>
        <p>{{ $issue->description }}</p>

        <p><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
        <p><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
        <p><strong>Due Date:</strong> {{ $issue->due_date }}</p>

        <div class="section-title">Tags</div>
        <div id="tags-list">
            @foreach($issue->tags as $tag)
                <span class="tag-badge" style="background-color: {{ $tag->color ?? '#e5e7eb' }};">
                    {{ $tag->name }}
                    <button class="btn-detach-tag" data-tag-id="{{ $tag->id }}">x</button>
                </span>
            @endforeach
        </div>

        <form id="attach-tag-form">
            @csrf
            <select id="tag_id">
                @foreach($allTags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <button type="submit">Attach</button>
        </form>

        <div class="section-title">Comments</div>
        <div id="comments-list">
            @foreach($issue->comments as $comment)
                <div>
                    <strong>{{ $comment->author_name }}</strong>
                    <p>{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>

        <form id="comment-form">
            @csrf
            <input type="text" name="author_name" placeholder="Your name">
            <textarea name="body" placeholder="Write a comment"></textarea>
            <button type="submit">Add Comment</button>
        </form>
        <form id="assign-user-form">
            @csrf
            <select name="user_id" id="user_id">
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button type="submit">Assign</button>
        </form>

        <a href="{{ route('issues.index') }}" class="btn-back">Back</a>
    </div>
@endsection

@section('scripts')
    <script>
        const issueId = "{{ $issue->id }}";


        document.getElementById('attach-tag-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let tagId = document.getElementById('tag_id').value;

            fetch(`/issues/${issueId}/tags/${tagId}/attach`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(res => res.json()).then(() => location.reload());
        });


        document.querySelectorAll('.btn-detach-tag').forEach(btn => {
            btn.addEventListener('click', function () {
                let tagId = this.dataset.tagId;
                fetch(`/issues/${issueId}/tags/${tagId}/detach`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                }).then(res => res.json()).then(() => location.reload());
            });
        });


        document.getElementById('comment-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch(`/issues/${issueId}/comments`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: formData
            }).then(res => res.json()).then(data => {
                if (data.comment) {
                    let div = document.createElement('div');
                    div.innerHTML = `<strong>${data.comment.author_name}</strong><p>${data.comment.body}</p>`;
                    document.getElementById('comments-list').prepend(div);
                    this.reset();
                }
            });
        });

        // Assign User
        document.getElementById('assign-user-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let userId = document.getElementById('user_id').value;

            fetch(`/issues/${issueId}/assign-user/${userId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(res => res.json()).then(data => {
                if (data.message) {
                    let li = document.createElement('li');
                    li.innerHTML = `${document.getElementById('user_id').selectedOptions[0].text} <button class="remove-user" data-id="${userId}">Remove</button>`;
                    document.getElementById('assigned-users').appendChild(li);
                }
            });
        });

        // Remove User
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-user')) {
                let userId = e.target.dataset.id;
                fetch(`/issues/${issueId}/remove-user/${userId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(res => res.json()).then(() => e.target.closest('li').remove());
            }
        });


    </script>
@endsection