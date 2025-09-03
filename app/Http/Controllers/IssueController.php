<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        $query = Issue::with('tags');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('id', $request->tag); // ✅ rregulluar nga tag_id → id
            });
        }

        $issues = $query->latest()->get();
        $tags = Tag::all();

        return view('issues.index', compact('issues', 'tags'));
    }

    public function assignUser(Issue $issue, User $user)
    {
        $issue->users()->attach($user->id);

        return response()->json(['message' => 'User assigned successfully']);
    }


    public function removeUser(Issue $issue, User $user)
    {
        $issue->users()->detach($user->id);

        return response()->json(['message' => 'User removed successfully']);
    }


    public function create()
    {
        $projects = Project::all();
        return view('issues.create', compact('projects'));
    }

    public function store(StoreIssueRequest $request)
    {
        Issue::create($request->validated());

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully.');
    }

    public function show(Issue $issue)
    {
        $issue->load(['project', 'tags', 'comments']);

        $allTags = Tag::whereNotIn('id', $issue->tags->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('issues.show', compact('issue', 'allTags'));
    }

    public function edit(Issue $issue)
    {
        $tags = Tag::all();
        return view('issues.edit', compact('issue', 'tags'));
    }


    public function update(Request $request, Issue $issue)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $issue->update($request->only('title', 'description', 'status', 'priority', 'due_date'));


        $issue->tags()->sync($request->input('tags', []));

        return redirect()->route('issues.show', $issue->id)
            ->with('success', 'Issue updated successfully.');
    }


    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully.');
    }


    public function attachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->attach($tag->id);

        return response()->json(['message' => 'Tag attached successfully']);
    }

    public function detachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);

        return response()->json(['message' => 'Tag detached successfully']);
    }
    public function search(Request $request)
    {
        $query = Issue::with('tags');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

        $issues = $query->latest()->limit(10)->get();

        return response()->json($issues);
    }

    public function attachUser(Issue $issue, User $user)
    {
        $issue->users()->attach($user->id);
        return response()->json(['message' => 'User assigned successfully']);
    }


    public function detachUser(Issue $issue, User $user)
    {
        $issue->users()->detach($user->id);
        return response()->json(['message' => 'User unassigned successfully']);
    }


}

