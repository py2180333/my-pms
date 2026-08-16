<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\milestone;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; //pr
use App\Notifications\InvoiceGenerateNotification; // pr
use Illuminate\Support\Facades\Validator; // pr add 14-10-25

class InvoiceController extends Controller
{
    public function index(){
        $companys = Company::all();
        $invoices = Invoice::all();
        return view('Admin.invoice.index',compact('invoices','companys'));
    }
    // Handle Ajax request for filtering invoices
    public function fetchInvoices(Request $request)
    {
        $startDate = $request->startDate; // pr
        $endDate = $request->endDate; // pr
        
        $query = Invoice::with('milestone','customer');
        //dd($query);

        // Filter by date -pr
        if (filled($startDate) && filled($endDate)) {
            $query->whereBetween('invoice_date',[$startDate, $endDate]);
        }

        // Filter by company
        if ($request->has('company_id') && $request->company_id != 'all') {
            $query->where('company_id', $request->company_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter by invoice type
        if ($request->has('invoice_type')) {
            if ($request->invoice_type == 'milestone') {
                $query->whereNotNull('milestone_id');
            } elseif ($request->invoice_type == 'custom') {
                $query->whereNull('milestone_id');
            }
        }

        $invoices = $query->get();
        $paidInvoice = (clone $query)->where('status', 'paid')->get();
        $overdueInvoice = (clone $query)->where('status', 'overdue')->get();
        $pendingInvoice = (clone $query)->where('status', 'pending')->get();

        return response()->json([
            'count' => $invoices->count(),
            'paid' => $paidInvoice->count(),
            'overdue' => $overdueInvoice->count(),
            'pending' => $pendingInvoice->count(),
            'data' => $invoices,
        ]);
    }


    public function create(Request $request){

        // $customers = Customer::all();
        // $companys = Company::all();
        // return view('Admin.invoice.create',compact('companys','customers'));

        if(empty($request->query('milestone_id'))){
            $customers = Customer::all();
            $companys = Company::all();
            return view('Admin.invoice.create',compact('companys','customers'));
        } else {
            $id = $request->query('milestone_id');


            // Fetch milestone with related project and customer
            $milestone = Milestone::with('project.customer')->findOrFail($id);

            // Extract customer details from the project relationship
            $customer = $milestone->project->customer ?? null;
            $company = $milestone->project->company ?? null;
            // Fetch the first associated company of the customer (assuming a customer can have multiple companies)
            //$company = $customer ? $customer->companies()->first() : null;

            // Pass milestone and customer data to the session
            session()->flash('milestoneData', [
                'mtcompanyID' => $company->id,
                'mtcompanyname' => $company->company_name,
                'milestoneId' => $id,
                'customerId' => $customer->id ?? 'N/A',
                'customerNameF' => $customer->first_name ?? 'N/A',
                'customerName' => $customer->company_name ?? 'N/A',
                'customerAddress' => $customer->address ?? 'N/A',
                'customerTax' => $customer->tax_number ?? 'N/A',
                'amount' => $milestone->amount,
                'milestoneName' => $milestone->milestone_name ?? 'N/A',
                'currency' => $milestone->project->currency, //pr
                
            ]);

            return view('Admin.invoice.create');
        }
        
    }

    //fetching customer based on companies
    public function getCustomersByCompany(Request $request)
    {
        $companyId = $request->company_id;
       $customers = Customer::whereHas('companies', function ($query) use ($companyId) {
            $query->where('companies.id', $companyId);
        })->get();
        return response()->json($customers);
    }


    public function companyDetails($id)
    {
        // Find the company by its ID
        $company = Company::find($id);

        // Check if the company exists
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        // Return the company details as JSON
        return response()->json([
            'address' => $company->address,
            'email' => $company->email,
            'phone_number' => $company->phone_number,
            'gst_number' => $company->gst_number,
            'pan_number' => $company->pan_number,
            'logo' => $company->logo,
            'name' => $company->company_name,
            'phone_number' => $company->phone_number,
            'bank_account_no' => $company->bank_account_no,
            'account_holder_name' => $company->account_holder_name,
            'branch_name' => $company->branch_name,
            'bank_name' => $company->bank_name,
            'ifsc_code' => $company->ifsc_code,
            'sign' => $company->sign,
            'signname' => $company->signname,
            'prefix' => $company->prefix,
            'swift_code' => $company->swift_code,
            'iban_code' => $company->iban_code,
        ]);
    }
    //fetching customer detail in invoice 
    public function customerDetails($id){
        // Find the customer by its ID
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        return response()->json([
            'customeraddress' =>$customer->address,
            'customergst' => $customer->tax_number,
            'customercompany' => $customer->company_name,
        ]);
    }
    
    private function numberToWords($number)
    {
        $hyphen = '-';
        $separator = ', ';
        $decimal = ' Point ';
        $dictionary = [
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        ];

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return 'Negative ' . $this->numberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos((string) $number, '.') !== false) {
            [$number, $fraction] = explode('.', (string) $number);
        }

        $number = (int) $number;

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = (int) ($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= ' ' . $this->numberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $separator . $this->numberToWords($remainder);
                }
                break;
        }

        if ($fraction && is_numeric($fraction)) {
            $fraction = str_pad($fraction, 2, '0'); // Pad to 2 digits
            $fractionValue = (int) $fraction;
            $string .= $decimal . $this->numberToWords($fractionValue);
        }

        return ucwords($string);
    }
    //indian separator
    function formatIndianNumber($num) {
    // Step 1: Ensure it's a valid number
        $num = floatval($num);

        // Step 2: Format to 2 decimal places
        $parts = explode('.', number_format($num, 2, '.', ''));

        // Step 3: Separate integer and decimal parts
        $integerPart = $parts[0];
        $decimalPart = $parts[1];

        // Step 4: Get last 3 digits
        $lastThree = substr($integerPart, -3);
        $otherDigits = substr($integerPart, 0, -3);

        // Step 5: Format other digits in groups of 2
        if ($otherDigits !== '') {
            $otherDigits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $otherDigits);
            $formatted = $otherDigits . ',' . $lastThree;
        } else {
            $formatted = $lastThree;
        }

        // Step 6: Combine with decimal part
        return $formatted . '.' . $decimalPart;
    }
    //fetching invoice data in preview
    public function preview(Request $request){
        $data = $request->all();
        $template = $data['template'] ?? null;
        $gst = $data['gst'] ?? 1;
        $cgst = $gst / 2;
        $total = $data['alltotal'] ?? 1;
        $gsta = $gst * $total / 100;
        $GstAmount = number_format($gsta, 2, '.', '');
        $CGstAmount = number_format($gsta / 2, 2, '.', '');

        $prefix = $data['prefix'] ?? 'ND';
        //get the last invoice for the same prefix,year,month
        $lastInvoice = Invoice::where('prefix', $prefix)
        ->whereYear('invoice_date', now()->year)
        ->whereMonth('invoice_date', now()->month)
        ->orderBy('id', 'desc')
        ->first();
        // Determine the next invoice number for this prefix
        $nextInvoiceNumber = $lastInvoice ? (int)explode('_', $lastInvoice->invoice_number)[3] + 1 : 1;

        // Generate the new invoice number in the format: prefix_month_year_invoiceNumber
        $invoiceNumber = $prefix . '_' . str_pad(now()->month, 2, '0', STR_PAD_LEFT) . '_' . now()->year . '_' . $nextInvoiceNumber;
        // Process the data as needed for the preview
        $previewData = [
            'invoicePoN' => $data['invoice-p-no'] ?? '',
            'invoiceDate' => $data['invoice-date'] ?? '',
            'invoiceDueD' => $data['invoice-due-date'] ?? '',
            'companyName' => $data['companyname'] ?? '',
            'companyLogo' => $data['companylogo'] ?? '',
            'companyAddress' => $data['companyaddress'] ?? '',
            'companyEmail' => $data['companyemail'] ?? '',
            'companyNumber' => $data['companynumber'] ?? '',
            'companyPan' => $data['companypan'] ?? '',
            'companyGst' => $data['companygst'] ?? '',
            'companyBankAcN' => $data['bank_account_no'] ?? '',
            'companyAcHoName' => $data['account_holder_name'] ?? '',
            'companyBankN' => $data['bank_name'] ?? '',
            'companyBankBN' => $data['branch_name'] ?? '',
            'companyIFSC' => $data['ifsc_code'] ?? '',
            'companySwift' => $data['swift_code'] ?? '',
            'companyIBAN' => $data['iban_code'] ?? 'null',
            //customer details
            'customerCompany' => $data['customer_company_name'] ?? '',
            'customerAddress' => $data['customer_address'] ?? '',
            'customerGst' => $data['customer_gst_no'] ?? '',
            //invoce bill details
            'invoiceItems' => $data['invoiceItems'] ?? [],
            'allTotal' => $this->formatIndianNumber($data['alltotal'] ?? 0),
            'GST' => $data['gst'] ?? '-',
            'CGST' => $cgst ?? '-',
            'optionTax' => $data['option_tax'] ?? 'gst',
            'grandtotal' => $this->formatIndianNumber($data['grandtotal'] ?? 0),
            'Note' => $data['note'] ?? '',
            'Signature' => $data['signature'] ?? null,
            'SignName' => $data['sign-name'] ?? '',
            'Currency' => $data['currency'] ?? 'INR',
            'invoiceID' => $invoiceNumber,
            'gstAmount' => $this->formatIndianNumber($GstAmount),
            'cgstAmount' => $this->formatIndianNumber($CGstAmount),
            'AmountInWords' => $this->numberToWords($data['grandtotal'] ?? 0),
        ];
        if($template == 1){
        return view('Admin.invoice.preview.tqt',compact('previewData'));
        }
        if($template == 2){
            return view('Admin.invoice.preview.vivekinfotech',compact('previewData'));
        }
        if($template == 3){
            return view('Admin.invoice.preview.uniotech',compact('previewData'));
        }
        if($template == 4){
            return view('Admin.invoice.preview.vivak_fzco',compact('previewData'));
        }
    }
    
    //store invoce data in database
    public function store(Request $request)
    {
        try {
            
            // pr
            $milestoneId = $request->input('milestone_id');
            if(filled($milestoneId)){
                $mId = Invoice::where('milestone_id', $milestoneId)->exists();
                if($mId){
                    if(Auth::check() && Auth::user()->role === 'project_manager'){
                        return redirect()->route('resource.projects.index')->with('error', 'Invoice is already created for this milestone.');
                    }
                    return redirect()->route('admin.projects.index')->with('error', 'Invoice is already created for this milestone.');
                }
            }
            // /pr

            // Start a database transaction
            \DB::beginTransaction();

            $prefix = $request->prefix;
            $today = now();

            // Determine current financial year start and end
            $financialYearStart = $today->month >= 4
                ? Carbon::create($today->year, 4, 1)
                : Carbon::create($today->year - 1, 4, 1);
 
            $financialYearEnd = $financialYearStart->copy()->addYear()->subDay();
            $lastInvoice = Invoice::where('prefix', $prefix)
                ->whereBetween('invoice_date', [$financialYearStart->toDateString(), $financialYearEnd->toDateString()])
                ->orderBy('id', 'desc')
                ->first();

            // Determine the next invoice number for this prefix
            $nextInvoiceNumber = $lastInvoice ? (int)explode('_', $lastInvoice->invoice_number)[3] + 1 : 1;
            // Generate the new invoice number in the format: prefix_month_year_invoiceNumber
            $invoiceNumber = $prefix . '_' . str_pad(now()->month, 2, '0', STR_PAD_LEFT) . '_' . now()->year . '_' . $nextInvoiceNumber;

            $createdByEmail = Auth::user()->email; // new -pr 22-7-25

            // Create the invoice
            $invoice = Invoice::create([
                'invoice_p_no' => $request->input('invoice-p-no'),
                'invoice_date' => $request->input('invoice-date'),
                'invoice_due_date' => $request->input('invoice-due-date'),
                'company_id' => $request->input('company_id'),
                'customer_id' => $request->input('customer_id'),
                'milestone_id' => $request->input('milestone_id'),
                'note' => $request->input('note'),
                'alltotal' => $request->input('alltotal'),
                'gst' => $request->input('gst'),
                'grandtotal' => $request->input('grandtotal'),
                'currency' => $request->input('currency'),
                'prefix' => $request->input('prefix'),
                'template' => $request->input('template'),
                'invoice_number' => $invoiceNumber,
                'option_tax' => $request->input('option_tax'),
                'created_by' => $createdByEmail,
            ]);

            // Create the invoice items
            foreach ($request->input('invoiceItems') as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'sr_no' => $item['sr_no'],
                    'description' => $item['description'],
                    'rate' => $item['rate'],
                    'quantity' => $item['quantity'],
                    'amount' => $item['amount'],
                ]);
            }

            // Commit the transaction
            \DB::commit();

            // pass notification data for customer -pr 18-8-25
            $company = Company::select('company_name')->findOrFail($request->input('company_id'));
            Customer::findOrFail($request->input('customer_id'))->notify(new InvoiceGenerateNotification($invoiceNumber, $company));

            // pr
            if(Auth::check() && Auth::user()->role === 'project_manager'){
                return redirect()->route('resource.projects.index')->with('success', 'invoice Create successfully');
            }
            // /pr

            //return response()->json(['message' => 'Invoice created successfully!', 'invoice' => $invoice], 201);
            return redirect()->route('admin.invoice.index')->with('success', 'invoice Create successfully');
        } catch (\Exception $e) {
            // Rollback the transaction
            \DB::rollBack();

            // pr add 25-9-25
            if(Auth::check() && Auth::user()->role === 'project_manager'){
                return redirect()->back()->with('error', 'something wrong try again'); // rd
            }
            // /pr add 25-9-25

            //return response()->json(['error' => $e->getMessage()], 500);
            return redirect()->back()->with('error', 'something wrong try again');
        }
    }
    
        //view single invoice 
    public function invoiceview($id)
    {
        $invoice = Invoice::find($id);
        $company = Company::find($invoice->company_id);
        $customer = Customer::find($invoice->customer_id);
        $invoiceitems = InvoiceItem::select()->where('invoice_id',$id)->get();
        $numberToWords = $this->numberToWords($invoice->grandtotal);
        return response()->json(['invoice' => $invoice, 'company'=>$company,'customer' => $customer,'invoiceitems'=>$invoiceitems, 'numberToWords' => $numberToWords]);
    }
    //pranav code
    function editDisplay($id){        
        // $currency = Currency::all();
        $invoice = Invoice::find($id);
        $company_id = Invoice::select(['company_id',])->where('id',$id)->get()->pluck('company_id');
        $customer_id = Invoice::select(['customer_id',])->where('id',$id)->get()->pluck('customer_id');
        $company = Company::find($company_id);
        $customer = Customer::find($customer_id);
        $invoiceitem = InvoiceItem::select()->where('invoice_id',$id)->get();
        $gerandtotal = Invoice::select(['grandtotal'])->where('id',$id)->get()->pluck('grandtotal');
        $gerandtotal_word = $this->numberToWords(floatval($gerandtotal->first()));
        return response()->json(['invoice'=>$invoice,'company'=>$company,'customer'=>$customer,'invoiceitem'=>$invoiceitem,'gerandtotal_word'=>$gerandtotal_word]);
    }

    //pranv code
    function edit(Request $request,$id){
        $invoice = Invoice::find($id);
        if($invoice->status=='paid'){
            return redirect()->back();
        }else{ 
            $updatedByEmail = Auth::user()->email; // new -pr 22-7-25
            $invoice->status = $request->status;
            $invoice->updated_by = $updatedByEmail;
            $invoice->save();
            if($invoice->status=='paid'){
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }
    }

    //delete invoice code
    function delete($id){
        // dd($id);
        $invoice = Invoice::find($id);
        if(!$invoice){
            return redirect()
                ->back() // pr add 15-10-25
                // ->route('admin.invoice.index')
                ->with('error', 'invoice not found');
        }
        $invoice->delete();
        return redirect()
            ->back() // pr add 15-10-25
            // ->route('admin.invoice.index')
            ->with('success', 'invoice delete  successfully');
    }

    // pr
    public function pmCreate(Request $request){
        // return view('resource.project_manager.invoice.create');
        
        // $validator = Validator::make($request->all(), [
        //     'milestone_id' => 'required|exists:milestones,id'
        // ]);

        // // dd(session('urlPath'));
        // if($validator->fails()){
        //     return redirect()->route('resource.projects.index')->withErrors($validator)->withInput();
        // }

        // $validated = $validator->validated();

        $id = $request->query('milestone_id');

        // Fetch milestone with related project and customer
        $milestone = Milestone::with('project.customer')->findOrFail($id);

        // Extract customer details from the project relationship
        $customer = $milestone->project->customer ?? null;
        $company = $milestone->project->company ?? null;
        // Fetch the first associated company of the customer (assuming a customer can have multiple companies)
        //$company = $customer ? $customer->companies()->first() : null;

        // Pass milestone and customer data to the session
        session()->flash('milestoneData', [
            'mtcompanyID' => $company->id,
            'mtcompanyname' => $company->company_name,
            'milestoneId' => $id,
            'customerId' => $customer->id ?? 'N/A',
            'customerNameF' => $customer->first_name ?? 'N/A',
            'customerName' => $customer->company_name ?? 'N/A',
            'customerAddress' => $customer->address ?? 'N/A',
            'customerTax' => $customer->tax_number ?? 'N/A',
            'amount' => $milestone->amount,
            'milestoneName' => $milestone->milestone_name ?? 'N/A',
            'currency' => $milestone->project->currency, //pr
            
        ]);

        return view('resource.project_manager.invoice.create');
    }

    // new -pr 31-7-25 "invoice list" for project manager use different functions.
    public function pmIndex(){
        $pmEmail = Auth::user()->email;
        $invoices = Invoice::where('created_by', $pmEmail)->get();
        return view('resource.project_manager.invoice.index',compact('invoices'));
    }

    // Handle Ajax request for filtering invoices new -pr 4-8-25
    public function pmFetchInvoices(Request $request)
    {
        $startDate = $request->startDate; // pr
        $endDate = $request->endDate; // pr
        $pmEmail = Auth::user()->email;
        
        $query = Invoice::with('milestone','customer');
        //dd($query);

        // Filter by date -pr
        if (filled($startDate) && filled($endDate)) {
            $query->whereBetween('invoice_date',[$startDate, $endDate]);
        }

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $invoices = $query->where('created_by', $pmEmail)->get();
        $paidInvoice = (clone $query)->where('status', 'paid')->get();
        $overdueInvoice = (clone $query)->where('status', 'overdue')->get();
        $pendingInvoice = (clone $query)->where('status', 'pending')->get();

        return response()->json([
            'count' => $invoices->count(),
            'paid' => $paidInvoice->count(),
            'overdue' => $overdueInvoice->count(),
            'pending' => $pendingInvoice->count(),
            'data' => $invoices,
        ]);
    }

    //pranav code new pr 5-8-25
    function pmEditDisplay($id){        
        // $currency = Currency::all();
        $invoice = Invoice::find($id);
        $company_id = Invoice::select(['company_id',])->where('id',$id)->get()->pluck('company_id');
        $customer_id = Invoice::select(['customer_id',])->where('id',$id)->get()->pluck('customer_id');
        $company = Company::find($company_id);
        $customer = Customer::find($customer_id);
        $invoiceitem = InvoiceItem::select()->where('invoice_id',$id)->get();
        $gerandtotal = Invoice::select(['grandtotal'])->where('id',$id)->get()->pluck('grandtotal');
        $gerandtotal_word = $this->numberToWords(floatval($gerandtotal->first()));
        return response()->json(['invoice'=>$invoice,'company'=>$company,'customer'=>$customer,'invoiceitem'=>$invoiceitem,'gerandtotal_word'=>$gerandtotal_word]);
    }

    //pranv code new pr 5-8-25
    function pmEdit(Request $request,$id){
        $invoice = Invoice::find($id);
        if($invoice->status=='paid'){
            return redirect()->back();
        }else{ 
            $updatedByEmail = Auth::user()->email; // new -pr 22-7-25
            $invoice->status = $request->status;
            $invoice->updated_by = $updatedByEmail;
            $invoice->save();
            if($invoice->status=='paid'){
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }
    }

    /* invoice list for customer new pr 8-8-25 */
    public function cusIndex() {
        $customerId = Auth::id();
        $invoice = Invoice::where('customer_id', $customerId)->get();
        return view('customer.invoice.index', compact('invoice'));
    }

    // Handle Ajax request for filtering invoices new -pr 8-8-25
    public function cusFetchInvoices(Request $request)
    {
        $startDate = $request->startDate; // pr
        $endDate = $request->endDate; // pr
        $customerId = Auth::id();
        
        $query = Invoice::with('milestone','customer');
        //dd($query);

        // Filter by date -pr
        if (filled($startDate) && filled($endDate)) {
            $query->whereBetween('invoice_date',[$startDate, $endDate]);
        }

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $invoices = $query->where('customer_id', $customerId)->get();
        $paidInvoice = (clone $query)->where('status', 'paid')->get();
        $overdueInvoice = (clone $query)->where('status', 'overdue')->get();
        $pendingInvoice = (clone $query)->where('status', 'pending')->get();

        return response()->json([
            'count' => $invoices->count(),
            'paid' => $paidInvoice->count(),
            'overdue' => $overdueInvoice->count(),
            'pending' => $pendingInvoice->count(),
            'data' => $invoices,
        ]);
    }
}
