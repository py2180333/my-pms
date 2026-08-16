<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminCompanyController extends Controller
{
     //dashboard of comapany
    public function index(){
        $companys = Company::all();
        return view('Admin.company.index',compact('companys'));
    }

    //create new company
    public function create(){
        return view('Admin.company.create');
    }

    //store a newly created comapny in storage.
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string:max:255',
            'bank_account_no' => 'nullable|string|max:20',
            'account_holder_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'sign' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'signname' => 'nullable|string|max:30',
            'prefix' => 'required|string|max:10',
            'ifsc_code' => 'nullable|string|max:11',
            'iban_code' => 'nullable',
            'swift_code' => 'nullable|string|max:15',
            'pan_number' => 'nullable|string|max:10',
            'gst_number' => 'nullable|string|max:25',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        //handle the file upload if the file is present
        if($request->hasFile('logo')){
            $logoName = time().'_' . uniqid() . '.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/logos'),$logoName);
            $validatedData['logo'] = $logoName;
        }
        //handle the signature upload if the file is present
        if($request->hasfile('sign')){
           $signName = time().'_' . uniqid() . '.'.$request->sign->extension();
           $request->sign->move(public_path('uploads/logos'),$signName);
           $validatedData['sign'] = $signName;
        }
        //store the company data
        $company = new company();
        $company->fill($validatedData);
        $company->save();
        return redirect()->route('admin.company.index')->with('success','company created successfully');
    }
    public function update(Request $request, string $id)
    {
        // Validate input
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate logo file
            'sign' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate signature file
            'update_name' => 'required|string|max:255',
            'update_email' => 'required|email|max:255',
            'update_number' => 'required|string|max:15',
            'update_pan' => 'required|string|max:10',
            'update_gst' => 'required|string|max:15',
            'update_address' => 'required|string',
            'update_prefix' => 'required|string|max:10',
            'update_signname' => 'required|string|max:255',
            'update_account_nu' => 'nullable|string|max:50',
            'update_holder_name' => 'nullable|string|max:255',
            'update_bank_name' => 'nullable|string|max:255',
            'update_branch_name' => 'nullable|string|max:255',
            'update_ifsc' => 'nullable|string|max:15',
            'update_swift' => 'nullable|string|max:15',
            'update_iban' => 'nullable',
        ]);

        // Find the company
        $company = Company::findOrFail($id);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($company->logo && file_exists(public_path('uploads/logos/' . $company->logo))) {
                unlink(public_path('uploads/logos/' . $company->logo));
            }

            // Save new logo
            $logoName = time() . '_logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/logos'), $logoName);
            $company->logo = $logoName;
        }

        // Handle signature upload
        if ($request->hasFile('sign')) {
            // Delete old signature if it exists
            if ($company->sign && file_exists(public_path('uploads/logos/' . $company->sign))) {
                unlink(public_path('uploads/logos/' . $company->sign));
            }

            // Save new signature
            $signName = time() . '_sign.' . $request->file('sign')->getClientOriginalExtension();
            $request->file('sign')->move(public_path('uploads/logos'), $signName);
            $company->sign = $signName;
        }

        // Update other fields
        $company->company_name = $request->update_name;
        $company->email = $request->update_email;
        $company->phone_number = $request->update_number;
        $company->pan_number = $request->update_pan;
        $company->gst_number = $request->update_gst;
        $company->address = $request->update_address;
        $company->prefix = $request->update_prefix;
        $company->signname = $request->update_signname;
        $company->bank_account_no = $request->update_account_nu;
        $company->account_holder_name = $request->update_holder_name;
        $company->bank_name = $request->update_bank_name;
        $company->branch_name = $request->update_branch_name;
        $company->ifsc_code = $request->update_ifsc;
        $company->swift_code = $request->update_swift;
        $company->iban_code = $request->update_iban;

        // Save updated company details
        $company->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Company details updated successfully!');
    }
    public function delete($id)
    {
        // Find the company
        $company = Company::findOrFail($id);

        // Delete logo file if it exists
        if ($company->logo && file_exists(public_path('uploads/logos/' . $company->logo))) {
            unlink(public_path('uploads/logos/' . $company->logo));
        }

        // Delete signature file if it exists
        if ($company->sign && file_exists(public_path('uploads/logos/' . $company->sign))) {
            unlink(public_path('uploads/logos/' . $company->sign));
        }

        // Delete the company record
        $company->delete();

        // Redirect or respond with success
        return redirect()->back()->with('success', 'Company deleted successfully!');
    }
}
