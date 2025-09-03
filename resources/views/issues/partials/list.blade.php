<tbody>
    @forelse ($issues as $issue)
        <tr>
            <td>{{ $issue->title }}</td>
            <td>{{ ucfirst($issue->status) }}</td>
            <td>{{ ucfirst($issue->priority) }}</td>
            <td>
                @foreach($issue->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>{{ $issue->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No issues found.</td>
        </tr>
    @endforelse
</tbody>