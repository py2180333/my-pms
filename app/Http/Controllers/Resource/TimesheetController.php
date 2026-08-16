<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Models\Assigntask;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Company;
use App\Models\assignteam;
use App\Models\Resource;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;

class TimesheetController extends Controller
{
    // this for consultant
    function show(){
        
        return view('resource.consultant.timesheet');
    }

    function store(Request $request){

        try {

            // validate in sidebar_timesheet.js

            $data = collect($request->input('hour', []))
            ->filter()
            ->map(function ($hour, $index) use ($request) {
                return [
                    'task_id' => $request->input("assigntask_id.$index"),
                    'date' => $request->input("selected_date.$index"),
                    'hours' => $hour,
                    // 'status' => $request->input("status"), // project manager
                ];
            })
            ->values();

            if ($data->isEmpty()) {
                return redirect()->back()->with('error', 'Please enter at least one hour to submit.');
            }

            // foreach ($data as $i => $d) {
            //     $timesheet = new Timesheet();
            //     $timesheet->assigntask_id = $d['task_id'];
            //     $timesheet->date = $d['date'];
            //     $timesheet->hour = $d['hour'];
            //     $timesheet->save();
            // }

            // if 'assigntask_id' and 'date' is exist than perform updation otherwise create a new row
            foreach ($data as $d) {
                $timesheet = Timesheet::updateOrCreate(
                    [
                        'assigntask_id' => $d['task_id'],
                        'date' => $d['date'],
                    ],
                    [
                        'hours' => $d['hours'],
                        'status' => "pending", // consultant
                        // 'status' => $d['status'], // project manager
                    ]
                );
            }

            // Timesheet::upsert(
            //     $data->map(function ($d) {
            //         return [
            //             'assigntask_id' => $d['task_id'],
            //             'date' => $d['date'],
            //             'hour' => $d['hour'],
            //         ];
            //     })->toArray(),
            //     ['assigntask_id', 'date'], // unique keys
            //     ['hour'] // columns to update if exists
            // );

            return redirect()->back()->with('success', 'Data stored successfully!');

        } catch (Exception $e) {

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // this for project manager
    function showProjectManager(){
        $projectIds = Project::where('project_manager_id', Auth::id())->pluck('id'); // take project manager id from project
        $consultant = Assigntask::whereIn('project_id', $projectIds)
            ->select('consultant_id')
            ->groupBy('consultant_id')
            ->with('consultant:id,first_name,last_name')
            ->get()
            ->pluck('consultant'); // take consultant data
        return view('resource.project_manager.timesheet', compact('consultant'));
    }

    function projectManagerStore(Request $request){

        try {

            // validate in sidebar_timesheet.js

            $data = collect($request->input('hour', []))
            ->filter()
            ->map(function ($hour, $index) use ($request) {
                return [
                    'task_id' => $request->input("assigntask_id.$index"),
                    'date' => $request->input("selected_date.$index"),
                    'hours' => $hour,
                    'status' => $request->input("status"), // project manager
                ];
            })
            ->values();

            $c_id = $request->c_id;
            $fill_date = $request->fill_date;
            
            if ($data->isEmpty()) {
                return redirect()->back()->with([
                    'c_id' => $c_id, 
                    'fill_date' => $fill_date,
                    // 'type' => 'danger',
                    'error' => 'Please enter at least one hour to submit.'
                ]);
            }

            // if 'assigntask_id' and 'date' is exist than perform updation otherwise create a new row
            foreach ($data as $d) {
                $timesheet = Timesheet::updateOrCreate(
                    [
                        'assigntask_id' => $d['task_id'],
                        'date' => $d['date'],
                    ],
                    [
                        'hours' => $d['hours'],
                        'status' => $d['status'] ?? 'pending', // project manager
                    ]
                );
            }

            return redirect()->back()->with([
                'c_id' => $c_id, 
                'fill_date' => $fill_date,
                // 'type' => 'success',
                'success' => 'Data stored successfully!'
            ]);

        }  catch (Exception $e) {

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    function getSidebarTask($id){
        // with(['task:id,task_name'])
        $assigntasks = Assigntask::with(['task:id,task_name', 'project:id,status'])
            ->where('consultant_id', $id)
            ->where('status', '!=', 'Completed')
            ->get(['id', 'task_id', 'project_id']);

        return response()->json(['sidebartasks' => $assigntasks], 200, [], JSON_PRETTY_PRINT); // timesheet_project_manager.js
    }

    function taskRow($at_id, $startDate, $no_of_days){

        $start = Carbon::parse($startDate);
        $dates = collect(range(0, $no_of_days))->map(fn($i) => $start->copy()->addDays($i)->toDateString());

        $assigntask = Assigntask::with([
            'project:id,project_name', 
            'task:id,task_name'
        ])
        ->select('id', 'project_id', 'task_id')
        ->find($at_id);

        foreach ($dates as $date) {

            $dailyEntries[] = [
                'id' => $assigntask->id,
                'date' => $date,
            ];
        }

        $data[] = [
            'id' => $assigntask->id,
            'project_name' => $assigntask->project->project_name,
            'task_name' => $assigntask->task->task_name,
            'dates' => $dailyEntries
        ];

        return response()->json(['tasks' => $data], 200, [], JSON_PRETTY_PRINT); // timesheet_project_manager.js
    }

    public function getTimesheetData($id, $startDate, $no_of_days) {
        $start = Carbon::parse($startDate);

        // Generate list of dates
        $dates = collect(range(0, $no_of_days))->map(
            fn($i) => $start->copy()->addDays($i)->toDateString()
        );

        $dateRange = [$dates->first(), $dates->last()];

        // Load assigntasks with project and task names
        $assigntasks = Assigntask::with(['project:id,project_name', 'task:id,task_name'])
            ->where('consultant_id', $id)
            ->get(['id', 'project_id', 'task_id'])
            ->keyBy('id');

        if ($assigntasks->isEmpty()) {
            return response()->json(['info' => 'assigntasks_empty'], 200, [], JSON_PRETTY_PRINT);
        }

        // Load timesheet entries
        $tsData = Timesheet::whereIn('assigntask_id', $assigntasks->keys())
            ->whereBetween('date', $dateRange)
            ->get(['assigntask_id', 'date', 'hours', 'status']);

        $dateStatus = $this->timeSheetQuater($startDate); // getTimesheetWeekStatus

        if($tsData->isEmpty()){
            return response()->json(['info' => 'timesheet_empty', 'dateStatus' => $dateStatus], 200, [], JSON_PRETTY_PRINT);
        }

        $tsGrouped = $tsData->groupBy('assigntask_id')->map(fn($items) => $items->keyBy('date'));

        // Date-wise total hours and count
        $dateData = Timesheet::selectRaw('date, SUM(hours) as date_total_hours, COUNT(*) as count')
            ->whereIn('assigntask_id', $assigntasks->keys())
            ->whereBetween('date', $dateRange)
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        // Week-wise total hours per assigntask
        $weekData = Timesheet::select('assigntask_id', DB::raw('SUM(hours) as week_total_hours'))
            ->whereIn('assigntask_id', $assigntasks->keys())
            ->whereBetween('date', $dateRange)
            ->groupBy('assigntask_id')
            ->get()
            ->keyBy('assigntask_id');

        // Use first status as fallback if no entry for a task/date
        $defaultStatus = $tsData->first()->status ?? 'NA';

        $result = [];

        foreach ($assigntasks as $assignId => $at) {
            if (!isset($tsGrouped[$assignId]) || $tsGrouped[$assignId]->isEmpty()) {
                continue;
            }

            $dailyData = $dates->map(function ($date) use ($tsGrouped, $assignId, $defaultStatus) {
                $entry = $tsGrouped[$assignId][$date] ?? null;
                return [
                    'date' => $date,
                    'hours' => $entry->hours ?? 'NA',
                    'atId' => $assignId,
                    'status' => $entry->status ?? $defaultStatus,
                ];
            });

            $result[] = [
                'project' => optional($at->project)->project_name,
                'task' => optional($at->task)->task_name,
                'atId' => $assignId,
                'weekTotal' => $weekData[$assignId]->week_total_hours ?? 0,
                'status' => $defaultStatus,
                'entries' => $dailyData,
            ];
        }

        // Build date-wise array
        $dateWiseData = $dates->map(function ($date) use ($dateData) {
            return [
                'date' => $date,
                'hours' => optional($dateData->get($date))->date_total_hours ?? '-NA-',
                'count' => optional($dateData->get($date))->count ?? 0,
            ];
        });

        // Safe numeric sum helper
        $safeSum = fn($indexes) => collect($indexes)->reduce(function ($carry, $i) use ($dateWiseData) {
            return $carry + (is_numeric($dateWiseData[$i]['hours']) ? $dateWiseData[$i]['hours'] : 0);
        }, 0);

        // Summaries
        // $weekendTotal = $safeSum([0, 6]);
        $weekendTotal = 16;
        // $weekdayTotal = $safeSum(range(1, 5));
        $weekdayTotal = $safeSum(range(0, 6));

        return response()->json([
            'dateStatus' => $dateStatus,
            'defaultStatus' => $defaultStatus,
            'result' => $result,
            'dateWiseData' => $dateWiseData,
            'summary' => [
                'total' => $weekendTotal + $weekdayTotal,
                'weekendTotal' => $weekendTotal,
                'weekdayTotal' => $weekdayTotal,
            ],
        ], 200, [], JSON_PRETTY_PRINT);
    }

    private function timeSheetQuater($date) { //getTimesheetWeekStatus

        $today = Carbon::today();
        $givenDate = Carbon::parse($date); // Change as needed

        // Define week boundaries
        $currentStartOfWeek = $today->copy()->startOfWeek(Carbon::SUNDAY);
        $currentEndOfWeek = $today->copy()->endOfWeek(Carbon::SATURDAY);

        // $pastStartOfWeek = $currentStartOfWeek->copy()->subWeek(); // For consultant
        $pastStartOfWeek = $currentStartOfWeek->copy()->subWeeks(4); // For project manager
        $pastEndOfWeek = $currentStartOfWeek->copy()->subDay();

        if ($givenDate->between($pastStartOfWeek, $currentEndOfWeek)) {
            if ($today->isSaturday()) {
                return "current";
            }
            return $givenDate->between($pastStartOfWeek, $pastEndOfWeek) ? "current" : "future";
        }

        if ($givenDate->greaterThan($currentEndOfWeek)) {
            return "future";
        }

        if ($givenDate->lessThan($pastStartOfWeek)) {
            return "past";
        }
    }

    function bulkEditShow(){

        $projectIds = Project::where('project_manager_id', Auth::id())->pluck('id'); // take project manager id from project
        
        $resource = Assigntask::whereIn('project_id', $projectIds)
            ->select('consultant_id')
            ->groupBy('consultant_id')
            ->with('consultant:id,first_name,last_name')
            ->get()
            ->pluck('consultant');

        $project = Assigntask::whereIn('project_id', $projectIds)
            ->select('project_id')
            ->groupBy('project_id')
            ->with('project:id,project_name')
            ->get()
            ->pluck('project');

        return view('resource.project_manager.bulkEdit', compact('project','resource'));
    }

    function bulkEditFilter($projectId, $resourceId, $week, $status){
        $today = Carbon::today();

        // Calculate date range for the selected week
        $start = $today->copy()->startOfWeek(Carbon::SUNDAY)->subWeeks($week)->toDateString();
        $end = $today->copy()->startOfWeek(Carbon::SUNDAY)->subDay()->toDateString();

        // Get filtered assign task IDs from timesheets
        $atIds = Timesheet::where('status', $status)
            ->whereBetween('date', [$start, $end])
            ->pluck('assigntask_id')
            ->unique();

        // Initialize base Assigntask query
        $atQuery = Assigntask::query()
            ->select(['id', 'consultant_id', 'project_id', 'task_id'])
            ->whereIn('id', $atIds)
            ->with([
                'consultant:id,first_name,last_name',
                'project:id,project_name',
                'task:id,task_name'
            ]);

        // Apply dynamic filters
        if ($projectId !== 'all') {
            $atQuery->where('project_id', $projectId);
        } else {
            $projectIds = Project::where('project_manager_id', Auth::id())->pluck('id');
            $atQuery->whereIn('project_id', $projectIds);
        }

        if ($resourceId !== 'all') {
            $atQuery->where('consultant_id', $resourceId);
        }

        // Execute query
        $atData = $atQuery->get();

        return response()->json([
            'atData' => $atData,
            'atIds' => $atData->pluck('id'),
            'status' => $status,
            'start' => $start,
            'end' => $end,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function bulkEditStore(Request $request){

        try {

            // Step 1: Validate request
            $validated = $request->validate([
                'atId' => 'required|array',
                'atId.*' => 'exists:timesheets,assigntask_id', // validate each ID
                'startDate' => 'required|date',
                'endDate' => 'required|date|after:startDate',
                'status' => 'required|in:pending,approve,recheck,reject',
                'allAction' => 'required|in:approve,recheck,reject',
            ]);

            // Step 2: Perform update
            Timesheet::whereIn('assigntask_id', $validated['atId'])
                ->where('status', $validated['status'])
                ->whereBetween('date', [$validated['startDate'], $validated['endDate']])                
                ->update([ 'status' => $validated['allAction'] ]);

            // Step 3: Redirect back with success message
            return back()->with('success', 'Bulk update successful.');
    
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }

    }

    // new -pr 7-7-25
    public function timesheetProjectReport(){
        try {
            // throw new \Exception('this is test error.');

            $companies = Company::select(['id','company_name'])
                ->get();
            return view('Admin.reports.timesheetProjectReport',compact('companies'));

        } catch (\Exception $e){
            \Log::error('Error fetching companies data: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // new -pr 8-7-25
    public function getProjectForProjectReport(Request $request){
        try {

            // throw new \Exception('this is test error.');
            $companyId = $request->company;
            $projects = Project::select(['id', 'project_name'])
                ->where('company_id',$companyId)
                ->get();
            return response()->json([
                'projects' => $projects
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching project data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // new -pr 8-7-25
    public function getResourceForProjectReport(Request $request){
        try {

            // throw new \Exception('this is test error.');
            $projectId = $request->project;

            $consultants = assignteam::select('id', 'consultant_id')
                ->where('project_id',$projectId)
                ->with('consultant:id,first_name,last_name')
                ->get()
                ->transform(fn($assignteam) => $assignteam->consultant);

            $project = Project::select('id', 'customer_id', 'project_name', 'project_value', 'currency', 'start_date', 'status')
                ->where('id', $projectId)
                ->with('customer:id,first_name,last_name')
                ->first();

            $projectManager = Project::select('id', 'project_manager_id')
                ->where('id', $projectId)
                ->with('manager:id,first_name,last_name')
                ->get()
                ->transform(fn($project) => $project->manager);

            return response()->json([
                'consultants' => $consultants,
                'projectManager' => $projectManager,
                'startDate' => $project->start_date,
                'projectName' => $project->project_name,
                'projectValue' => $project->currency.' '.$project->project_value,
                'projectStatus' => ucwords(str_replace('_', ' ', $project->status)),
                'customerName' => $project->customer->first_name.' '.$project->customer->last_name
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching resource data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // new -pr 9-7-25
    public function getTimesheetProjectReport(Request $request){
        try {
            // throw new \Exception('this is test error.');

            $project = $request->project;
            $resource = $request->resource;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $query = Assigntask::query();

            if(empty($project)){
                return response()->json(['error' => 'Project is not selected.'], 400);
                exit();
            } else {
                $query->where('project_id', $project);
            }

            if(!empty($resource) && $resource != 'all'){
                $query->where('consultant_id', $resource);
            }

            $timesheetFilter = function ($q) use ($startDate, $endDate) {
                $q->where('status', 'approve');
                if(!empty($startDate) && !empty($endDate)) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                }
            };

            // whereHas() filter parent record (Assigntask) -> it self
            // with() filter child record (Timesheet) -> another table
            // here => use as array not for annonymous function.
            $query->select('id', 'consultant_id', 'milestone_id', 'task_id')->whereHas('timesheet', $timesheetFilter)
                ->withSum(['timesheet' => $timesheetFilter], 'hours')
                ->with([
                    'consultant:id,first_name,last_name,role', 
                    'milestone:id,milestone_name', 
                    'task:id,task_name'
                ]);

            // http://192.168.29.65:8000/admin/reports/get-timesheet-project-report?project=3&resource=4&startDate=2025-05-01&endDate=2025-05-02
            // dd($query->get(), $startDate,$endDate);
            // dd($startDate,$endDate);

            $data = $query->get()->transform(fn($assigntask) => [
                'resource' => $assigntask->consultant->first_name.' '.$assigntask->consultant->last_name.' ('.ucwords(str_replace('_', ' ', $assigntask->consultant->role)).')',
                'milestone' => $assigntask->milestone->milestone_name,
                'task' => $assigntask->task->task_name,
                'hours' => $assigntask->timesheet_sum_hours
            ]);

            // echo '<pre>'.json_encode($data, JSON_PRETTY_PRINT).'</pre>';
            // echo $data[0]->consultant->first_name;

            return response()->json([
                'report' => $data
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching project report data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // new -pr 7-7-25
    public function timesheetResourceReport(){
        try {
            // throw new \Exception('this is test error.');

            $companies = Company::select(['id','company_name'])
                ->get();
            return view('Admin.reports.timesheetResourceReport',compact('companies'));

        } catch (\Exception $e){
            \Log::error('Error fetching companies data: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // new -pr 11-7-25
    public function getResourceForResourceReport(Request $request){
        try {

            // throw new \Exception('this is test error.');
            $companyId = $request->company;
            $resource = Resource::select('id', 'first_name', 'last_name', 'role')
                ->whereHas('ResourceCompany', fn($q) => $q->where('companies.id',$companyId))
                ->get()
                ->transform(fn($res) => [
                    'id' => $res->id,
                    'name' => $res->first_name.' '.$res->last_name.' ('.ucwords(str_replace('_', ' ', $res->role)).')',
                    'role' => $res->role
                ]);
            return response()->json([
                'resource' => $resource
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching resource data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // new -pr 11-7-25
    public function getProjectForResourceReport(Request $request){
        try {

            // throw new \Exception('this is test error.');
            $resourceId = $request->resourceId;
            $role = $request->role;

            if($role === 'consultant') {
                $project = assignteam::select('id', 'project_id')
                    ->where('consultant_id',$resourceId)
                    ->with('project:id,project_name')
                    ->get()
                    ->transform(fn($assignteam) => $assignteam->project);
            } else if ($role === 'project_manager') {
                $project = Project::select('id', 'project_name')
                    ->where('project_manager_id', $resourceId)
                    ->get();
            } else {
                $project = collect();
            }

            $resource = Resource::select('id', 'first_name', 'last_name', 'status', 'payment_type', 'rate', 'created_at')
                ->with('ResourceCompany:id,company_name')
                ->findOrFail($resourceId);

            return response()->json([
                'project' => $project,
                'resourceName' => $resource->first_name.' '.$resource->last_name,
                'resourceStatus' => ucwords(str_replace('_', ' ', $resource->status)),
                'salary' => $resource->rate.' / '.$resource->payment_type,
                'startDate' => $resource->created_at->format('Y-m-d'),
                'companies' => $resource->ResourceCompany->pluck('company_name')->toArray()
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching project data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // new -pr 11-7-25
    public function getTimesheetResourceReport(Request $request){
        try {
            // throw new \Exception('this is test error.');

            $resource = $request->resource;
            $project = $request->project;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $query = Assigntask::query();

            // resource value to filter assigntask
            if(empty($resource)){
                return response()->json(['error' => 'Resource is not selected.'], 400);
                exit();
            } else {
                $query->where('consultant_id', $resource);
            }

            // project value to filter assigntask
            if(!empty($project) && $project != 'all'){
                $query->where('project_id', $project);
            }

            // Date value to filter timesheet
            $timesheetFilter = function ($q) use ($startDate, $endDate) {
                $q->where('status', 'approve');
                if(!empty($startDate) && !empty($endDate)) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                }
            };

            // whereHas() filter parent record (Assigntask) -> it self
            // with() filter child record (Timesheet) -> another table
            // here => use as array not for annonymous function.
            $query->select('id', 'project_id', 'milestone_id', 'task_id')->whereHas('timesheet', $timesheetFilter)
                ->withSum(['timesheet' => $timesheetFilter], 'hours')
                ->with([
                    'project:id,project_name,status', 
                    'milestone:id,milestone_name', 
                    'task:id,task_name'
                ]);

            // http://192.168.29.65:8000/admin/reports/get-timesheet-resource-report?resource=4&project=3&startDate=2025-05-01&endDate=2025-05-02
            // dd($query->get(), $startDate,$endDate);
            // dd($startDate,$endDate);

            // now get data and filter only requried data
            $data = $query->get()->transform(fn($assigntask) => [
                'project' => $assigntask->project->project_name.' ('.ucwords(str_replace('_', ' ', $assigntask->project->status)).')',
                'milestone' => $assigntask->milestone->milestone_name,
                'task' => $assigntask->task->task_name,
                'hours' => $assigntask->timesheet_sum_hours
            ]);

            // echo '<pre>'.json_encode($data, JSON_PRETTY_PRINT).'</pre>';
            // echo $data[0]->consultant->first_name;

            // calculate project hours
            // $projectHours = Timesheet::where('status', 'approve')
            //     ->when((!empty($startDate) && !empty($endDate)), function ($query) use ($startDate, $endDate){
            //         $query->whereBetween('date', [$startDate, $endDate]);
            //     })
            //     ->whereHas('assigntask', function ($query) use ($resource) {
            //         $query->where('consultant_id', $resource);
            //     })
            //     ->sum('hours');

            // calculate project hours
            $projectHours = $data->sum(fn($item) => (float) $item['hours']);

            // calculate weekend hours
            if(empty($resource)){
                return response()->json(['error' => 'Resource is not selected.'], 400);
                exit();
            } else {

                // project selected
                if(!empty($project) && $project != 'all'){
                    $date = Timesheet::select('date')
                        ->where('status', 'approve')
                        ->whereHas('assigntask', function ($query) use ($project, $resource) {
                            $query->where('project_id', $project)
                                ->where('consultant_id', $resource);
                        })
                        ->orderBy('date', 'asc')
                        ->get()
                        ->pluck('date');
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $start = Carbon::parse($date->first())->endOfDay()->startOfWeek()->toDateString();
                    $end = Carbon::parse($date->last())->endOfDay()->endOfWeek()->toDateString();
                    $weekendHours = $this->weekendHours($start, $end);
                    // dd($date->first(), $date->last(), $weekendHours, $start, $end);
                } else {
                
                    // Date selected
                    if(!empty($startDate) && !empty($endDate)) {
                        $weekendHours = $this->weekendHours($startDate, $endDate);
                    } else {
                        // resource selected
                        $start = Resource::select('created_at')
                            ->where(['id' => $resource])
                            ->get()
                            ->pluck('created_at')
                            ->first();
                        $end = Carbon::today();
                        $weekendHours = $this->weekendHours($start, $end);
                        // dd($start, $end, $weekendHours);
                    }
                }                
            }

            return response()->json([
                'report' => $data,
                'projectHours' => $projectHours,
                'weekendHours' => $weekendHours,
                'totalHours' => ($projectHours + $weekendHours)
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching resource report data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function weekendHours($sDate, $eDate) {
        $startDate = Carbon::parse($sDate)->endOfDay();
        $endDate = Carbon::parse($eDate)->endOfDay();
        $period = CarbonPeriod::create($startDate, $endDate);
        $sun_sat = collect($period)
            ->filter(fn($date) => 
                $date->isSunday()||$date->isSaturday()
            )->count();
        $weekendHours = $sun_sat * 8;

        // echo $startDate.'<br>';
        // echo $endDate.'<br>';
        // echo $period.'<br>';
        // echo $sun_sat.'<br>';

        return $weekendHours;
    }

    // new -pr 24-7-25
    public function timesheetCompanyReport(){
        try {
            // throw new \Exception('this is test error.');

            $companies = Company::select(['id','company_name'])
                ->get();
            return view('Admin.reports.timesheetCompanyReport',compact('companies'));

        } catch (\Exception $e){
            \Log::error('Error fetching companies data: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // new -pr 24-7-25
    public function getTimesheetCompanyReport(Request $request){
        try {
            // throw new \Exception('this is test error.');

            $companyId = $request->company;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            if(empty($companyId)){
                return response()->json(['message' => 'Company is not selected.'], 400);
                exit();
            }

            $company = Company::select('company_name', 'email', 'address', 'pan_number', 'gst_number', 'phone_number')
                ->where(['id' => $companyId])->first();

            // Date value to filter timesheet
            $timesheetFilter = function ($q) use ($startDate, $endDate) {
                $q->where('status', 'approve');
                if(!empty($startDate) && !empty($endDate)) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                }
            };

            // whereHas() filter parent record (Project) -> it self
            // with() filter child record (Timesheet) -> another table
            // here => use as array not for annonymous function.
            $project = Project::select('id', 'project_name', 'status', 'start_date', 'end_date')
                ->where('company_id', $companyId)
                ->whereHas('assigntask.timesheet', $timesheetFilter)
                ->with(['assigntask' => function ($q) use ($timesheetFilter) {
                    $q->whereHas('timesheet')->withSum(['timesheet' => $timesheetFilter], 'hours');
                }])
                ->get()->transform(fn($project) => [
                    'project_name' => $project->project_name,
                    'status' => ucwords(str_replace('_', ' ', $project->status)),
                    'start_date' => $project->start_date,
                    'end_date' => $project->end_date,
                    'total_hours' => $project->assigntask->sum('timesheet_sum_hours'),
                ]);

            if ($project->isEmpty()) {
                return response()->json([
                    'company' => $company,
                    'message' => 'No projects found.'
                ]);
            }

            return response()->json([
                'company' => $company,
                'project' => $project
            ], 200);

        } catch (\Exception $e){
            \Log::error('Error fetching company report data: '.$e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}