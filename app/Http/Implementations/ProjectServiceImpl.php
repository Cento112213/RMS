<?php

namespace App\Http\Implementations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Http\Services\ProjectService;

Class ProjectServiceImpl implements ProjectService
{
    
    public function __construct() {
    }

    public function show()
    {
        $projects = Project::get();

        return response()->json([
            'success' => true,
            'message' => 'Successfully show projects',
            'projects' => $projects
        ], 200);
    }

    public function findByUser($user)
    {
        $projects = User::findOrFail($user)->projects()->get();

        if (!$projects)
        {
            return response()->json([
                'success' => false,
                'message' => 'failed to show projects',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully show projects',
            'projects' => $projects
        ], 200);
    }

    public function create(Request $request)
    {
        Project::create($request->only([
            'title' => 'title',
            'description' => 'description'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Successfully created projects',
        ], 201);
    }

    public function update(Request $request, $project)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $project = Project::findOrFail($project);

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        
        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated project',
        ], 201);
    }

    public function assignUser(Request $request, $project)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id', // Ensure intern IDs are valid
        ]);

        $project = Project::findOrFail($project);

        $project->users()->syncWithoutDetaching($request->input('user_ids'));

        return response()->json([
            'success' => true,
            'message' => 'Successfully assigned to the project',
        ], 201);
    }
}