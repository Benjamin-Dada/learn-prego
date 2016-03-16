<?php
namespace Prego\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Prego\Task;
use Prego\Http\Requests;
use Prego\Http\Controllers\Controller;

class ProjectTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postNewTask(Request $request, $id, Task $task)
    {
        $this->validate($request, [
          'task_name' => 'required|min:5',
        ]);

        $task->task_name = $request->input('task_name');
        $task->project_id = $id;

        $task->save();

        return redirect()->back()->with('info', 'Task created successfully');
    }

    public function getOneProjectTask($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)
                      ->where('id', $taskId)
                      ->first();
        return view('tasks.edit')->withTask($task)->with('projectId', $projectId);
    }
    public function updateOneProjectTask(Request $request, $projectId, $taskId)
    {
        $this->validate($request, [
            'task_name'  => 'required|min:3',
        ]);
 
        DB::table('tasks')
            ->where('project_id', $projectId)
            ->where('id', $taskId)
            ->update(['task_name' => $request->input('task_name')]);
 
        return redirect()->back()->with('info','Your Task has been updated successfully');
    }
     public function deleteOneProjectTask($projectId, $taskId)
    {
        DB::table('tasks')
            ->where('project_id', $projectId)
            ->where('id', $taskId)
            ->delete();
 
        return redirect()->route('projects.show')->with('info', 'Task deleted successfully');
    }
}