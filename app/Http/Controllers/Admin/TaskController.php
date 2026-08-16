<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\milestone;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Assigntask;

class TaskController extends Controller
{
    //show all task
    public function index(){
        $tasks = Task::all();
        $projects = Project::select(['id','project_name'])->get(); // pr
        return view('Admin.tasks.index',compact('tasks','projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all(); // Get all projects
        $milestones = Milestone::all();
        return view('Admin.tasks.create', compact('projects','milestones'));
    }

    //fetching project based milestore
    public function getMilestonesByProject($projectId)
    {
        $milestones = Milestone::where('project_id', $projectId)->get();
        return response()->json($milestones);
    }

    //store task
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'milestone_id' => 'nullable|exists:milestones,id',
            'task_name' => 'required|string|max:255',
            'task_discription' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'estimate_hours' => 'required|numeric|min:0',
            'dependencies' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $createdByEmail = Auth::user()->email;
        // Create a new Task record
        $task = Task::create([
            'project_id' => $validatedData['project_id'],
            'milestone_id' => $validatedData['milestone_id'],
            'task_name' => $validatedData['task_name'],
            'task_description' => $validatedData['task_discription'],
            'priority' => $validatedData['priority'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'estimated_hours' => $validatedData['estimate_hours'],
            'dependencies' => $validatedData['dependencies'],
            'comments' => $validatedData['notes'],
            'created_by' => $createdByEmail, // Assuming tasks are created by logged-in users
        ]);

        // pr
            if(Auth::check() && Auth::user()->role === 'project_manager'){
                return redirect()->route('resource.tasks.index')->with('success', 'Task created successfully!');
            }
        // /pr

        // Redirect back with success message
        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully!');
    }
    //update task
    public function update(Request $request, string $id){
        // Validate incoming request
       // dd($request->all());
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'estimated_hours' => 'required|numeric|min:0',
            'dependencies' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);
        //dd($validatedData);
        $updatedBy = Auth::user()->email;
        $task = Task::findOrFail($id);
        //update task in database
            $task->update([
                'task_name' => $validatedData['task_name'],
                'task_description' => $validatedData['description'],
                'priority' => $validatedData['priority'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'estimated_hours' => $validatedData['estimated_hours'],
                'dependencies' => $validatedData['dependencies'],
                'comments' => $validatedData['comments'],
                'status' => $validatedData['status'],
                'updated_at' => $updatedBy, // Assuming tasks are updated by logged-in users
            ]);

            // // pr
            // if(Auth::check() && Auth::user()->role === 'project_manager'){
            //     return redirect()->route('resource.tasks.index')->with('success', 'Task Updated successfully!');
            // }
            // // /pr

            // return redirect()->route('admin.tasks.index')->with('success', 'Task Updated successfully!');   

            // pr add 17-10-25
            return redirect()
                ->back()
                ->with('success', 'Task Updated successfully!');   
    }
    //delete task
    public function forceDelete($id)
    {
        $task = Task::find($id);
        if($task){
            $task->forceDelete();

            // // pr
            // if(Auth::check() && Auth::user()->role === 'project_manager'){
            //     return redirect()->route('resource.tasks.index')->with('success', 'task deleted successfully.');
            // }
            // // /pr

            // return redirect()->route('admin.tasks.index')->with('success', 'task deleted successfully.');

            // pr add 17-10-25
            return redirect()
                ->back() 
                ->with('success', 'task deleted successfully.');
        }

        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            return redirect()->route('resource.tasks.index')->with('error', 'task not found');
        }
        // /pr

        return redirect()->route('admin.tasks.index')->with('error', 'task not found');
    }

    // pr
    // show task
    public function resIndex(){

        if(Auth::check() && Auth::user()->role === 'project_manager'){
            $projects = Project::where('project_manager_id', Auth::id())
                ->select(['id', 'project_name'])
                ->get();
            $tasks = Task::whereIn('project_id', $projects->pluck('id'))->get();
            return view('resource.tasks.index',compact('tasks','projects'));
        }

        $tasks = Assigntask::where('consultant_id',Auth::id())
            ->with('task')
            ->get()
            ->pluck('task');

        return view('resource.tasks.index',compact('tasks'));
    }

    function pmCreate(){
        $projects = Project::select(['id','project_name'])
            ->where('project_manager_id',Auth::id())
            ->get();
        // $milestones = Milestone::select(['id','milestone_name'])
        //     ->whereIn('project_id',$projects->pluck('id'))
        //     ->get();
        return view('resource.tasks.create', compact('projects'));
    }

    function filter(Request $request){
        try {
            // $startDate = $request->startDate;
            // $endDate = $request->endDate;
            // $priority = $request->priority;
            // $status = $request->status;
            // $projectId = $request->project_id;
            // $milestoneId = $request->milestone_id;

            // pr add 17-10-25
            $startDate = $request->query('startDate');
            $endDate = $request->query('endDate');
            $priority = $request->query('priority');
            $status = $request->query('status');
            $projectId = $request->query('project_id');
            $milestoneId = $request->query('milestone_id');

            // Fetch task based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = Task::query();
            } else {
                $dateQuery = Task::whereBetween('start_date', [$startDate, $endDate]);
            }

            if(Auth::check() && Auth::user()->role === 'project_manager'){
                $projectIds = Project::where('project_manager_id', Auth::id())->pluck('id');
                $dateQuery = $dateQuery->whereIn('project_id', $projectIds);
            }

            // Fetch task based on selected priority
            if ($priority == 'all' || empty($priority)) {
                $priorityQuery = $dateQuery;
            } else {
                $priorityQuery = $dateQuery->where('priority',$priority);
            }

            // Fetch task based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $priorityQuery;
            } else {
                $statusQuery = $priorityQuery->where('status',$status);
            }

            // Fetch task based on selected project
            if ($projectId == 'all' || empty($projectId)) {
                $tasks = $statusQuery->with(['project:id,project_name','milestone:id,milestone_name'])->get();
            } else {
                $projectQuery = $statusQuery->where('project_id',$projectId);

                // Fetch task based on selected milestone
                if ($milestoneId == 'all' || empty($milestoneId)) {
                    $tasks = $projectQuery->with(['project:id,project_name','milestone:id,milestone_name'])->get();
                } else {
                    $tasks = $projectQuery->where('milestone_id',$milestoneId)->with(['project:id,project_name','milestone:id,milestone_name'])->get();
                }
            }

            $todo = $tasks->where('status', 'To Do')->count();
            $progress = $tasks->where('status', 'In Progress')->count();
            $completed = $tasks->where('status', 'Completed')->count();
            
            return response()->json([
                'count' => $tasks->count(),
                'todo' => $todo,
                'progress' => $progress,
                'completed' => $completed,
                'data' => $tasks,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching task: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
