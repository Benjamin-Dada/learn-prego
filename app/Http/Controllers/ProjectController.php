<?php

namespace Prego\Http\Controllers;

use Illuminate\Http\Request;

use Prego\Project;

use Prego\Task;

use Prego\File;

use Prego\Comment;

use Prego\Collaboration;

use Auth;

use Prego\Http\Requests;

class ProjectController extends Controller
{
    public function index()
 {
     $projects = Project::personal()->get();
     return view('projects.index')->withProject($projects);
 }

  public function create()
 {
        return view('projects.new');
 }
  public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:3',
            'due-date' => 'required|date|after:today',
            'notes'    => 'required|min:10',
            'status'   => 'required'
        ]);

        $project = new Project;
        $project->project_name   = $request->input('name');
        $project->project_status = $request->input('status');
        $project->due_date       = $request->input('due-date');
        $project->project_notes  = $request->input('notes');
        $project->user_id        = Auth::user()->id;

        $project->save();

        return redirect()->route('projects.index')->with('info','Your Project has been created successfully');
    }
    
    public function show($id)
    {
        $project = Project::find($id);
        $tasks = $this->getTasks($id);
        $files = $this->getFiles($id);
        $comments = $this->getComments($id);
        $collaborators = $this->getCollaborators($id);

        return view('projects.show')
                ->withProject($project)
                ->withTasks($tasks)
                ->withFiles($files)
                ->withComments($comments)
                ->withcCollaborators($collaborators);

    }
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit')->withProject($project);    
    }
    public function update($id)
    {
        $project = Project::findOrFail($id);
        $this->validate($request, [
            'project_name'     => 'required|min:3',
            'due-date' => 'required|date|after:today',
            'project_notes'    => 'required|min:10',
            'project_status'   => 'required'
        ]);

        $values = $request->all();
        $project->fill($values)->save();

        return redirect()->back()->with('info','Your Project has been updated successfully');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('info', 'Project deleted successfully');
    }

    public function getTasks($id)
    {
        $tasks =  Task::project($id)->get();
        return $tasks;
    }

    public function getFiles($id)
    {
        $files =  File::project($id)->get();
        return $files;
    }

    public function getComments($id)
    {
        $comments = Comment::project($id)->get();
        return $comments;
    }

    public function getCollaborators($id)
    {
        $collaborators = Collaboration::project($id)->get();
        return $collaborators;
    }
}
