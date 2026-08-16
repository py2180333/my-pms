@extends('Admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/assets/css/preview.css')}}">
@endsection
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper download_section" id="print">

    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="invoice-container-wrap" id="">
                    <div class="invoice-container">
                        <main>
                            <div class="tqt-invoice invoice_style21">
                                <div class="download-inner" id="download_section">
                                    <header class=" header-layout13">
                                        <div class="row align-items-center justify-content-between mb-4">
                                            <div class="col-auto">
                                                <div class="header-logo">
                                                    @if($previewData['companyLogo'])
                                                    <img src="{{ asset('uploads/logos/' . $previewData['companyLogo']) }}"  alt="companyLogo" />
                                                    @else
                                                        <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <h1 class="big-title">Invoice</h1>
                                            </div>
                                        </div>
                                        <hr class="style3">
                                        <div class="row justify-content-between">
                                            <div class="col-auto"><span><b>Invoice No. : </b>{{ $previewData['invoiceID']}}</span></div>
                                            @if($previewData['invoicePoN'] > 0 )
                                            <div class="col-auto"><span><b>PO No. : </b>{{ $previewData['invoicePoN'] }}</span></div>
                                            @endif
                                            <div class="col-auto"><span><b>Date : </b>{{ $previewData['invoiceDate'] }}</span></div>
                                        </div>
                                        <hr class="style3">
                                    </header> 
                                    <div class="row justify-content-between my-4">
                                        <div class="col-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text-one">Invoice From</strong>
                                                <table>
													<tr>
														<td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid;">
														  <strong class="invoice-name m-0">Name :</strong>
														</td>
														<td style="padding: 0px 0 !important; border: none;"><p class="invoice-name">{{ $previewData['companyName'] }}</p></td>
													</tr>
													<tr>

														<td style="padding: 0px 0 !important;width: 83px; border: none;"><strong class="me-2">Phone No. :</strong></td>
														<td style="padding: 0px 0 !important; border: none;"><p class="invoice-number">{{ $previewData['companyNumber'] }}</p></td>
													</tr>
													<tr>
														<td style="padding: 0px 0 !important;width: 80px; border: none;"><strong class="me-2">E-mail :</strong></td>
														<td style="padding: 0px 0 !important;border: none;"><p class="invoice-email">{{ $previewData['companyEmail'] }}</p></td>
													</tr>
													<tr>
														<td style="padding: 0px 0 !important;width: 80px; border: none;"><strong class="me-2">GST No. :</strong></td>
														<td style="padding: 0px 0 !important;border: none;"><p class="invoice-gst">{{ $previewData['companyGst'] }}</p></td>
													</tr>
													<tr>
														<td style="padding: 0px 0 !important;width: 80px; border: none;"><strong class="me-2">PAN No. :</strong></td>
														<td style="padding: 0px 0 !important;border: none;"><p class="invoice-pan"> {{ $previewData['companyPan'] }}</p></td>
													</tr>
													<tr>
														<td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid;"><strong class="me-2">Address :</strong></td>
														<td style="padding: 0px 0 !important;border: none;"><p class="invoice-details invoice-details-two ">{{ $previewData['companyAddress'] }}</p></td>
													</tr>
												</table>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text-one">Invoice To</strong>
                                                <table>
												    <tr>
													    <td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid;">
													    <strong class="invoice-name m-0">Name :</strong>
													    </td>
													    <td style="padding: 0px 0; border: none;"><p class="invoice-name">{{ $previewData['customerCompany'] }}</p></td>
												    </tr>
												    <!-- <tr>
													    <td style="padding: 0px 0 !important;width: 65px; border: none;">
													    <strong class="me-2">Phone.No:</strong>
													    </td>
													    <td style="padding: 0px 0; border: none;"> <p class="invoice-number"><span class="customer_c_pho"></span></p></td>
												    </tr> -->
												    <tr>
													    <td style="padding: 0px 0 !important;width: 80px; border: none;">
                                                        <strong class="me-2">GST No. :</strong>
													    </td>
													    <td style="padding: 0px 0; border: none;"><p class="invoice-gst">{{ $previewData['customerGst'] }}</p></td>
												    </tr>
												    <tr>
													    <td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid;">
													    <strong class="me-2">Address :</strong>
													    </td>
													    <td style="padding: 0px 0; border: none; "> <p class="invoice-details  invoice-details-two">
                                                     {{ $previewData['customerAddress'] }}
                                                </p>
													    </td>
												    </tr>
											    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="invoice-table table-style9">
                                        <thead>
                                            <tr>
                                                <th style=" font-weight: 700; background-color: #2250b0; color: #fff">Sr. No.</th>
                                                <th style=" font-weight: 700; background-color: #2250b0; color: #fff">Description</th>
                                                <th style=" font-weight: 700; background-color: #2250b0; color: #fff">Rate</th>
                                                <th style=" font-weight: 700; background-color: #2250b0; color: #fff">Qty</th>
                                                <th style=" font-weight: 700; background-color: #2250b0; color: #fff">Amount ({{ $previewData['Currency'] }})</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($previewData['invoiceItems'] as $item)
                                            <tr>
                                                <td>{{ $item['sr_no'] }}</td>
                                                <td>{{ $item['description'] }}</td>
                                                <td>{{ $item['rate'] }}</td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td class="emty">{{ $item['amount'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <table class="total-table  table-style9">
                                            <tr>
                                                <th>Sub Total :</th>
                                                <td>{{ $previewData['allTotal'] }}</td>
                                            </tr>
                                            @if( $previewData['GST'] > 0)
                                                @if( $previewData['optionTax'] == 'gst')
                                                    <tr>
                                                        <td><b>CGST :</b> {{ $previewData['CGST'] }}%</td>
                                                        <td>{{ $previewData['cgstAmount'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>SGST :</b> {{ $previewData['CGST'] }}%</td>
                                                        <td>{{ $previewData['cgstAmount'] }}</td>
                                                    </tr>
                                                @elseif ($previewData['optionTax'] == 'igst')
                                                    <tr>
                                                        <td><b>IGST :</b> {{ $previewData['GST'] }}%</td>
                                                        <td>{{ $previewData['gstAmount'] }}</td>
                                                    </tr>
                                                @elseif ($previewData['optionTax'] == 'vat')
                                                    <tr>
                                                        <td><b>VAT :</b> {{ $previewData['GST'] }}%</td>
                                                        <td>{{ $previewData['gstAmount'] }}</td>
                                                    </tr>
                                                @endif 
                                           @endif
                                            
                                            <tr>
                                                <th>Total :</th>
                                                <td>{{ $previewData['grandtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Amout In Words :</b></td>
                                                <td><b>{{ $previewData['Currency'] }} {{ ucfirst($previewData['AmountInWords']) }}</b></td>
                                            </tr>
                                            
                                        </table>
                                    </table>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="invoice-left">
                                                <strong class="customer-text-one">Payment Details</strong>
                                                <table>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
													    <strong>Bank A/c Holder Name :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; "> {{ $previewData['companyAcHoName'] }}</td>
												    </tr>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
                                                        <strong>Bank Name :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; "> {{ $previewData['companyBankN'] }}</td>
												    </tr>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
													    <strong>Account Number :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankAcN'] }}</td>
												    </tr>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
													    <strong>IFSC Code :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyIFSC'] }}</td>
												    </tr>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
													    <strong>SWIFT Code :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companySwift'] }}</td>
												    </tr>
												    <tr>
													    <td style="padding: 0 0 0 5px; border: none; ">
													    <strong>Branch :</strong>
													    </td>
													    <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankBN'] }}</td>
												    </tr>
											    </table>
                                            </div>
                                        </div>
                                    <div class="col-6">
                                        <div class="invoice-sign text-end">
                                            @if($previewData['Signature'])
                                                <img style="width: 150px;" src="{{ asset('uploads/logos/' . $previewData['Signature']) }}"  alt="sign" />
                                            @else
                                                <p>No signature provided.</p>
                                            @endif
                                            <span class="d-block">{{ $previewData['SignName'] }}</span>
                                        </div>
                                       
                                    </div>
                                    <hr class="style3">
                                    </div>
                                    <div class="row">
                                                                <div class="col-auto">
                                                                    <div class="invoice-left">
                                                                        <h6 style="font-size: 16px;">Terms and Conditions:</h6>
                                                                        <ol>
                                                                            <li class="mt-2"><strong>Payment Terms:</strong> Payment is due within 30 days
                                                                                from the invoice date. 
                                                                            </li>
                                                                            <li class="mt-2"><strong>Accepted Payment Methods:</strong>
                                                                            <ul style="padding-left: 20px;">
                                                                                <li><strong>Option1:</strong>Online Transfer</li>
                                                                                <li><strong>Option2:</strong>Cheque on the name of The Quantum Tech., Jurisdiction Subject To Ahmedabad, Gujarat, India.</li> 
                                                                            </ul>
                                                                            </li>
                                                                        </ol>
                                                                    </div>
                                                                </div>
                                                            </div>
                                    <p class="invoice-note mt-3"><svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z"
                                                fill="#2D7CFE" />
                                        </svg> <b>NOTE: </b>{{ $previewData['Note'] }}</p>
                                </div>
                                <div class="invoice-buttons">
                                    <button class="print_btn"><i class="bi bi-printer"></i> Print</button>
                                    <!-- <button id="download_btn" class="download_btn"><i class="bi bi-cloud-arrow-down"></i> Download</button> -->
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
@endsection