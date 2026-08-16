<?php

namespace App\Http\Controllers\Admin;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class AdminVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companys = Company::select(['id','company_name'])->get(); // pr
        // $vendors = Vendor::all(); // rd
        return  view('Admin.users.vendors.index', compact('companys'));
    }
    
    /**
     * Display the specified vendor.
     */
    public function show(string $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($vendor);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companys = Company::all();
        return view('Admin.users.vendors.create',compact('companys'));
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:vendors,email',
            'phone_number' => 'required|string|max:15',
            'national_id' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'pan_number' => 'nullable|string|max:10',
            'company_name' => 'required|string|max:255',
            'bank_account_no' => 'required|string|max:20',
            'account_holder_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'Tax_number' => 'required|string|max:25', // Leave this as 'Tax_number'
            'code_type' => 'required|in:both,IFSC,Swift',
            'ifsc_code' => 'nullable|string|max:11',
            'swift_code' => 'nullable|string|max:11',
            'website' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'company_ids' => 'required|array', // Ensure company selection is an array
            'company_ids.*' => 'exists:companies,id',
        ]);

        // Handle the file upload if the file is present
        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/vendors'), $imageName);
            $validatedData['profile_picture'] = $imageName;
        }

        // Store the vendor's data
        $vendor = new Vendor();
        $vendor->fill($validatedData);
        $vendor->password = Hash::make($request->password);
        // Manually assign Tax_number
        $vendor->Tax_number = $request->Tax_number;

        $vendor->save();
        $vendor->VendorCompany()->attach($request->company_ids);

        return redirect()->route('admin.users.vendors.index')->with('success', 'Vendor created successfully');
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($vendor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:vendors,email,' . $id, // Ignore current vendor's email
            'phone_number' => 'required|string|max:15',
            'national_id' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'pan_number' => 'nullable|string|max:10',
            'company_name' => 'required|string|max:255',
            'bank_account_no' => 'required|string|max:20',
            'account_holder_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'Tax_number' => 'nullable|string|max:25',
            'code_type' => 'required|in:both,IFSC,Swift',
            'ifsc_code' => 'nullable|string|max:11',
            'swift_code' => 'nullable|string|max:11',
            'status' => 'required|in:active,inactive',
            'website' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Find the vendor by ID
        $vendor = Vendor::findOrFail($id);
    
        // Update vendor details
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;
        $vendor->phone_number = $request->phone_number;
        $vendor->national_id = $request->national_id;
        $vendor->address = $request->address;
        $vendor->company_name = $request->company_name;
        $vendor->bank_account_no = $request->bank_account_no;
        $vendor->account_holder_name = $request->account_holder_name;
        $vendor->branch_name = $request->branch_name;
        $vendor->bank_name = $request->bank_name;
        $vendor->Tax_number = $request->Tax_number;
        $vendor->code_type = $request->code_type;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->swift_code = $request->swift_code;
        $vendor->status = $request->status;
        $vendor->website = $request->website;
    
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
    
            // Update the vendor's profile_picture attribute
            $vendor->profile_picture =  $fileName;
        }
    
        // Check if a new password has been entered
        if ($request->filled('password')) {
            // Hash the new password and update it
            $vendor->password = Hash::make($request->password);
        }
    
        // Save the updated vendor details
        if (!$vendor->save()) {
            return redirect()->back()->withErrors('Failed to update vendor.');
        }
    
        // Redirect back with a success message
        return redirect()
            ->back() // pr add 10-10-25
            // ->route('admin.users.vendors.index')
            ->with('success', 'Vendor updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        
        if ($vendor) {
            $vendor->delete();  // This performs a soft delete
            return redirect()
                ->back() // pr add 10-10-25
                // ->route('admin.users.vendors.index')
                ->with('success', 'Vendor moved to trash.');
        }

        return redirect()->route('admin.users.vendors.index')->with('error', 'vendor not found.');
    }

    /**
     * view all trashed vendors.
     */
    public function trashed()
    {
        $vendors = Vendor::onlyTrashed()->get();  // Retrieve only soft deleted vendors
        return view('Admin.users.vendors.trash', compact('vendors'));
    }

    /**
     * restore  soft deleted vendors.
     */
    public function restore($id)
    {
        $vendor = Vendor::onlyTrashed()->where('id', $id)->first();
        
        if ($vendor) {
            $vendor->restore();  // Restore the soft deleted vendors
            return redirect()->route('admin.users.vendors.trash')->with('success', 'Vendor restored successfully.');
        }

        return redirect()->route('admin.users.vendors.trash')->with('error', 'Vendor not found.');
    }

    /**
     * permanatly delete soft deleted vendors.
     */
    public function forceDelete($id)
    {
        $vendor = Vendor::onlyTrashed()->where('id', $id)->first();
        
        if ($vendor) {
            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($vendor->profile_picture && file_exists(public_path('uploads/vendors/' . $vendor->profile_picture))) {
                unlink(public_path('uploads/vendors/' . $vendor->profile_picture));
            }
            // /pr
            $vendor->forceDelete();  // Permanently delete the vendors
            return redirect()->route('admin.users.vendors.trash')->with('success', 'Vendor permanently deleted.');
        }

        return redirect()->route('admin.users.vendors.trash')->with('error', 'Vendor not found.');
    }

    // pr
    public function filter(Request $request)
    {
        try {
            // $companyId = $request->company_id;
            $companyId = $request->query('company_id'); // pe add 10-10-25
    
            // Fetch customers based on selected company
            if ($companyId == 'all' || empty($companyId)) {
                $vendors = Vendor::with('VendorCompany')->get(); // Load companies relation
            } else {
                $vendors = Vendor::whereHas('VendorCompany', function ($query) use ($companyId) {
                    $query->where('companies.id', $companyId);
                })->get();
            }

            $active = $vendors->where('status', 'active')->count();
            $deactive = $vendors->where('status', 'inactive')->count();
            
            return response()->json([
                'count' => $vendors->count(),
                'active' => $active,
                'deactive' => $deactive,
                'data' => $vendors,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching vendors: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }    

}
