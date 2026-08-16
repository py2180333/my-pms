<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);

        $validates = $request->validate([
            'customer_email' => 'required|email',
            'customer_password' => 'required',
        ]);

        $credentials = [
            'email' => $validates['customer_email'],
            'password' => $validates['customer_password'],
        ];

        if (Auth::guard('customer')->attempt($credentials)) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        return back()->withErrors([
            'customer_email' => 'The provided credentials do not match our "customer" records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /* the data is show in myprofile */
    function show(){
        $data = Auth::guard('customer')->user();
        return view('customer.myprofile',compact('data'));
    }

    /* the data is update in myprofile */
    function update(Request $request){

        // Validate the input data
        $id = Auth::id();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone_number' => 'required|string',
            'pan_number' => 'required|string',
            'tax_number' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'nullable|confirmed|min:8', // Only validate password if provided
        ]);

        // Find the resource by ID
        $customer = Customer::findOrFail($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Define the upload path
            $uploadPath = 'uploads/customers';

            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($customer->profile_picture && file_exists(public_path('uploads/customers/' . $customer->profile_picture))) {
                unlink(public_path('uploads/customers/' . $customer->profile_picture));
            }
            // /pr
            
            // Store the new profile picture and get the filename
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->move($uploadPath, $fileName);
            
            // Update the resource's profile_picture attribute
            $customer->profile_picture = $fileName;
        }

        // If password is provided, hash and update
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Exclude password from updating if not provided
            unset($validatedData['password']);
        }

        // Update the resource with validated data
        $customer->update(array_merge($validatedData, [
            'profile_picture' => $customer->profile_picture // Keep or update the profile picture
        ]));

        // Redirect back with a success message
        return redirect()->route('customer.profiles')->with('success', 'Customer updated successfully.');
    }
}
