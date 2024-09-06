<?php

namespace App\Http\Controllers;
use App\Models\ProjectDetail;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectEvaluatorController extends Controller
{
    public function index()
    {
        $projectDetails = ProjectDetail::all();

        return view('project_details.index', compact('projectDetails'));
    }

    public function show(ProjectDetail $projectDetail)
    {
        return view('project_details.show', compact('projectDetail'));
    }
}
