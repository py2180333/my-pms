<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companys = Company::select(['id','company_name'])->get(); // pr
        // $Resources = Resource::all(); // rd
        return  view('Admin.users.resources.index', compact('companys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companys = Company::all();
        return view('Admin.users.resources.create',compact('companys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'payment_type' => 'nullable|string',
            'rate' => 'nullable|numeric',
            'skills' => 'nullable|json', // Assuming skills are passed as JSON string
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:resources,email',
            'national_id' => 'nullable|string',
            'designation' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string',
            'address' => 'nullable|string', //30/4/25
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|confirmed|min:8',
            'role' => 'nullable',
            'company_ids' => 'required|array', // Ensure company selection is an array
            'company_ids.*' => 'exists:companies,id',
        ]);

        $createdByEmail = Auth::user()->email;
            // Generate a unique username based on the first name
            $validatedData['username'] = Resource::generateUsername($validatedData['first_name']);
        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/resources';

            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);

            // Store the file name for saving in the database
            $profilePicturePath = $fileName;
        }

        // Create the new resource
        $resource = new Resource();
        $resource->first_name = $validatedData['first_name'];
        $resource->last_name = $validatedData['last_name'];
        $resource->birth_date = $validatedData['birth_date'];
        $resource->payment_type = $validatedData['payment_type'];
        $resource->rate = $validatedData['rate'];
        $resource->skills = json_encode(json_decode($validatedData['skills'])); // Convert and store skills as JSON
        $resource->phone_number = $validatedData['phone_number'];
        $resource->email = $validatedData['email'];
        $resource->national_id = $validatedData['national_id'];
        $resource->designation = $validatedData['designation'];
        $resource->pan_number = $validatedData['pan_number'];
        $resource->username = $validatedData['username'];
        $resource->address = $validatedData['address'];
        $resource->role = $validatedData['role'];
        $resource->password = bcrypt($validatedData['password']); // Hash the password
        $resource->profile_picture = $profilePicturePath; // Set the profile picture file name
        $resource->created_by = $createdByEmail; //store who create this resource
        // Save the resource
        $resource->save();
        $resource->ResourceCompany()->attach($request->company_ids);

        return redirect()->route('admin.users.Resources.index')->with('success', 'Resource created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Resource = Resource::find($id);

        if (!$Resource) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($Resource);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Resource = Resource::find($id);

        // pr new 4-9-25
        // add companies check box 
        $companies = [];
        foreach($Resource->ResourceCompany as $c){
            $companies[] = $c->id;
        }
        $Resource->companies = $companies;
        // /pr new 4-9-25

        if (!$Resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    
        return response()->json($Resource);
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
            'role' => 'required',
            'birth_date' => 'required|date',
            'payment_type' => 'required|string',
            'rate' => 'required|numeric',
            'designation' => 'nullable|string',
            'skills' => 'required|json', // Assuming skills are passed as JSON
            'email' => 'required|email|unique:resources,email,' . $id,
            'phone_number' => 'required|string',
            'national_id' => 'required|string',
            'pan_number' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'nullable|confirmed|min:8', // Only validate password if provided
        ]);

        // pr new 4-9-25
        $validateCompnies = $request->validate([
            'company_ids' => 'required|array', // Ensure company selection is an array
            'company_ids.*' => 'exists:companies,id',
        ]);
        // /pr new 4-9-25

        // Find the project manager record by ID
        $Resource = Resource::findOrFail($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/Resources';

            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($Resource->profile_picture && file_exists(public_path('uploads/Resources/' . $Resource->profile_picture))) {
                unlink(public_path('uploads/Resources/' . $Resource->profile_picture));
            }
            // /pr

            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);

            // Update the project manager's profile_picture attribute
            $Resource->profile_picture = $fileName;
        }

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the resource with validated data
        $Resource->update(array_merge($validatedData, [
            'profile_picture' => $Resource->profile_picture // Keep or update the profile picture
        ]));

        // pr new 4-9-25
        $Resource->ResourceCompany()->sync($validateCompnies['company_ids']);
        // /pr new 4-9-25

        return redirect()
            ->back() // pr add 10-10-25
            // ->route('admin.users.Resources.index')
            ->with('success', 'Resource updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::find($id);
        
        if ($resource) {
            $resource->delete();  // This performs a soft delete
            return redirect()
                ->back() // pr add 10-10-25
                // ->route('admin.users.Resources.index')
                ->with('success', 'Resource moved to trash.');
        }

        return redirect()->route('admin.users.Resources.index')->with('error', 'Resource not found.');
    }
    /**
     * view all trashed Resource.
     */
    public function trashed()
    {
        $Resources = Resource::onlyTrashed()->get();  // Retrieve only soft deleted Resource
        return view('Admin.users.resources.trash', compact('Resources'));
    }
    /**
     * restore  soft deleted Resource.
     */
    public function restore($id)
    {
        $Resources = Resource::onlyTrashed()->where('id', $id)->first();
        
        if ($Resources) {
            $Resources->restore();  // Restore the soft deleted project manager
            return redirect()->route('admin.users.Resources.trash')->with('success', 'Resource restored successfully.');
        }

        return redirect()->route('admin.users.Resources.trash')->with('error', 'Resource not found.');
    }

    /**
     * permanatly delete soft deleted Resource.
     */
    public function forceDelete($id)
    {
        $Resources = Resource::onlyTrashed()->where('id', $id)->first();
        
        if ($Resources) {
            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($Resources->profile_picture && file_exists(public_path('uploads/Resources/' . $Resources->profile_picture))) {
                unlink(public_path('uploads/Resources/' . $Resources->profile_picture));
            }
            // /pr
            $Resources->forceDelete();  // Permanently delete the resource
            return redirect()->route('admin.users.Resources.trash')->with('success', 'Resource permanently deleted.');
        }

        return redirect()->route('admin.users.Resources.trash')->with('error', 'Resource not found.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('resource')->attempt($credentials)) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect()->intended('/resource/manager/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // pr
    public function filter(Request $request)
    {
        try {
            // $role = $request->role;
            // $companyId = $request->company_id;

            $role = $request->query('role'); // pr add 10-10-25
            $companyId = $request->query('company_id'); // pr add 10-10-25

            // Fetch resources based on selected role
            if ($role == 'all' || empty($role)) {
                $resourcesQuery = Resource::query();
            } else {
                $resourcesQuery = Resource::where('role',$role);
            }
    
            // Fetch resources based on selected company
            if ($companyId == 'all' || empty($companyId)) {
                $resources = $resourcesQuery->with('ResourceCompany')->get(); // Load companies relation
            } else {
                $resources = $resourcesQuery->whereHas('ResourceCompany', function ($query) use ($companyId) {
                    $query->where('companies.id', $companyId);
                })->get();
            }

            $active = $resources->where('status', 'active')->count();
            $deactive = $resources->where('status', 'inactive')->count();
            
            return response()->json([
                'count' => $resources->count(),
                'active' => $active,
                'deactive' => $deactive,
                'data' => $resources,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching resources: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
