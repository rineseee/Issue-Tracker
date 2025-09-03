@extends('layouts.app')

@section('content')
    <style>
        .tags-container {
            max-width: 700px;
            margin: 30px auto;
            font-family: 'Inter', sans-serif;
        }

        .tags-container h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }

        .new-tag-btn {
            display: inline-block;
            margin-bottom: 16px;
            padding: 6px 14px;
            background: #1d4ed8;
            ;

            color: white;
            font-weight: 500;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .new-tag-btn:hover {
            background: #1d4ed8;
            ;
        }

        ul.tags-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul.tags-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fafafa;
        }

        .tag-name {
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }

        .tag-actions {
            display: flex;
            gap: 6px;
        }

        .tag-actions a,
        .tag-actions form button {
            padding: 4px 10px;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        .tag-actions a {
            background-color: #3b82f6;

            color: white;
        }

        .tag-actions a:hover {
            background-color: #2563eb;
        }

        .tag-actions form button {
            background-color: #ef4444;

            color: white;
        }

        .tag-actions form button:hover {
            background-color: #dc2626;
        }
    </style>


    <div class="tags-container">
        <h1>All Tags</h1>
        <a href="{{ route('tags.create') }}" class="new-tag-btn">+ New Tag</a>

        <ul class="tags-list">
            @foreach($tags as $tag)
                <li>
                    <span class="tag-name" style="color: {{ $tag->color ?? '#111827' }}">
                        {{ $tag->name }}
                    </span>
                    <div class="tag-actions">
                        <a href="{{ route('tags.edit', $tag) }}">Edit</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection