<?php

namespace App\Http\Services;
use Illuminate\Http\Request;

interface ProjectService
{

    public function __construct();

    public function show();

    public function findByUser($user);

    public function create(Request $request);
    
    public function update(Request $request, $project);

    public function assignUser(Request $request, $project);
}
