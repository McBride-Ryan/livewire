<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Route model binding allows you to auto inject that project
    // associated with that wild card as a parameter into the show() method.
    // Check the web.php /projects/{project}
    public function show(Project $project)
    {

        // Before the Route/Model Binding --> Cool HUH!
        // $project = Project::findOrFail(request('project'));
        return view('projects.show', compact('project'));

    }

    public function store()
    {
        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

//        FYI all the tests will fail at this point because the $attributes is looking to require an owner_id
        $attributes['owner_id'] = auth()->id();

        //persist
        Project::create($attributes);


        //redirect
        return redirect('/projects');
    }
}
