<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company; // pr
use App\Models\Admin; // new pr 11-8-25

class AdminController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard'); // Redirect to dashboard if already logged in
        }
        
        return view('Admin.login'); // Show login form if not logged in
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show the admin dashboard -rd
    public function dashboard()
    {
        $companies = Company::select('id','company_name')->get(); // pr
        return view('Admin.dashboard', compact('companies'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    
    /* the data is show in myprofile */ // new pr 11-8-25
    function show(){
        $data = Auth::guard('admin')->user();
        return view('admin.myprofile',compact('data'));
    }

    /* the data is update in myprofile */ // new pr 11-8-25
    function update(Request $request){

        // Validate the input data
        $id = Auth::id();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phoneNumber' => 'required|string',
            'password' => 'nullable|confirmed|min:8', // Only validate password if provided
        ]);

        // Find the resource by ID
        $admin = Admin::findOrFail($id);

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the resource with validated data
        $admin->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.profiles')->with('success', 'Admin updated successfully.');
    }
}
