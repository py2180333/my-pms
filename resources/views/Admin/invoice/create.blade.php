@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    @php
    $milestoneData = session('milestoneData', []);
    @endphp
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header invoices-page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="breadcrumb invoices-breadcrumb">
                            <li class="breadcrumb-item invoices-breadcrumb-item">
                                <a href="invoices.html">
                                    <i class="fa fa-chevron-left"></i> Back to Invoice List
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <div class="invoices-create-btn">
                            <!-- <a class="invoices-preview-link" href="#" data-bs-toggle="modal" data-bs-target="#invoices_preview"><i class="fa fa-eye"></i> Preview</a> -->
                            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#delete_invoices_details" class="btn delete-invoice-btn">
                                    Delete Invoice
                                </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#save_invocies_details" class="btn save-invoice-btn">
                                    Save Draft
                                </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Page Header -->

        <!-- error message pr add 25-9-25 -->
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <!-- /error message -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card invoices-add-card">
                        <div class="card-body">
                            <form action="{{route('admin.invoice.store')}}" method="POST" id="invoiceForm" class="invoices-form" enctype="multipart/form-data">
                                @csrf
                                <div class="invoices-main-form">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>PO Number</label>
                                                <input class="form-control" name="invoice-p-no" type="text" placeholder="PO Number">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                                            <!-- <h4 class="invoice-details-title">Invoice details</h4> -->
                                            <h4 class="invoice-details-title">Invoice Date</h4>
                                            <div class="invoice-details-box">
                                                
                                                <div class="invoice-inner-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="invoice-inner-date">
                                                                <span>
                                                                    Date 
                                                                    <input class="form-control w-100" name="invoice-date" id="dateField" type="date" placeholder="15/02/2022">
                                                                </span>
                                                            </div>
                                                        </div>
                                                            <!-- <div class="col-lg-6 col-md-6">
                                                                <div class="invoice-inner-date invoice-inner-datepic">
                                                                    <span>
                                                                            Due Date <input class="form-control" name="invoice-due-date" type="date">
                                                                    </span>
                                                                </div>
                                                            </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="invoice-item">
                                        <strong class="customer-text">Invoice From</strong>
                                        <div class="form-group row">
                                                        <div class=" col-lg-6 col-md-6 my-com">
                                                            <label class="col-form-label">Select Company<span class="text-danger">*</span></label>
                                                            @if(!empty($milestoneData))
                                                                <select name="company_id" class="form-control company-select" id="rd-company" readonly>
                                                                    {{-- <option value="" disabled selected>Select a company</option> --}}
                                                                        <option value="{{ $milestoneData['mtcompanyID'] ?? 'N/A' }}">{{ $milestoneData['mtcompanyname'] ?? 'N/A' }}</option>
                                                                </select>
                                                            @else
                                                                <select name="company_id" class="form-control form-select company-select rd-company" id="rd-company">
                                                                    <option value="" disabled selected>Select Company</option>
                                                                    @foreach ($companys as $company)
                                                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            <input type="hidden" name="companyname" id="rd-company-name">
                                                            <input type="hidden" name="companylogo" id="rd-company-logo">
                                                        </div>
                                                        <div class=" col-lg-6 col-md-6">
                                                            <label class="col-form-label">Address</label>
                                                            <textarea class="form-control company-address"  placeholder="Address"  rows="4" name="companyaddress" id="rd-addresss" readonly cols="50" style="overflow: hidden; resize: none; height: 50px;"></textarea>
                                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                            <input class="form-control" name="companyemail" type="email" id="rd-email"  pattern="[^@\s]+@[^@\s]+" required placeholder="Example@gmail.com" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Tax No<span class="text-danger">*</span></label>
                                            <input class="form-control" name="companygst" id="rd-gst" type="text" required placeholder="24AAACH7409R2Z6" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 mynumber">
                                            <label class="col-form-label ">Phone Number<span class="text-danger">*</span></label>
                                            <input class="form-control" name="companynumber" id="rd-phone-number" type="text" required placeholder=" +91" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">PAN No<span class="text-danger">*</span></label>
                                            <input class="form-control" name="companypan" id="rd-pan-number" type="text" required placeholder="BAJPC4350M" readonly>
                                        </div>
                                    </div>
                                    <h4>Company Bank Detail</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6">
                                            <label class="col-form-label">Account Number<span class="text-danger">*</span></label>
                                            <input type="text" id="rd-bank-account-number" name="bank_account_no" placeholder="Account Number" readonly class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Account Holder Name<span class="text-danger">*</span></label>
                                            <input type="text" id="rd-account-holder-name" name="account_holder_name" class="form-control" readonly required placeholder="Holder Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-2">
                                            <label class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                                            <input type="text" id="rd-bank-name" readonly name="bank_name" class="form-control" required placeholder="Bank Name">
                                        </div>
                                        <div class="col-lg-4 col-md-2">
                                            <label class="col-form-label">Branch Name<span class="text-danger">*</span></label>
                                            <input type="text" id="rd-branch-name" readonly name="branch_name" class="form-control" required placeholder="Branch Name" name="" id="">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <label class="col-form-label">IFSC Code</label>
                                            <input type="text" id="rd-ifsc-code" readonly name="ifsc_code" class="form-control"  placeholder="Enter IFSC Code">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-lg-4 col-md-4">
                                            <label class="col-form-label">SWIFT Code</label>
                                            <input type="text" id="rd-swift-code" readonly name="swift_code" class="form-control"   placeholder="Enter SWIFT Code">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <label class="col-form-label">IBAN Code</label>
                                            <input type="text" id="rd-iban-code" readonly name="iban_code" class="form-control"  placeholder="Enter IBAN Code">
                                        </div>
                                    </div>

                                    @if(!empty($milestoneData))
                                        <div class="milestoneBased">
                                            <div class="row">
                                                <strong class="customer-text">Invoice To</strong>
                                                <div class="col-xl-6 col-md-6 col-sm-12 col-12 my-com">
                                                    <label class="col-form-label " for="">Customer<span class="text-danger">*</span></label>
                                                    <input type="text" readonly  value="{{ $milestoneData['customerNameF'] ?? 'N/A' }}" class="form-control customer-select ">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 ">
                                                    <div class="invoice-info">
                                                        <label for="customer-address" class="form-label">Address</label>
                                                        <textarea id="customer-address" readonly name="customer_address" class="form-control customer-address" style="overflow: hidden; resize: none; height: 55px;">{{ $milestoneData['customerAddress'] ?? 'N/A' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Tax.No</label>
                                                    <input class="form-control" type="text" readonly name="customer_gst_no" value="{{ $milestoneData['customerTax'] ?? 'N/A' }}" required placeholder="24AAACH7409R2Z6">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Customer Company Name</label>
                                                    <input class="form-control" value="{{$milestoneData['customerName'] ?? 'N/A'}}" readonly type="text" name="customer_company_name"  required >
                                                    <input class="form-control" value="{{$milestoneData['customerId'] ?? ''}}" readonly type="hidden" name="customer_id"   required >
                                                    <input class="form-control" value="{{$milestoneData['milestoneId'] ?? ''}}" readonly type="hidden" name="milestone_id"   required >
                                                </div>
                                            </div>
                                            <div class="invoice-add-table">
                                                <h4>Invoice Item</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-nowrap  mb-0 no-footer add-table-items ">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No</th>
                                                                <th>Discripation</th>
                                                                <th>Rate</th>
                                                                <th>Quantity</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="add-row">
                                                                <td>
                                                                    <input type="text" value="1" name="invoiceItems[0][sr_no]" readonly class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" readonly name="invoiceItems[0][description]" value="{{ $milestoneData['milestoneName'] ?? 'N/A' }}" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" readonly name="invoiceItems[0][rate]" oninput="calculateSubtotal(this)" value="{{ $milestoneData['amount'] ?? 'N/A' }}" class="form-control rate">
                                                                </td>
                                                                <td>
                                                                    <input type="number"  min="1" readonly name="invoiceItems[0][quantity]" value="1"  class="form-control qty" oninput="calculateSubtotal(this)">
                                                                </td>
                                                            
                                                                <td>
                                                                    <input type="text"   readonly value="{{ $milestoneData['amount'] ?? 'N/A' }}" name="invoiceItems[0][amount]" class="form-control subtotal">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="manualSelect">
                                            <div class="row">
                                                <strong class="customer-text">Invoice To</strong>
                                                <div class="col-xl-6 col-md-6 col-sm-12 col-12 my-com">
                                                    <label class="col-form-label " for="">Customer<span class="text-danger">*</span></label>
                                                    <select  id="customer-id" name="customer_id" class="form-control form-select customer-select customer-id">
                                                        <option value=""  disabled selected>Select Customer</option>
                                                        {{-- @foreach ($customers as $customer)
                                                            <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 ">
                                                    <div class="invoice-info">
                                                        <label for="customer-address"  class="form-label">Address</label>
                                                        <textarea id="customer-address" placeholder="Address"  name="customer_address" readonly class="form-control customer-address" style="overflow: hidden; resize: none; height: 55px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Tax No</label>
                                                    <input class="form-control" id="customer-gst-no" name="customer_gst_no" readonly type="text" required placeholder="24AAACH7409R2Z6">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Customer Company Name</label>
                                                    <input class="form-control" id="customer-company-name" readonly type="text" name="customer_company_name" placeholder="Customer Company Name"  required >
                                                </div>
                                            </div>
                                            <div class="invoice-add-table">
                                                <h4>Invoice Item</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-nowrap  mb-0 no-footer add-table-items ">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No</th>
                                                                <th>Discripation</th>
                                                                <th>Rate</th>
                                                                <th>Quantity</th>
                                                                <th>Amount</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="add-row">
                                                                <td>
                                                                    <input type="text" name="invoiceItems[0][sr_no]"  class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="invoiceItems[0][description]" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="invoiceItems[0][rate]" class="form-control rate" oninput="calculateSubtotal(this)">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="invoiceItems[0][quantity]" value="1"  min="1"  name="qty"  class="form-control qty" oninput="calculateSubtotal(this)">
                                                                </td>
                                                            
                                                                <td>
                                                                    <input type="text" readonly name="invoiceItems[0][amount]"  class="form-control subtotal">
                                                                </td>
                                                                <td class="add-remove text-end">
                                                                    <a href="javascript:void(0);" class="add-btns me-2"><i class="fas fa-plus-circle"></i></a>
                                                                    <a href="#" class="copy-btn me-2"><i class="fas fa-copy"></i></a>
                                                                    <a href="javascript:void(0);" class="remove-btn"><i class="fa fa-trash-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                {{-- </div> --}}
                               
                                <div class="row">
                                    <div class="col-lg-7 col-md-6">
                                        <div class="invoice-fields">
                                        </div>
                                        <div class="invoice-faq">
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="faq-tab">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <p class="panel-title">
                                                                <a class="collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="fas fa-plus-circle me-1"></i> Add Notes
                                                                    </a>
                                                            </p>
                                                        </div>
                                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                                            <div class="panel-body">
                                                                <textarea class="form-control" name="note"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="invoice-fields mt-3">
                                                    <h4 class="field-title">Terms And Conditions</h4>
                                                    <ol>
                                                        <li class="mt-2"><strong>Payment Terms:</strong> Payment is due within 30 days from the invoice date. Late payments will incur a 2% late fee after 30 days.</li>
                                                        <li class="mt-2"><strong>Accepted Payment Methods:</strong> Payments can be made via bank transfer, credit card, or PayPal. Bank transfer details: XYZ Bank, Account Number: 123456789, Routing Number: 987654321.</li>
                                                        <li class="mt-2"><strong>Currency:</strong> All payments must be made in USD.</li>
                                                        <li class="mt-2"><strong>Dispute Resolution:</strong> Any disputes regarding this invoice must be raised within 15 days from the invoice date. Disputes will be resolved through arbitration.</li>
                                                        <li class="mt-2"><strong>Taxes:</strong> All applicable taxes are included in the total amount unless specified otherwise. The client is responsible for any additional taxes.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="invoice-total-card">
                                            <h4 class="invoice-total-title">Summary</h4>
                                            <div class="invoice-total-box">
                                                <div class="invoice-total-inner">
                                                    
                                                    <!-- <p>Round Off
                                                        <input type="checkbox" id="status_1" class="check">
                                                        <label for="status_1" class="checktoggles">checkbox</label>
                                                        <span>0</span>
                                                    </p> -->
                                                    <div class="links-info-one">
                                                        <div class="links-info">
                                                            <div class="links-cont">
                                                                <a href="#" class="service-trash">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <a href="javascript:void(0);" class="add-links1">
                                                            <i class="fas fa-plus-circle me-1"></i> Additional Charges
                                                        </a> -->
                                                    <div class="links-info-discount">
                                                        
                                                        <div class="invoice-total-footer">
                                                            <label class="col-form-label"> 
                                                                <h4>Sub Total </h4>
                                                            </label>
                                                            <input type="text" class="form-control" readonly name="alltotal" value="{{ $milestoneData['amount'] ?? '' }}" id="alltotal">
                                                        </div>
                                                        <div class="links-cont-discount">
                                                            <a href="javascript:void(0);" class="add-links-one">
                                                                <i class="fas fa-plus-circle me-1"></i>TAX
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-total-footer">
                                                    <label class="col-form-label"> <h4>Total Amount </h4></label><input type="text" class="form-control" value="{{ $milestoneData['amount'] ?? '' }}"  name="grandtotal" id="finaltotal" readonly>
                                                </div>
                                                <div class="invoice-total-footer">
                                                    <label class="col-form-label" for="currency-dropdown"><h4>Choose Currency:</h4></label>
                                                    <select class="form-control form-select" name="currency" id="currency-dropdown">
                                                        <!-- Options will be dynamically populated -->
                                                    </select>
                                                </div>
                                                <div class="invoice-total-footer border-none">
                                                    <label class="col-form-label"> <h4>Select Template</h4></label>
                                                        <select class="form-control form-select" name="template">
                                                            <option value="1">thequantumtech</option>
                                                            <option value="2">vivekinfotech</option>
                                                            <option value="3"> uniotech</option>
                                                            <option value="4">vivekinfotech FZCO</option>
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="upload-sign">
                                            {{-- <div class="form-group service-upload">
                                                <span>Upload Sign</span>
                                                  
                                            </div> --}}
                                            <input type="hidden" name="signature" id="rd-sign"> 
                                            <div class="form-group">
                                                <input type="hidden" name="sign-name" id="rd-signname" class="form-control" placeholder="Name of the Signatuaory">
                                                <input type="hidden" name="prefix" id="rd-prefix">
                                            </div>
                                            <div class="form-group float-end mb-0">
                                                <button type="button" class="btn btn-primary"  id="previewButton" data-url="{{route('admin.invoice.preview')}}">Preview</button>
                                                <button class="btn btn-primary" type="submit">Save Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    <script>
        // Get today's date
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD

        // Set the default value of the input field to today's date
        document.getElementById('dateField').setAttribute('value', formattedDate);

        //fetching company details
        document.addEventListener('DOMContentLoaded', function () {
            const companyDropdown = document.getElementById('rd-company');
            
            const companyAddress = document.getElementById('rd-addresss');
            const companyEmail = document.getElementById('rd-email');
            const companyName = document.getElementById('rd-company-name');
            const companyGST = document.getElementById('rd-gst');
            const companyPN = document.getElementById('rd-phone-number');
            const companyPan = document.getElementById('rd-pan-number');
            const companybankAccountNo = document.getElementById('rd-bank-account-number');
            const companyAccountHolderN = document.getElementById('rd-account-holder-name');
            const companyAccountBankName = document.getElementById('rd-bank-name');
            const companyAccountBranchName = document.getElementById('rd-branch-name');
            const companyAccountIFSC = document.getElementById('rd-ifsc-code');
            const companyAccountSwift = document.getElementById('rd-swift-code');
            const companyAccountIban = document.getElementById('rd-iban-code');
            const companySign = document.getElementById('rd-sign');
            const companySignname = document.getElementById('rd-signname');
            const companyPrefix = document.getElementById('rd-prefix');

            const customerDropdown  = document.getElementById('customer-id');
            const customerAddress = document.getElementById('customer-address');
            const customerGST = document.getElementById('customer-gst-no');
            const customerCompany = document.getElementById('customer-company-name');
            const companyLogo = document.getElementById('rd-company-logo');

            
            // Resource change event
            companyDropdown.addEventListener('change', function () {
                const companyId = this.value;

                // Clear fields
                companyAccountIFSC.value = '';
                companyAccountIban.value = '';
                companyAccountBranchName.value = '';
                companyAccountBankName.value = '';
                companyAccountHolderN.value = '';
                companybankAccountNo.value = '';
                companyAddress.value = '';
                companyEmail.value = '';
                companyGST.value = '';
                companyPN.value = '';
                companyPan.value = '';
                companyName.value = '';
                companyLogo.value = '';
                companySign.value = '';
                companySignname.value = '';
                companyPrefix.value = '';
                companyAccountSwift.value = '';

                if (companyId) {
                    fetch(`/admin/get-company-details/${companyId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Now `data` directly contains consultant details
                            companySign.value = data.sign || '';
                            companySignname.value = data.signname || '';
                            companyPrefix.value = data.prefix || '';
                            companyAddress.value = data.address || '';
                            companyEmail.value = data.email || '';
                            companyName.value = data.name || '';
                            companyLogo.value = data.logo || '';
                            companyGST.value = data.gst_number || '';
                            companyPan.value = data.pan_number || '';
                            companyPN.value = data.phone_number || '';
                            companyAccountIFSC.value = data.ifsc_code || '';
                            companyAccountSwift.value = data.swift_code || '';
                            companyAccountIban.value = data.iban_code || 'dd';
                            companyAccountBranchName.value = data.branch_name || '';
                            companyAccountBankName.value = data.bank_name || '';
                            companyAccountHolderN.value = data.account_holder_name || '';
                            companybankAccountNo.value = data.bank_account_no || '';
                        })
                        .catch(error => console.error('Error fetching resource details:', error));
                }
            });

            //customer change event
            customerDropdown.addEventListener('change',function(){
                const customerID = this.value;
                customerAddress.value = '';
                customerGST.value = '';
                customerCompany.value = '';

                if(customerID){
                    fetch(`/admin/get-customer-details/${customerID}`)
                    .then(response => response.json())
                    .then(data =>{
                        customerAddress.value = data.customeraddress || '';
                        customerGST.value = data.customergst || '';
                        customerCompany.value = data.customercompany || '';
                    })
                    .catch(error => console.error('Error fetching resource details:', error));
                }
            });

        });

        document.addEventListener('DOMContentLoaded', function () {
            const companyDropdown = document.getElementById('rd-company');

            if (companyDropdown && companyDropdown.value) {
                companyDropdown.dispatchEvent(new Event('change')); // Trigger event manually
            }
        });
        function calculateSubtotal(element) {
            // Get the row of the input field
            const row = element.closest('tr');

            // Find the rate and qty inputs in the same row
            const rate = parseFloat(row.querySelector('.rate').value) || 0;
            const qty = parseFloat(row.querySelector('.qty').value) || 1;

            // Calculate the subtotal
            const subtotal = rate * qty;

            // Set the subtotal value in the same row
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            calculateTotal();
        }
    
        function calculateTotal() {
            // Get all subtotal inputs
            const subtotals = document.querySelectorAll('.subtotal');

            // Calculate the sum of all subtotals
            let total = 0;
            subtotals.forEach(subtotal => {
                total += parseFloat(subtotal.value) || 0;
            });

            // Update the total input field
            document.getElementById('alltotal').value = total.toFixed(2);
            
                // Check if the tax field exists
            const taxField = document.querySelector('#tax');
            let finalTotal;

            if (taxField) {
                // If tax field exists, calculate the final total with tax
                const taxPercentage = parseFloat(taxField.value) || 0;
                finalTotal = total + (total * taxPercentage / 100);
            } else {
                // If tax field does not exist, use the total as the final total
                finalTotal = total;
            }

            // Update the final total input field
            document.getElementById('finaltotal').value = finalTotal.toFixed(2);

        }
    </script>
@endsection
@section('script')
<script src="{{asset('/assets/js/invoicecompanybasedcustomer.js')}}"></script>
@endsection