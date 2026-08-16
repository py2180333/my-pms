<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function login(Request $request)
    {
        $validates = $request->validate([
            'vendor_email' => 'required|email',
            'vendor_password' => 'required',
        ]);

        $credentials = [
            'email' => $validates['vendor_email'],
            'password' => $validates['vendor_password'],
        ];

        if (Auth::guard('vendor')->attempt($credentials)) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect()->intended('/vendor/dashboard');
        }

        return back()->withErrors([
            'vendor_email' => 'The provided credentials do not match our "vendor" records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /* the data is show in myprofile */
    function show(){
        $data = Auth::guard('vendor')->user();
        return view('vendor.myprofile',compact('data'));
    }

    /* the data is update in myprofile */
    function update(Request $request){

        // Validate the input data
        $id = Auth::id();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:vendors,email,' . $id, // Ignore current vendor's email
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'pan_number' => 'nullable|string|max:10',
            'bank_account_no' => 'required|string|max:20',
            'account_holder_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'tax_number' => 'nullable|string|max:25',
            'code_type' => 'required|in:both,IFSC,Swift',
            'ifsc_code' => 'nullable|string|max:11',
            'swift_code' => 'nullable|string|max:11',
            'website' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the resource by ID
        $vendor = Vendor::findOrFail($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/vendors';

            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($vendor->profile_picture && file_exists(public_path('uploads/vendors/' . $vendor->profile_picture))) {
                unlink(public_path('uploads/vendors/' . $vendor->profile_picture));
            }
            // /pr
            
            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);
            
            // Update the resource's profile_picture attribute
            $vendor->profile_picture = $fileName;
        }

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the resource with validated data
        $vendor->update(array_merge($validatedData, [
            'profile_picture' => $vendor->profile_picture // Keep or update the profile picture
        ]));

        // Redirect back with a success message
        return redirect()->route('vendor.profiles')->with('success', 'Vendor updated successfully.');
    }
}
