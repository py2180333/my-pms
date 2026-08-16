<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\milestone;
use App\Models\Project;
use App\Models\Task;
use App\Models\Assigntask;
use App\Models\assignteam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AssignTaskNotification;
use App\Models\Resource;

class AssignTaskController extends Controller
{
    //show all task
    public function index(){
        $assigntasks = Assigntask::all();
        $projects = Project::select(['id','project_name'])->get(); // pr

        return view('Admin.assigntask.index',compact('assigntasks','projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all(); // Get all projects
        $milestones = milestone::all();
        $tasks = Task::all();
        $assignteams = assignteam::all();
        return view('Admin.assigntask.create', compact('projects','milestones','tasks','assignteams'));
    }
    public function getMilestones($project_id)
    {
        $milestones = Milestone::where('project_id', $project_id)->get();
        return response()->json($milestones);
    }

    public function getTasks($milestone_id)
    {
        $tasks = Task::where('milestone_id', $milestone_id)->get();
        return response()->json($tasks);
    }
    // public function getResources($project_id) // rd
    public function getResources(Request $request) // pr change 24-9-25
    {
        // pr change 24-9-25
        $project_id = $request->project_id;
        $milestone_id = $request->milestone_id;
        $task_id = $request->task_id;

        $assign_task_resources_id = Assigntask::select('consultant_id')
            ->where('project_id', $project_id)
            ->where('milestone_id', $milestone_id)
            ->where('task_id', $task_id)
            ->groupBy('consultant_id')
            ->get()
            ->pluck('consultant_id')
            ->toArray();
        // /pr

        //$resources = assignteam::where('project_id', $project_id)->with('consultant')->get();
        $resources = assignteam::where('project_id', $project_id)
            ->whereNotIn('consultant_id', $assign_task_resources_id) // pr change 24-9-25
            ->with(['consultant', 'project.manager'])
            ->get();

        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            return response()->json(['resources' => $resources]);
            exit();
        }
        // /pr

        // pranav
        $resourcesPM = assignteam::select(['project_id'])
            ->where('project_id', $project_id)
            ->whereNotIn('consultant_id', $assign_task_resources_id) // pr change 24-9-25
            ->with(['project.manager'])
            ->groupBy('project_id')
            ->get();
        // dd($resourcesPM);
        //  return response()->json($resources); // RD
        return response()->json(['resources' => $resources, 'resourcesPM' => $resourcesPM]);
    }
    // pr add 17-10-25
    public function getResourcesForFilter($project_id) // pr change 24-9-25
    {
        $resources = assignteam::where('project_id', $project_id)
            ->with(['consultant', 'project.manager'])
            ->get();

        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            return response()->json(['resources' => $resources]);
            exit();
        }
        // /pr

        // pranav
        $resourcesPM = assignteam::select(['project_id'])
            ->where('project_id', $project_id)
            ->with(['project.manager'])
            ->groupBy('project_id')
            ->get();
        // dd($resourcesPM);
        //  return response()->json($resources); // RD
        return response()->json(['resources' => $resources, 'resourcesPM' => $resourcesPM]);
    }
    public function getResourceDetails($consultant_id, $role) // pr add role 25-9-25
    {
        if($role === 'consultant' || (Auth::check() && Auth::user()->role === 'project_manager')){ // pr add if else if 25-9-25
            // Fetch the assignteam record based on the consultant_id
            $data = assignteam::with('consultant')
                ->where('consultant_id', $consultant_id)
                ->first();
            $resource = $data->consultant;
        } else if($role === 'project_manager'){
            // pr add 25-9-25
            $resource = Resource::where('role', 'project_manager')
                ->findOrFail($consultant_id);
        }

        // Check if the resource exists
        if ($resource) {
            // Return only consultant details as JSON
            return response()->json($resource);
        } else {
            // Return a 404 response if the consultant is not found
            return response()->json(['message' => 'Resource not found'], 404);
        }
    }
    public function store(Request $request){
        //validate incoming request
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'milestone_id' => 'required|exists:milestones,id',
            'task_id' => 'required|exists:tasks,id',
            'resource_id' => 'required|exists:resources,id',
            'status' => 'required',
            'notes' => 'nullable|max:255',
        ]);

        $createdByEmail = Auth::user()->email;
        //store data in database
        $assigntask = Assigntask::create([
            'project_id' => $validatedData['project_id'],
            'milestone_id' => $validatedData['milestone_id'],
            'task_id' => $validatedData['task_id'],
            'consultant_id' => $validatedData['resource_id'],
            'status' => $validatedData['status'],
            'comments' => $validatedData['notes'],
            'created_by' => $createdByEmail,
        ]);

        // send assign task notification to resources. new pr 18-8-25
        $project = Project::select('project_name')->findOrFail($validatedData['project_id']);
        $milestone = milestone::select('milestone_name')->findOrFail($validatedData['milestone_id']);
        $task = Task::select('task_name')->findOrFail($validatedData['task_id']);
        Resource::findOrFail($validatedData['resource_id'])->notify(new AssignTaskNotification($project, $milestone, $task, 'assign'));

        // // pr
        // if(Auth::check() && Auth::user()->role === 'project_manager'){
        //     return redirect()->route('resource.assigntask.create')->with('success', 'Task assigned to resource successfully!');
        // }
        // // /pr

        // // Redirect back with success message
        // return redirect()->route('admin.assigntask.create')->with('success', 'Task assigned to resource successfully!');

        return redirect()->back()->with('success', 'Task assigned to resource successfully!');
    }
    public function getAssignedTasks($task_id)
    {
        $assignedTasks = Assigntask::where('task_id', $task_id)
                        ->with(['project', 'consultant','task'])
                        ->get()
                        ->map(function ($task) {
                            return [
                                'project_name' => $task->project->project_name,
                                'task_name' => $task->milestone->milestone_name ?? 'N/A',
                                'consultant_name' => $task->consultant->first_name . ' ' . $task->consultant->last_name,
                                'consultant_email' => $task->consultant->email,
                                'id' => $task->id,
                                'task_name' => $task->task->task_name,
                            ];
                        });

        return response()->json($assignedTasks);
    }
    public function deleteAssignedTask($id)
    {
        $assignedTask = Assigntask::find($id);

        // send assign task notification to resources. new pr 18-8-25
        $project = Project::select('project_name')->findOrFail($assignedTask->project_id);
        $milestone = milestone::select('milestone_name')->findOrFail($assignedTask->milestone_id);
        $task = Task::select('task_name')->findOrFail($assignedTask->task_id);
        Resource::findOrFail($assignedTask->consultant_id)->notify(new AssignTaskNotification($project, $milestone, $task, 'remove'));

        if ($assignedTask) {
            $assignedTask->forceDelete();
            return redirect()->back()->with('success', 'Remove successfully');
        }

        return redirect()->back()->with('error', 'Failed to Remove AssignTask: ' . $e->getMessage());
    }

    //update assigntask
    public function update(Request $request, string $id){
        // Validate incoming request
        // dd($request->all());
        $validatedData = $request->validate([
            'status' => 'required',
        ]);
        //dd($validatedData);
        $assigntask = Assigntask::findOrFail($id);
        //update task in database
        $assigntask->update([
            'status' => $validatedData['status'],
        ]);
        // // pr
        // if(Auth::check() && Auth::user()->role === 'project_manager'){
        //     return redirect()->route('resource.assigntask.index')->with('success', 'Assigntask Updated successfully!');
        // }
        // // /pr
        // return redirect()->route('admin.assigntask.index')->with('success', 'Assigntask Updated successfully!');
        
        return redirect()->back()->with('success', 'Assigntask Updated successfully!');
    }

    // pr
    function pmIndex(){
        $projects = Project::select(['id','project_name'])
            ->where('project_manager_id',Auth::id())
            ->get();
        $assigntasks = Assigntask::whereIn('project_id',$projects->pluck('id'))->get();
        return view('resource.project_manager.assigntask.index',compact('assigntasks','projects'));
    }

    public function pmCreate()
    {
        $projects = Project::select(['id','project_name'])
            ->where('project_manager_id',Auth::id())
            ->get();
        return view('resource.project_manager.assigntask.create', compact('projects'));
    }

    function filter(Request $request){
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $status = $request->status;
            $projectId = $request->project_id;
            $milestoneId = $request->milestone_id;
            $taskId = $request->task_id;
            $resourceId = $request->resource_id;

            // Fetch assigntask based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = Assigntask::with('task');
            } else {
                $dateQuery = Assigntask::whereHas('task', function($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date',[$startDate, $endDate]);
                })->with('task');
            }

            // Fetch assigntask based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $dateQuery;
            } else {
                $statusQuery = $dateQuery->where('status',$status);
            }

            // Fetch assigntask based on selected project
            if ($projectId == 'all' || empty($projectId)) {
                $projectQuery = $statusQuery->with('project');
            } else {
                $projectQuery = $statusQuery->where('project_id',$projectId)->with('project');
            }

            // Fetch assigntask based on selected milestone
            if ($milestoneId == 'all' || empty($milestoneId)) {
                $milestoneQuery = $projectQuery->with('milestone');
            } else {
                $milestoneQuery = $projectQuery->where('milestone_id',$milestoneId)->with('milestone');
            }

            // Fetch assigntask based on selected task
            if ($taskId == 'all' || empty($taskId)) {
                $taskQuery = $milestoneQuery;
            } else {
                $taskQuery = $milestoneQuery->where('task_id',$taskId);
            }

            // Fetch assigntask based on selected resources
            if ($resourceId == 'all' || empty($resourceId)) {
                $atTask = $taskQuery->with('consultant')->get();
            } else {
                $atTask = $taskQuery->where('consultant_id',$resourceId)->with('consultant')->get();
            }

            $todo = $atTask->where('status', 'To Do')->count();
            $progress = $atTask->where('status', 'In Progress')->count();
            $completed = $atTask->where('status', 'Completed')->count();
            
            return response()->json([
                'count' => $atTask->count(),
                'todo' => $todo,
                'progress' => $progress,
                'completed' => $completed,
                'data' => $atTask,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching task: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    function pmFilter(Request $request){
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $status = $request->status;
            $projectId = $request->project_id;
            $milestoneId = $request->milestone_id;
            $taskId = $request->task_id;
            $resourceId = $request->resource_id;

            // Fetch assigntask based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = Assigntask::with('task');
            } else {
                $dateQuery = Assigntask::whereHas('task', function($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date',[$startDate, $endDate]);
                })->with('task');
            }

            // Fetch assigntask based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $dateQuery;
            } else {
                $statusQuery = $dateQuery->where('status',$status);
            }

            // Fetch assigntask based on selected project
            if ($projectId == 'all' || empty($projectId)) {
                $projectIds = Project::where('project_manager_id',Auth::id())
                    ->pluck('id');
                $projectQuery = $statusQuery->whereIn('project_id',$projectIds)->with('project');
            } else {
                $projectQuery = $statusQuery->where('project_id',$projectId)->with('project');
            }

            // Fetch assigntask based on selected milestone
            if ($milestoneId == 'all' || empty($milestoneId)) {
                $milestoneQuery = $projectQuery->with('milestone');
            } else {
                $milestoneQuery = $projectQuery->where('milestone_id',$milestoneId)->with('milestone');
            }

            // Fetch assigntask based on selected task
            if ($taskId == 'all' || empty($taskId)) {
                $taskQuery = $milestoneQuery;
            } else {
                $taskQuery = $milestoneQuery->where('task_id',$taskId);
            }

            // Fetch assigntask based on selected resources
            if ($resourceId == 'all' || empty($resourceId)) {
                $projectIds = Project::where('project_manager_id',Auth::id())
                    ->pluck('id');
                
                $resourceIds = assignteam::select('consultant_id')
                    ->whereIn('project_id',$projectIds)
                    ->with('consultant')
                    ->groupBy('consultant_id')
                    ->pluck('consultant_id'); // show consultants
                
                $resourceIds->push(Auth::id()); // show project manager
                $atTask = $taskQuery->whereIn('consultant_id',$resourceIds)->with('consultant')->get();
            } else {
                $atTask = $taskQuery->where('consultant_id',$resourceId)->with('consultant')->get();
            }

            $todo = $atTask->where('status', 'To Do')->count();
            $progress = $atTask->where('status', 'In Progress')->count();
            $completed = $atTask->where('status', 'Completed')->count();
            
            return response()->json([
                'count' => $atTask->count(),
                'todo' => $todo,
                'progress' => $progress,
                'completed' => $completed,
                'data' => $atTask,
            ]);

        } catch (\Exception $e) {
            \Log::error('Error fetching task: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    function filterResources(){
        $consultants = assignteam::select('consultant_id') // pr
            ->with('consultant')
            ->groupBy('consultant_id')
            ->get();

        $projectManager = assignteam::select('project_id') // pr
            ->with('project.manager')
            ->get()
            ->map(fn($a) => $a->project->manager)
            ->unique('id')
            ->values();

        return response()->json(['consultants' => $consultants, 'projectManager' => $projectManager]);
    }

    function pmFilterResources(){
        $projectIds = Project::where('project_manager_id',Auth::id())
            ->pluck('id');
        $consultants = assignteam::select('consultant_id') // pr
            ->whereIn('project_id',$projectIds)
            ->with('consultant')
            ->groupBy('consultant_id')
            ->get();
        return response()->json(['consultants' => $consultants]);
    }
}
