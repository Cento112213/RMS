<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProjectService;


class ProjectController extends Controller
{
    public function __construct(public ProjectService $projectService) {
    }

    public function show()
    {
        return $this->projectService->show();
    }

    public function findByUser($user)
    {
        return $this->projectService->findByUser($user);
    }

    public function create(Request $request)
    {
        return $this->projectService->create($request);
    }

    public function update(Request $request, $project)
    {
        return $this->projectService->update($request, $project);
    }

    public function assignUser(Request $request, $project)
    {
        return $this->projectService->assignUser($request, $project);
    }
}
