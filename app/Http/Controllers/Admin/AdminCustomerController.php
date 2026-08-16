<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class AdminCustomerController extends Controller
{

    public function filter(Request $request)
    {
        try {
            //$companyId = $request->company_id;
            $companyId = $request->query('company_id'); // rd

            // dd($companyId);
    
            // Fetch customers based on selected company
            if ($companyId == 'all' || empty($companyId)) {
                $customers = Customer::with('companies')->get(); // Load companies relation
            } else {
                $customers = Customer::whereHas('companies', function ($query) use ($companyId) {
                    $query->where('companies.id', $companyId);
                })->get();
            }

            // pr
            $active = $customers->where('status', 'active')->count();
            $deactive = $customers->where('status', 'deactive')->count();
            
            return response()->json([
                'count' => $customers->count(),
                'active' => $active,
                'deactive' => $deactive,
                'data' => $customers,
            ]);
            // /pr
    
            // return response()->json(['data' => $customers]); // rd
    
        } catch (\Exception $e) {
            \Log::error('Error fetching customers: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$customer = Customer::find(2);
        //dd($customer->companies); // Should return the list of assigned companies

        $companys = Company::select(['id','company_name'])->get();
        $customers = Customer::all();
        return  view('Admin.users.customers.index', compact('customers','companys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companys = Company::all();
        return view('Admin.users.customers.create',compact('companys'));
        //return view('Admin.users.customers.test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image
            'description'=> 'nullable',
            'email' => 'nullable|email|unique:customers,email',
            'phone_number' => 'nullable|string|max:25',
            //'national_id' => 'required|string|max:20',
            'address' => 'nullable|string',
            'company_name' => 'required|string|max:100',
            'company_phone_number' => 'nullable|string|max:25',
            'company_email' => 'nullable|email|unique:customers,company_email',
            'pan_number' => 'nullable|string|max:20',
            'tax_number' => 'nullable|string|max:20',
            'password' => 'required|string|confirmed|min:8',
            'company_ids' => 'required|array', // Ensure company selection is an array
            'company_ids.*' => 'exists:companies,id',
        ]);
    
        // Handle the file upload if the file is present
        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/customers'), $imageName);
            $validatedData['profile_picture'] = $imageName;
        }
    
        // Store the customer data
        $customer = new Customer();
        $customer->fill($validatedData);
        $customer->password = Hash::make($request->password);
        $customer->save();
        $customer->companies()->attach($request->company_ids);
    
        return redirect()->route('admin.users.customers.index')->with('success', 'Customer created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:15',
            //'national_id' => 'required|numeric',
            'address' => 'nullable|string|max:500',
            'company_name' => 'required|string|max:255',
            'status' => 'required|in:active,deactive',
            'company_phone_number' => 'nullable|string|max:15',
            'company_email' => 'nullable|email|max:255',
            'pan_number' => 'nullable|string|max:20',
            'tax_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        // Update customer details
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->description = $request->description;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        //$customer->national_id = $request->national_id;
        $customer->address = $request->address;
        $customer->company_name = $request->company_name;
        $customer->status = $request->status;
        $customer->company_phone_number = $request->company_phone_number;
        $customer->company_email = $request->company_email;
        $customer->pan_number = $request->pan_number;
        $customer->tax_number = $request->tax_number;

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

            // Update the customer's profile_picture attribute
            $customer->profile_picture =  $fileName;
        }

        //dd($customer->getAttributes());

        // Save the updated customer details
        if (!$customer->save()) {
            return redirect()->back()->withErrors('Failed to update customer.');
        }
        
        // Check if a new password has been entered
        if ($request->filled('password')) {
            // Hash the new password and update it
            $customer->password = Hash::make($request->password);
        }

        // Save the updated customer details
        $customer->save();

        // Redirect back with a success message
        return redirect()
            ->back()
            // ->route('admin.users.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        
        if ($customer) {
            $customer->delete();  // This performs a soft delete
            return redirect()
                ->back() // pr add 10-10-25
                // ->route('admin.users.customers.index')
                ->with('success', 'Customer moved to trash.');
        }

        return redirect()->route('admin.users.customers.index')->with('error', 'Customer not found.');
    }

    public function trashed()
    {
        $customers = Customer::onlyTrashed()->get();  // Retrieve only soft deleted customers
        return view('Admin.users.customers.trash', compact('customers'));
    }
    //admin restore soft delete customers
    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->where('id', $id)->first();
        
        if ($customer) {
            $customer->restore();  // Restore the soft deleted customer
            return redirect()->route('admin.users.customers.trash')->with('success', 'Customer restored successfully.');
        }

        return redirect()->route('admin.users.customers.trash')->with('error', 'Customer not found.');
    }

    //admin delete permanatly soft deleted customers
    public function forceDelete($id)
    {
        $customer = Customer::onlyTrashed()->where('id', $id)->first();
        
        if ($customer) {
            // pr
            // Delete old profile_picture if it exists new pr 8-8-25
            if ($customer->profile_picture && file_exists(public_path('uploads/customers/' . $customer->profile_picture))) {
                unlink(public_path('uploads/customers/' . $customer->profile_picture));
            }
            // /pr
            $customer->forceDelete();  // Permanently delete the customer
            return redirect()->route('admin.users.customers.trash')->with('success', 'Customer permanently deleted.');
        }

        return redirect()->route('admin.users.customers.trash')->with('error', 'Customer not found.');
    }
}
