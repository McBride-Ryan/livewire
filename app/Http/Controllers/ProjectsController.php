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
        // Validation
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Excellent to separate the validation for Middleware purposes
        // A User must be signed-in in order to make a project
        $attributes['owner_id'] = auth()->id();

        // When the UserFactory is called there is no place to store
        // the field type 'name' in the Users model. Plan accordingly

        // Persist the Data
        auth()->user()->projects()->create($attributes);

        // Sanity Check if you want to see what comes back in $attributes
//        dd($attributes);

        // Persist the Data
        // Project::create($attributes);


        // Redirect the User
        return redirect('/projects');
    }
}
