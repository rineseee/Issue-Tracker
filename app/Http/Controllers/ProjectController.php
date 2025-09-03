<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }
    public function edit(Project $project)
    {
        $this->authorize('update', $project); // vetëm krijuesi mund ta editojë

        return view('projects.edit', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);

        // krijo projekt për userin e kyçur
        $request->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
    public function show(Project $project)
    {
        $project->load([
            'issues.tags',
            'issues.comments',
        ]);

        return view('projects.show', compact('project'));
    }
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }



    public function search(Request $request)
    {
        $query = Project::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('name', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        }

        $projects = $query->latest()->limit(10)->get();

        return response()->json($projects);
    }

}
