<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\assignteam;
use App\Models\Project;
use App\Models\Resource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AssignTeamNotification; // new pr 12-8-25


class AssignTeamController extends Controller
{
    public function create(Request $request)
    {
        $assignteams = AssignTeam::all();
        $projects = Project::all();
        $consultantRole = 'consultant';
        
        // Get the project ID from the request (if available)
        $projectId = $request->input('project_id');

        // Fetch resources based on role and filter out those already assigned to the project
        if ($projectId) {
            $assignedResourceIds = AssignTeam::where('project_id', $projectId)->pluck('consultant_id')->toArray();
            $resources = Resource::where('role', $consultantRole)
                                ->whereNotIn('id', $assignedResourceIds)
                                ->whereNull('deleted_at')
                                ->get();
        } else {
            $resources = Resource::where('role', $consultantRole)
            ->whereNull('deleted_at')
            ->get();
        }
        
        return view('Admin.projects.assignteam', compact('assignteams', 'projects', 'resources'));
    }
    public function store( Request $request){
        //dd($request->all());
        //dd($request->all(), Auth::user());
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'team_id' => 'required|exists:resources,id',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $createdByEmail = Auth::user()->email;
        //dd($createdByEmail);
        $assignment = AssignTeam::create([
            'project_id' => $request->project_id,
            'consultant_id' => $request->team_id,
            'status' => $request->status,
            
            'description' => $request->description,
            'created_by' => $createdByEmail,
        ]);

        // send notification to resources->consultant new pr 12-8-25
        $project = Project::select('project_name')->findOrFail($request->project_id); // new pr 12-8-25
        Resource::findOrFail($request->team_id)->notify(new AssignTeamNotification($project, 'assign')); // new pr 12-8-25
        
        return redirect()->back()->with('success', 'Team Assigned successfully');
    }
    // Method in AssignTeamController
    public function getAvailableConsultants(Request $request)
    {
        $projectId = $request->input('project_id');
        $consultantRole = 'consultant';
        
        $assignedResourceIds = AssignTeam::where('project_id', $projectId)->pluck('consultant_id')->toArray();
        $companyId = Project::where('id', $projectId)->pluck('company_id')->first(); // pr

        $resources = Resource::where('role', $consultantRole)
                            ->whereNotIn('id', $assignedResourceIds)
                            ->whereHas('ResourceCompany', function ($query) use ($companyId) {
                                $query->where('companies.id', $companyId);
                            }) // pr
                            ->get();

        return response()->json($resources);
    }
    public function getAssignedConsultants(Request $request)
    {
        $projectId = $request->input('project_id');
        $assignedConsultants = AssignTeam::where('project_id', $projectId)
                                        ->with('consultant', 'project')
                                        ->get();

        return response()->json($assignedConsultants);
    }
    
    //soft delete assign team
    public function softDelete($id)
    {
        $assignTeam = AssignTeam::find($id);

        // send remove notification to resources. new pr 18-8-25
        $project = Project::select('project_name')->findOrFail($assignTeam->project_id);
        Resource::findOrFail($assignTeam->consultant_id)->notify(new AssignTeamNotification($project, 'remove'));

        if ($assignTeam) {
            $assignTeam->forceDelete(); // This performs a force delete
            return redirect()->back()->with('success', 'Assignment delete successfully.');
        } else {
            return redirect()->back()->with('error', 'Assignment not found.');
        }
    }

    // pr
    function pmCreate(Request $request)
    {

        $projects = Project::select(['id','project_name'])
            ->where('project_manager_id',Auth::id())
            ->get();
        
        return view('resource.projects.assignteam', compact('projects'));
    }

    // Method in AssignTeamController
    public function pmgetAvailableConsultants(Request $request)
    {
        $projectId = $request->input('project_id');
        $consultantRole = 'consultant';
        $companyId = Project::where('id', $projectId)->pluck('company_id')->first();
        
        $assignedResourceIds = AssignTeam::where('project_id', $projectId)->pluck('consultant_id')->toArray();
        $resources = Resource::select(['first_name','last_name','email','designation','rate','payment_type','id','username','email'])
            ->where('role', $consultantRole)
            ->whereNotIn('id', $assignedResourceIds)
            ->whereHas('ResourceCompany', function ($query) use ($companyId) {
                $query->where('companies.id', $companyId);
            })
            ->get();

        return response()->json($resources);
    }
}
