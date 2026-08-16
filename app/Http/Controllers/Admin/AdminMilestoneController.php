<?php

namespace App\Http\Controllers\Admin;
use App\Models\milestone;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Task; // pr
use Illuminate\Support\Facades\Auth; // pr


class AdminMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            $projects = Project::where('project_manager_id',Auth::id())->get();
            return view('resource.projects.milestonecreate', compact('projects'));
        }
        // /pr
        $projects = Project::all(); // Get all projects
        return view('Admin.projects.milestonecreate', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required',
            'milestone_name' => 'required|string',
            'milestone_date' => 'required|date',
            'forecasting_date' => 'required|date|after_or_equal:milestone_date', // pr new 9-9-25
            'status' => 'required|string',
            'description' => 'nullable|string', // pr remove required 23-9-25
            'amount' => 'required|numeric',
        ]);

        Milestone::create($validated);
        return redirect()->back()->with('success', 'Milestone created successfully');
    }

    // Fetch milestones for a selected project (AJAX call)
    public function getMilestones($projectId)
    {
        $milestones = Milestone::where('project_id', $projectId)->get();
        $project = Project::select('start_date', 'end_date')->findOrFail($projectId); // pr new 9-9-25
        // return response()->json($milestones); // rd
        // pr new 9-9-25
        return response()->json([
            'milestones' => $milestones,
            'project' => $project,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 1: Validate the request data
        $validatedData = $request->validate([
            'milestone_name' => 'required|string|max:255',
            'milestone_date' => 'required|date',
            'forecasting_date' => 'required|date|after_or_equal:milestone_date',
            'status' => 'required|string|in:Completed,Planning,In Progress',
            'description' => 'nullable|string', // pr remove required 23-9-25
            'cost' => 'required|numeric',
        ]);

        try {
            // Step 2: Find the milestone by its ID
            $milestone = Milestone::findOrFail($id);

            // Step 3: Update the milestone's fields with validated data
            $milestone->milestone_name = $validatedData['milestone_name'];
            $milestone->milestone_date = $validatedData['milestone_date'];
            $milestone->forecasting_date = $validatedData['forecasting_date'];
            $milestone->status = $validatedData['status'];
            $milestone->description = $validatedData['description'];
            $milestone->amount = $validatedData['cost'];

            // Step 4: Save the updated milestone to the database
            $milestone->save();

            // Step 5: Redirect with a success message
            return redirect()->back()->with('success', 'Milestone updated successfully!');
        } catch (\Exception $e) {
            // Step 6: Handle any errors and redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update milestone: ' . $e->getMessage());
        }
    }
    //doc upload for virify approval
    public function docupload(Request $request, string $id)
    {
        // Validate the uploaded file
        $request->validate([
            'approvaldoc' => 'required|mimes:pdf|max:5120', // Max size 5MB, only PDFs allowed
        ]);

        // Find the milestone by ID
        $milestone = Milestone::findOrFail($id);

        // Check if the milestone already has a document and delete it
        if ($milestone->document) {
            Storage::delete($milestone->document); // Deletes the old file
        }

        // // Store the new file
        // $filePath = $request->file('approvaldoc')->store('docs'); // Stores in 'storage/app/docs'

        // // Update the milestone record with the new file path
        // $milestone->document = $filePath;
        // $milestone->save();
            // Create a custom filename
        $currentDate = now()->format('d-m-Y'); // Date format: day-month-year
        $customFileName = Str::slug('milestone') . "-$currentDate-$milestone->id." . $request->file('approvaldoc')->getClientOriginalExtension();

        // Store the new file with the custom filename
        $filePath = $request->file('approvaldoc')->storeAs('docs', $customFileName); // Stores in 'storage/app/docs'

        // Update the milestone record with the new file path
        $milestone->document = $filePath;
        $milestone->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Milestone Approval Document uploaded successfully!');
    }

    public function destroy($id)
    {
        $Milestone = Milestone::find($id);
        
        if ($Milestone) {

            //pr
            $hasTask = Task::where('milestone_id',$Milestone->id)->exists();

            if($hasTask){
                return redirect()->back()->with('error', 'the task for this milestone is created so you can not delete this milestone.');
            } else {
                $Milestone->delete();  // This performs a soft delete
                return redirect()->back()->with('success', 'Milestone moved to trash.');
            }
            // /pr

            // $Milestone->delete();  // This performs a soft delete // rd
            // return redirect()->back()->with('success', 'Milestone moved to trash.'); // rd
        }

        return redirect()->back()->with('error', 'Milestone not found.');
    }

    public function trashed($id)
    {
        $milestones = Milestone::onlyTrashed()->where('project_id', $id)->get(); // pr // Retrieve only soft deleted customers
        // dd($milestones);
        return response()->json($milestones); // pr
    }
    //admin restore soft delete customers
    public function restore($id)
    {
        $Milestone = Milestone::onlyTrashed()->where('id', $id)->first();
        
        if ($Milestone) {
            $Milestone->restore();  // Restore the soft deleted customer
            // // pr
            // if(Auth::check() && Auth::user()->role === 'project_manager'){
            //     return redirect()->route('resource.projects.index')->with('success', 'Milestone restored successfully.');
            // }
            // // /pr
            // return redirect()->route('admin.projects.index')->with('success', 'Milestone restored successfully.');

            // pr add 13-10-25
            return redirect()
                ->back()
                ->with('success', 'Milestone restored successfully.');
            // pr add 13-10-25
        }

        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            return redirect()->route('resource.projects.index')->with('error', 'Milestone not found.');
        }
        // /pr

        return redirect()->route('admin.projects.index')->with('error', 'Customer not found.');
    }
    //milestone based invoice 
    public function invoice($id)
    {
        // // Fetch milestone with related project and customer
        // $milestone = Milestone::with('project.customer')->findOrFail($id);

        // // Extract customer details from the project relationship
        // $customer = $milestone->project->customer ?? null;
        // $company = $milestone->project->company ?? null;
        // // Fetch the first associated company of the customer (assuming a customer can have multiple companies)
        // //$company = $customer ? $customer->companies()->first() : null;

        // // Pass milestone and customer data to the session
        // session()->flash('milestoneData', [
        //     'mtcompanyID' => $company->id,
        //     'mtcompanyname' => $company->company_name,
        //     'milestoneId' => $id,
        //     'customerId' => $customer->id ?? 'N/A',
        //     'customerNameF' => $customer->first_name ?? 'N/A',
        //     'customerName' => $customer->company_name ?? 'N/A',
        //     'customerAddress' => $customer->address ?? 'N/A',
        //     'customerTax' => $customer->tax_number ?? 'N/A',
        //     'amount' => $milestone->amount,
        //     'milestoneName' => $milestone->milestone_name ?? 'N/A',
        //     'currency' => $milestone->project->currency, //pr
            
        // ]);

        // pr
        if(Auth::check() && Auth::user()->role === 'project_manager'){
            // Redirect to the invoice creation route
            return redirect()->route('resource.invoice.pm.create', ['milestone_id' => $id])->with('success', 'Milestone loaded for invoice.');
        }
        // /pr

        // Redirect to the invoice creation route
        return redirect()->route('admin.invoice.create', ['milestone_id' => $id])->with('success', 'Milestone loaded for invoice.');
    }

    // pr
    //permanent delete milestone
    public function forceDelete($id)
    {
        $milestone = Milestone::onlyTrashed()->find($id);

        if($milestone){
            $milestone->forceDelete(); // This performs a hard delete
            return redirect()->back()->with('success', 'milestone deleted successfully.');
        }

        return redirect()->back()->with('error', 'milestone not found');
    }

}
