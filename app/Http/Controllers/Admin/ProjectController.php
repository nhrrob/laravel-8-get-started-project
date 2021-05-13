<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Exception;

class ProjectController extends Controller
{
    public function __construct()
    {
        parent::__construct('project'); //spatie permission
    }
    public function index()
    {
        $data['projects'] = Project::latest()->get();
        return view('admin.project.index', $data);
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(ProjectRequest $request)
    {
        try{
            $project = Project::create($request->all());

            $notification = array(
                'message' => 'Project saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.projects.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('admin.projects.index')->with($notification);
        }
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        $data['project'] = $project;
        return view('admin.project.edit', $data);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        try {
            $project = $project->update($request->all());

            $notification = array(
                'message' => 'Project saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.projects.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.projects.index')->with($notification);
        }
    }

    public function destroy(Project $project)
    {
        try{
            Project::find($project->id)->delete();

            $notification = array(
                'message' => 'Project deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.projects.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.projects.index')->with($notification);
        }
    }
}
