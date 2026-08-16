<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Customer; 
use App\Models\Vendor;
use App\Models\Company;
use App\Models\milestone; 
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\assignteam;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $vendors = Vendor::all();    
        $resources = Resource::where('role', 'project_manager')->get();
        $projects = Project::with(['customer', 'vendor', 'manager','milestones'])->get();  // Eager load relationships
        $companies = Company::select(['id','company_name'])->get(); // pr
        return view('Admin.projects.index', compact('projects','customers','vendors','resources','companies'));
    }
    public function getDocuments($id)
    {
        $project = Project::findOrFail($id);
        $documents = $project->documents; // Assuming `documents` is stored as an array or JSON in the database.

        return response()->json([
            'documents' => $documents,
        ]);
    }
    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $customers = Customer::all();
        $companies = Company::select(['id','company_name'])->get();
        $vendors = Vendor::all();
        $resources = Resource::where('role', 'project_manager')->get();  // Filter in the query
        return view('Admin.projects.create', compact('customers', 'vendors', 'resources','companies'));
    }
    /**
     * Store a newly created project in the database.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // pr remove required 23-9-25
            'customer_id' => 'required|exists:customers,id',
            'company_id' => 'required',
            'vendor_id' => 'nullable|exists:vendors,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'project_manager_id' => 'required|exists:resources,id',
            'status' => 'required|in:planning,in_progress,completed,hold',
            'project_value' => 'required|numeric',
            'currency' => 'required|string', // pr
            'documents.*' => 'nullable|file|mimes:pdf,jpg,png,docx',
            'notes' => 'nullable|string',
        ]);

        // Handle file uploads
        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $originalName = $file->getClientOriginalName(); // Get the original file name
                // Store the file in the 'public/documents' directory without changing the file name
                $path = $file->storeAs('documents', $originalName, 'public'); 
                $documents[] = $path; // Store the path for database saving
            }
        }
       $project =  Project::create([
            'uniquename' => '',
            'project_name' => $validated['name'],
            'description' => $validated['description'],
            'customer_id' => $validated['customer_id'],
            'vendor_id' => $validated['vendor_id'] ?? null,
            'company_id' => $validated['company_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'project_manager_id' => $validated['project_manager_id'],
            'status' => $validated['status'],
            'project_value' => $validated['project_value'],
            'currency' => $validated['currency'], // pr
            'documents' => $documents ?? null, // Store document paths as JSON
            'notes' => $validated['notes'] ?? null,
        ]);
            // Generate the unique project name
        $lastId = Project::withTrashed()->max('id'); // Get the last ID (including soft deleted)
        $currentMonth = date('m');  // Get current month
        $currentYear = date('y');   // Get last two digits of the year
        $projectName = 'PR' . $currentMonth . $currentYear . sprintf('%02d', $lastId + 1);

        // Update the project name after creation
        $project->update(['uniquename' => $projectName]);

        // Redirect or return success response
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function update(Request $request, string $id)
    {
        // Custom validation to skip "application/octet-stream" files
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string', // pr remove required 23-9-25
            'customer_id' => 'required|exists:customers,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'project_manager_id' => 'required|exists:resources,id',
            'status' => 'required|in:planning,in_progress,completed,hold',
            'project_value' => 'required|numeric',
            'notes' => 'nullable|string',
            'currency' => 'required|string',
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', function ($attribute, $value, $fail) {
                if ($value->getMimeType() === 'application/octet-stream') {
                    return; // Skip validation for files with "application/octet-stream" mimetype
                }

                $allowedMimeTypes = ['pdf', 'jpg', 'png', 'docx'];
                if (!in_array($value->getClientOriginalExtension(), $allowedMimeTypes)) {
                    $fail("The $attribute field must be a file of type: pdf, jpg, png, docx.");
                }
            }],
        ]);
        
        // Find the existing project
        $project = Project::findOrFail($id);

        // Handle file uploads (both new and existing)
        $documents = $project->documents ?? []; // Existing documents from the database
        $newFiles = []; // Array for new file paths to be added
        $uploadedFileNames = []; // Array to keep track of uploaded file names

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Skip files with mimeType "application/octet-stream" as they are considered existing
                if ($file->getMimeType() === 'application/octet-stream') {
                    continue;
                }

                $originalName = $file->getClientOriginalName(); // Get the original file name

                // Check if the file with the same name already exists in the database
                if (!in_array('documents/' . $originalName, $documents)) {
                    // Store the file in the 'public/documents' directory without changing the file name
                    $path = $file->storeAs('documents', $originalName, 'public');
                    $newFiles[] = $path; // Add new file path to newFiles array
                }

                // Add the uploaded file name to the array
                $uploadedFileNames[] = $originalName;
            }
        }

        // Find documents in the database that are no longer present in the uploaded files
        $remainingDocuments = [];
        foreach ($documents as $document) {
            $fileName = basename($document); // Get just the file name from the document path
            if (!in_array($fileName, $uploadedFileNames)) {
                // If file name from database is not in the uploaded files, remove it
                // Delete the file from storage (optional, if needed)
                Storage::disk('public')->delete($document);
            } else {
                // Keep the files that are still part of the uploaded files
                $remainingDocuments[] = $document;
            }
        }

        // Merge the existing documents that remain with new uploaded files
        $updatedDocuments = array_merge($remainingDocuments, $newFiles);

        // Update the project details
        
        $project->update([
            'project_name' => $validated['project_name'],
            'description' => $validated['description'],
            'customer_id' => $validated['customer_id'],
            'vendor_id' => $validated['vendor_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'project_manager_id' => $validated['project_manager_id'],
            'status' => $validated['status'],
            'project_value' => $validated['project_value'],
            'notes' => $validated['notes'],
            'currency' => $validated['currency'],
            'documents' => $updatedDocuments, // Update with both old and new files
        ]);

        // Redirect or return success response
        return redirect()
            ->back() // pr add 13-10-25
            // ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }
   
    /**
     * Remove the specified project from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if ($project) {
            $project->delete();  // This performs a soft delete
            // // pr
            // if(Auth::check() && Auth::user()->role === 'project_manager'){
            //     return redirect()->route('resource.projects.index')->with('success', 'Project moved to trash.');
            // }
            // // /pr
            return redirect()
                ->back() // pr add 13-10-25
                // ->route('admin.projects.index')
                ->with('success', 'Project moved to trash.');
        }

        // // pr
        // if(Auth::check() && Auth::user()->role === 'project_manager'){
        //     return redirect()->route('resource.projects.index')->with('error', 'Project not found.');
        // }
        // // /pr
        return redirect()
            ->back() // pr add 13-10-25
            // ->route('admin.projects.index')
            ->with('error', 'Project not found.');
    }
    /**
     * view all trashed project.
     */
    public function trashed()
    {
        // // pr
        // if(Auth::check() && Auth::user()->role === 'project_manager'){
        //     $projects = Project::onlyTrashed()->where('project_manager_id',Auth::id())->get(); // Retrieve only soft deleted vendors
        //     return view('resource.projects.trash', compact('projects'));
        // }
        // // /pr
        $projects = Project::onlyTrashed()->get(); // Retrieve only soft deleted vendors
        return view('Admin.projects.trash', compact('projects'));
    }

    /**
     * restore  soft deleted project.
     */
    public function restore($id)
    {
        $project = Project::onlyTrashed()->where('id', $id)->first();
        
        if ($project) {
            $project->restore();  // Restore the soft deleted vendors
            // pr
            if(Auth::check() && Auth::user()->role === 'project_manager'){
                return redirect()->route('resource.projects.trash')->with('success', 'project restored successfully.');
            }
            // /pr
            return redirect()->route('admin.projects.trash')->with('success', 'project restored successfully.');
        }
        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            return redirect()->route('resource.projects.trash')->with('error', 'projects not found.');
        }
        // /pr
        return redirect()->route('admin.projects.trash')->with('error', 'projects not found.');
    }

    //fetching customer and vendor based on companies
    public function getCusNVndByCompany(Request $request)
    {
        $companyId = $request->company_id;
        $customers = Customer::whereHas('companies', function ($q) use ($companyId) {
            $q->where('companies.id', $companyId);
        })->get();
        $vendors = Vendor::whereHas('VendorCompany', function ($query) use ($companyId) {
            $query->where('companies.id', $companyId);
        })->get();
        
        $resources = Resource::whereHas('ResourceCompany', function ($que) use ($companyId) {
            $que->where('companies.id', $companyId);
        })->get();

        $projectManagers = collect($resources)->filter(function ($item) {
            return $item['role'] === 'project_manager';
        });
        return response()->json(['customers'=>$customers, 'vendors'=>$vendors, 'projectManagers'=>$projectManagers]);
    }

    // pr
    public function resIndex(){
        // with(['customer', 'vendor', 'manager','milestones'])
        if(Auth::user()->role === 'project_manager'){
            $projects = Project::with('customer:id,first_name,last_name')->where('project_manager_id',Auth::id())->get();
            $customers = $projects->map(fn($p) => $p->customer)->unique('id');
            return view('resource.projects.index', compact('projects','customers'));
            exit();
        }

        if(Auth::user()->role === 'consultant'){
            $projectIds = assignteam::where('consultant_id', Auth::id())->pluck('project_id');
            $projects = Project::whereIn('id', $projectIds)->get();
            return view('resource.projects.index', compact('projects'));
            exit();
        }

        // new pr 8-8-25
        if(Auth::guard('customer')->check()){
            $customerId = Auth::id();
            $projects = Project::where('customer_id', $customerId)->get();
            return view('customer.projects.index', compact('projects'));
            exit();
        }
    }

    public function pmUpdate(Request $request, string $id)
    {
        // Custom validation to skip "application/octet-stream" files
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:planning,in_progress,completed,hold',
            'project_value' => 'required|numeric',
            'notes' => 'nullable|string',
            'currency' => 'required|string',
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', function ($attribute, $value, $fail) {
                if ($value->getMimeType() === 'application/octet-stream') {
                    return; // Skip validation for files with "application/octet-stream" mimetype
                }

                $allowedMimeTypes = ['pdf', 'jpg', 'png', 'docx'];
                if (!in_array($value->getClientOriginalExtension(), $allowedMimeTypes)) {
                    $fail("The $attribute field must be a file of type: pdf, jpg, png, docx.");
                }
            }],
        ]);
        
        // Find the existing project
        $project = Project::findOrFail($id);

        // Handle file uploads (both new and existing)
        $documents = $project->documents ?? []; // Existing documents from the database
        $newFiles = []; // Array for new file paths to be added
        $uploadedFileNames = []; // Array to keep track of uploaded file names

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Skip files with mimeType "application/octet-stream" as they are considered existing
                if ($file->getMimeType() === 'application/octet-stream') {
                    continue;
                }

                $originalName = $file->getClientOriginalName(); // Get the original file name

                // Check if the file with the same name already exists in the database
                if (!in_array('documents/' . $originalName, $documents)) {
                    // Store the file in the 'public/documents' directory without changing the file name
                    $path = $file->storeAs('documents', $originalName, 'public');
                    $newFiles[] = $path; // Add new file path to newFiles array
                }

                // Add the uploaded file name to the array
                $uploadedFileNames[] = $originalName;
            }
        }

        // Find documents in the database that are no longer present in the uploaded files
        $remainingDocuments = [];
        foreach ($documents as $document) {
            $fileName = basename($document); // Get just the file name from the document path
            if (!in_array($fileName, $uploadedFileNames)) {
                // If file name from database is not in the uploaded files, remove it
                // Delete the file from storage (optional, if needed)
                Storage::disk('public')->delete($document);
            } else {
                // Keep the files that are still part of the uploaded files
                $remainingDocuments[] = $document;
            }
        }

        // Merge the existing documents that remain with new uploaded files
        $updatedDocuments = array_merge($remainingDocuments, $newFiles);

        // Update the project details
        
        $project->update([
            'project_name' => $validated['project_name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'project_value' => $validated['project_value'],
            'notes' => $validated['notes'],
            'currency' => $validated['currency'],
            'documents' => $updatedDocuments, // Update with both old and new files
        ]);

        // Redirect or return success response
        return redirect()
            ->back() // 13-10-25
            // ->route('resource.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function filter(Request $request)
    {
        try {
            // $startDate = $request->stDate;
            // $endDate = $request->endDate;
            // $status = $request->status;
            // $companyId = $request->company_id;
            // $customerId = $request->customer_id;

            // pr add 13-10-25
            $startDate = $request->query('stDate');
            $endDate = $request->query('endDate');
            $status = $request->query('status');
            $companyId = $request->query('company_id');
            $customerId = $request->query('customer_id');


            // Fetch project based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = Project::query();
            } else {
                // $dateQuery = Project::where('start_date', '<', $startDate)->where('end_date', '>', $endDate);
                // $dateQuery = Project::whereBetween('start_date', [$startDate, $endDate])->whereBetween('end_date', [$startDate, $endDate]);
                // $dateQuery = Project::whereBetween('start_date', [$startDate, $endDate])
                //     ->whereBetween('end_date', [$startDate, $endDate])
                //     ->orWhere(function ($query) use ($startDate, $endDate){
                //         $query->where('start_date', '<=', $startDate)
                //             ->where('end_date', '>=', $endDate);
                //     });
                $dateQuery = Project::whereBetween('start_date', [$startDate, $endDate]);
            }

            // Fetch project based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $dateQuery;
            } else {
                $statusQuery = $dateQuery->where('status',$status);
            }

            // Fetch project based on selected company
            if ($companyId == 'all' || empty($companyId)) {
                $companyQuery = $statusQuery->with(['company', 'customer', 'vendor', 'manager','milestones']); // Load companies relation
            } else {
                $companyQuery = $statusQuery->where('company_id',$companyId)->with(['company', 'customer', 'vendor', 'manager','milestones']);
            }

            // Fetch project based on selected customer
            if ($customerId == 'all' || empty($customerId)) {
                $projects = $companyQuery->get();
            } else {
                $projects = $companyQuery->where('customer_id',$customerId)->get();
            }

            $planning = $projects->where('status', 'planning')->count();
            $progress = $projects->where('status', 'in_progress')->count();
            $completed = $projects->where('status', 'completed')->count();
            $hold = $projects->where('status', 'hold')->count();
            $totalValue = $projects->sum('project_value');
            
            return response()->json([
                'count' => $projects->count(),
                'planning' => $planning,
                'progress' => $progress,
                'completed' => $completed,
                'hold' => $hold,
                'totalValue' => $totalValue,
                'data' => $projects,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching resources: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function pmFilter(Request $request)
    {
        try {
            // $startDate = $request->stDate;
            // $endDate = $request->endDate;
            // $status = $request->status;
            // $customerId = $request->customer_id;
            // $projectId = $request->project; // only for customer  new pr 11-8-25

            // pr add 13-10-25
            $startDate = $request->query('stDate');
            $endDate = $request->query('endDate');
            $status = $request->query('status');
            $customerId = $request->query('customer_id');
            $projectId = $request->query('project'); // only for customer  new pr 11-8-25


            if(Auth::user()->role === 'project_manager'){
                $authQuery = Project::where('project_manager_id',Auth::id());
            }

            if(Auth::user()->role === 'consultant'){
                $projectIds = assignteam::where('consultant_id', Auth::id())->pluck('project_id');
                $authQuery = Project::whereIn('id', $projectIds);
            }

            // new pr 11-8-25
            if(Auth::guard('customer')->check()){
                $authQuery = Project::query();
                $customerId = Auth::id(); // so it is not take customer id in below code.
            }

            // Fetch project based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = $authQuery;
            } else {
                $dateQuery = $authQuery->whereBetween('start_date', [$startDate, $endDate]);
            }

            // Fetch project based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $dateQuery;
            } else {
                $statusQuery = $dateQuery->where('status',$status);
            }

            // Fetch project based on selected customer
            if ($customerId == 'all' || empty($customerId)) {
                $projects = $statusQuery->with(['company', 'customer', 'vendor', 'manager','milestones'])
                    ->get();
            } else {
                $projectsQuery = $statusQuery->where('customer_id',$customerId)
                    ->with(['company', 'customer', 'vendor', 'manager','milestones']);
                if($projectId != 'all' && !empty($projectId)){
                    $projectsQuery->where(['id' => $projectId]);
                }
                $projects = $projectsQuery->get();
            }

            $planning = $projects->where('status', 'planning')->count();
            $progress = $projects->where('status', 'in_progress')->count();
            $completed = $projects->where('status', 'completed')->count();
            $hold = $projects->where('status', 'hold')->count();
            $totalValue = $projects->sum('project_value');
            
            return response()->json([
                'count' => $projects->count(),
                'planning' => $planning,
                'progress' => $progress,
                'completed' => $completed,
                'hold' => $hold,
                'totalValue' => $totalValue,
                'data' => $projects,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching resources: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    //fetching customer based on company drop down
    public function getCusByCompany(Request $request)
    {
        $companyId = $request->company_id;
        if ($companyId == 'all' || empty($companyId)) {
            $customers = Customer::select(['id', 'first_name', 'last_name'])->get();
        } else {
            $customers = Customer::select(['id', 'first_name', 'last_name'])
                ->whereHas('companies', function ($q) use ($companyId) {
                    $q->where('companies.id', $companyId);
                })
                ->get();
        }
        return response()->json(['customers'=>$customers]);
    }
}
