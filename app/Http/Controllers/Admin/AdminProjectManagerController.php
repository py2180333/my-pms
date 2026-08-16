<?php

namespace App\Http\Controllers\Admin;
use App\Models\ProjectManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;

class AdminProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $ProjectManagers = ProjectManager::all();
         return  view('Admin.users.ProjectManager.index', compact('ProjectManagers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.users.ProjectManager.create');
        
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'required|string', // Ensure skills are received as a string (JSON)
            'payment_type' => 'required|string',
            'rate' => 'required|numeric',
            'email' => 'required|email|unique:project_managers',
            'phone_number' => 'required|string|max:25',
            'national_id' => 'required|string',
            'address' => 'required|string',
            'pan_number' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
    
        // Generate a unique username based on the first name
        $validated['username'] = ProjectManager::generateUsername($validated['first_name']);
        //store project manager profile picture
        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/ProjectManager'), $imageName);
            $validated['profile_picture'] = $imageName;
        }
    
        // Hash the password
        $validated['password'] = bcrypt($validated['password']);
    
        // Convert skills from string to JSON format
        $validated['skills'] = json_encode($validated['skills']);
    
        // Create the project manager
        ProjectManager::create($validated);
    
        // Redirect to the project manager index with a success message
        return redirect()->route('admin.users.ProjectManager.index')
                         ->with('success', 'Project Manager created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $PM = ProjectManager::find($id);

        if (!$PM) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($PM);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $PM = ProjectManager::find($id);

        if (!$PM) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($PM);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'birth_date' => 'required|date',
            'payment_type' => 'required|string',
            'rate' => 'required|numeric',
            'skills' => 'required|json', // Assuming skills are passed as JSON
            'email' => 'required|email|unique:project_managers,email,' . $id,
            'phone_number' => 'required|string',
            'national_id' => 'required|string',
            'pan_number' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'nullable|confirmed|min:8', // Only validate password if provided
        ]);

        // Find the project manager record by ID
        $projectManager = ProjectManager::findOrFail($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/ProjectManager';

            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);

            // Update the project manager's profile_picture attribute
            $projectManager->profile_picture = $fileName;
        }

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the project manager with validated data
        $projectManager->update(array_merge($validatedData, [
            'profile_picture' => $projectManager->profile_picture // Keep or update the profile picture
        ]));

        return redirect()->route('admin.users.ProjectManager.index')->with('success', 'Project Manager updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $PM = ProjectManager::find($id);
        
        if ($PM) {
            $PM->delete();  // This performs a soft delete
            return redirect()->route('admin.users.ProjectManager.index')->with('success', 'ProjectManager moved to trash.');
        }

        return redirect()->route('admin.users.ProjectManager.index')->with('error', 'ProjectManager not found.');
    }

    /**
     * view all trashed projectmanager.
     */
    public function trashed()
    {
        $ProjectManagers = ProjectManager::onlyTrashed()->get();  // Retrieve only soft deleted ProjectManager
        return view('admin.users.ProjectManager.trash', compact('ProjectManagers'));
    }

    /**
     * restore  soft deleted ProjectManager.
     */
    public function restore($id)
    {
        $PM = ProjectManager::onlyTrashed()->where('id', $id)->first();
        
        if ($PM) {
            $PM->restore();  // Restore the soft deleted project manager
            return redirect()->route('admin.users.ProjectManager.trash')->with('success', 'ProjectManager restored successfully.');
        }

        return redirect()->route('admin.users.ProjectManager.trash')->with('error', 'ProjectManager not found.');
    }

    /**
     * permanatly delete soft deleted vendors.
     */
    public function forceDelete($id)
    {
        $PM = ProjectManager::onlyTrashed()->where('id', $id)->first();
        
        if ($PM) {
            $PM->forceDelete();  // Permanently delete the ProjectManager
            return redirect()->route('admin.users.ProjectManager.trash')->with('success', 'ProjectManager permanently deleted.');
        }

        return redirect()->route('admin.users.ProjectManager.trash')->with('error', 'ProjectManager not found.');
    }

}
