<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Assigntask;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResourceController extends Controller
{
    

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('resource')->attempt($credentials)) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect()->intended('/resource/dashboard');
        }

        return back()->withErrors([
            'resource_email' => 'The provided credentials do not match our "resource" records.',
        ])->onlyInput('email');
    }
    public function dashboard()
    {
        $consultant = Auth::guard('resource')->user();

        $assignedTasks = Assigntask::with(['task', 'project', 'milestone'])
            ->where('consultant_id', $consultant->id)
            ->get();

        return view('resource.dashboard', compact('assignedTasks'));
    }
    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('resource')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /* the data is show in myprofile */
    function show(){
        $data = Auth::guard('resource')->user();
        return view('resource.myprofile',compact('data'));
    }

    /* the data is update in myprofile */
    function update(Request $request){

        // Validate the input data
        $id = Auth::id();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'skills' => 'required|json', // Assuming skills are passed as JSON
            'email' => 'required|email|unique:resources,email,' . $id,
            'phone_number' => 'required|string',
            'pan_number' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'nullable|confirmed|min:8', // Only validate password if provided
        ]);

        // Find the resource by ID
        $resource = Resource::findOrFail($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/Resources';
            
            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($resource->profile_picture && file_exists(public_path('uploads/Resources/' . $resource->profile_picture))) {
                unlink(public_path('uploads/Resources/' . $resource->profile_picture));
            }
            // /pr

            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);
            
            // Update the resource's profile_picture attribute
            $resource->profile_picture = $fileName;
        }

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the resource with validated data
        $resource->update(array_merge($validatedData, [
            'profile_picture' => $resource->profile_picture // Keep or update the profile picture
        ]));

        // Redirect back with a success message
        return redirect()->route('resource.profiles')->with('success', 'Resource updated successfully.');
    }

    // pranav
    function sidebar_timesheet(){
        $assigntask = Assigntask::with(['project', 'task'])
            ->where('consultant_id', Auth::id())
            ->get();
        // $tsData = Timesheet::all();
        $tsData = Timesheet::with(['assigntask.project', 'assigntask.task'])
            ->whereIn('assigntask_id', $assigntask->pluck('id'))
            ->get();
        return response()->json([ 'assigntask' => $assigntask, 'tsData' => $tsData ]); // sidebar_timesheet.js -pranav
    }
}
