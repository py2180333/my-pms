{{-- integrate by pranav --}}
@extends('Admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/uniotech-template.css')}}">
@endsection
@section('content')
    <div class="invoice-container-wrap">
        <div class="invoice-container" id="print" style="margin: 60px auto !important;">
            <main>
                <div class="themeholy-invoice invoice_style1">
                    <div class="download-inner" id="download_section">
                        <header class="themeholy-header header-layout1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <h1 class="big-title rs-invoice" style="padding-top:20px">Invoice</h1>
                                </div>
                                <div class="col-auto " style="padding: 0 0 25px 0px;">
                                    <div class="header-logo">
                                        @if($previewData['companyLogo'])
                                            <img style="width: 55px;" src="{{ asset('uploads/logos/' . $previewData['companyLogo']) }}"  alt="companyLogo" />
                                        @else
                                            <img style="width: 55px;" src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- rs change in html and inline css 08/07/2025-->
                            <div class="header-bottom">
                                <div class="row ">
                                    
                                    <div class="col-4">
                                        <strong class="customer-text-one" style="margin: 0; font-size: 15px;">Invoice No. </strong>
                                        <p class="customer-text-one" style="margin: 0; font-size: 15px;">{{ $previewData['invoiceID']}}</p>
                                    </div>
                                    <div class="col-4">
                                        <strong class="customer-text-one" style="margin: 0; font-size: 15px;">Date</strong>
                                        <p class="customer-text-one" style="margin: 0; font-size: 15px;">{{ $previewData['invoiceDate'] }}</p>
                                    </div>
                                     <div class="col-4">
                                        <strong class="customer-text-one" style="margin: 0; font-size: 15px;">PO No.</strong>
                                        <p class="customer-text-one" style="margin: 0; font-size: 15px;">{{ $previewData['invoicePoN'] }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </header>
                        <div class="row justify-content-between mb-4">
                            <div class="col-6">
                                <div class="un-add"> <p class="tm_mb2"><strong class="customer-text-one">Invoice to</strong></p>
                                    <table style="border:none;">
                                        <tr>
                                            <td style="padding: 0px 0 !important; border: none; display: inline-grid;"><strong class="invoice-name m-0" style="font-size: 15px;">Name:</strong></td>
                                            <td style="padding: 0px 0 !important; border: none; width: 100%;"> <p class="invoice-name m-0" style="font-size: 15px;">{{ $previewData['customerCompany'] }}</p> </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px 0 !important; border: none; width: 21%"><strong>Phone No. :</strong></td>
                                            <td style="padding: 0px 0 !important; border: none;">9087484288</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px 0 !important; border: none;"><strong >GST No. :</strong></td>
                                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-gst m-0">{{ $previewData['customerGst'] }}</p> </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px 0 !important; border: none; display: inline-grid;"><strong >Address :</strong></td>
                                            <td style="padding: 0px 0 !important; border: none;">{{ $previewData['customerAddress'] }}</td>
                                        </tr>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                        <div class="invoice-info">
                                            <strong class="customer-text-one">Invoice From</strong>
                                            <h6 class="invoice-name">{{ $previewData['invoiceDate'] }}</h6>
                                            <table style="border:none;">
                                                <tr>
                                                    <td style="padding: 0px 0 !important; width:25%; border: none; display: inline-grid;"><strong class="invoice-name m-0" style="font-size: 15px;">Name:</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none;"><h6 class="invoice-name" style="font-size: 15px;">{{ $previewData['companyName'] }}</h6></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 !important; border: none; width: 21%"><strong >Phone No. :</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none; "><p class>{{ $previewData['companyNumber'] }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 !important; border: none; "><strong >Email :</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none; ">{{ $previewData['companyEmail'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 !important; border: none; "><strong >GST No. :</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none; "> <p class="invoice-gst">{{ $previewData['companyGst'] }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 !important; border: none; "><strong >PAN No. :</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none; "> <p class="invoice-pan">{{ $previewData['companyPan'] }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 !important; border: none; display: inline-grid;"><strong >Address :</strong></td>
                                                    <td style="padding: 0px 0 !important; border: none; "> <p class="invoice-address">{{ $previewData['companyAddress'] }}</p></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                         <!-- rs change in html and inline css end 08/07/2025 -->
                        <table class="rs-ut invoice-table">
                            <thead>
                                <tr>
                                    <th style=" font-weight: 700; color: #fff; background-color:#85b842;">SR.NO.</th>
                                    <th style=" font-weight: 700; color: #fff; background-color:#85b842;">Description</th>
                                    <th style=" font-weight: 700; color: #fff; background-color:#85b842;">Rate</th>
                                    <th style=" font-weight: 700; color: #fff; background-color:#85b842;">Qty</th>
                                    <th style=" font-weight: 700; color: #fff; background-color:#85b842;">Amount ({{ $previewData['Currency'] }})</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($previewData['invoiceItems'] as $item)
                                <tr>
                                    <td>{{ $item['sr_no'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>{{ $item['rate'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['amount'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <table class="total-table">
                                <tr style="border: 1px solid #007aff33;">
                                    <th>Sub Total:</th>
                                    <td>{{ $previewData['allTotal'] }}</td>
                                </tr>
                                @if( $previewData['GST'] > 0)
                                    @if( $previewData['optionTax'] == 'gst')
                                        <tr style="border: 1px solid #007aff33;">
                                            <td><b>CGST:</b> {{ $previewData['CGST'] }}%</td>
                                            <td>{{ $previewData['cgstAmount'] }}</td>
                                        </tr>
                                        <tr style="border: 1px solid #007aff33;">
                                            <td><b>SGST:</b> {{ $previewData['CGST'] }}%</td>
                                            <td>{{ $previewData['cgstAmount'] }}</td>
                                        </tr>
                                    @elseif ($previewData['optionTax'] == 'igst')
                                        <tr style="border: 1px solid #007aff33;">
                                            <td><b>IGST:</b> {{ $previewData['GST'] }}%</td>
                                            <td>{{ $previewData['gstAmount'] }}</td>
                                        </tr>
                                    @elseif ($previewData['optionTax'] == 'vat')
                                        <tr style="border: 1px solid #007aff33;">
                                            <td><b>VAT:</b> {{ $previewData['GST'] }}%</td>
                                            <td>{{ $previewData['gstAmount'] }}</td>
                                        </tr>
                                    @endif 
                                @endif

                                <tr style="border: 1px solid #007aff33">
                                    <th>Total:</th>
                                    <td>{{ $previewData['grandtotal'] }}</td>
                                </tr>
                                <tr style="border: 1px solid #007aff33;">
                                    <td><b>Amout In Words:</b></td>
                                    <td><b>{{ $previewData['Currency'] }} {{ ucfirst($previewData['AmountInWords']) }}</b></td>
                                </tr>
                                
                            </table>
                        </table>
                        <hr>
                        <div class="row justify-content-between">
                          
                            <div class="col-8">
                                <div class="invoice-left">
                                    <strong class="customer-text-one">Payment Details</strong>
                                    <table style="border:none;" cellspacing="0" class="mb-1">
                                        <tbody>
                                            <tr>
                                            <td style="padding: 0 0 0 5px; border: none; width: 31%;">
                                                <strong>Bank A/c Holder Name:</strong>
                                            </td>
											<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyAcHoName'] }}</td>
											</tr>
											<tr>
												<td style="padding: 0 0 0 5px; border: none; "><strong>Bank Name:</strong></td>
												<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankN'] }}</td>
											</tr>
											<tr>
												<td style="padding: 0 0 0 5px; border: none; "><strong>Account Number:</strong></td>
												<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankAcN'] }}</td>
											</tr>
											<tr>
												<td style="padding: 0 0 0 5px; border: none; "><strong>IFSC Code:</strong></td>
												<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyIFSC'] }}</td>
											</tr>
											<tr>
												<td style="padding: 0 0 0 5px; border: none; "><strong>Swift Code:</strong></td>
												<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companySwift'] }}</td>
											</tr>
											<tr>
												<td style="padding: 0 0 0 5px; border: none; "><strong>Branch:</strong></td>
												<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankBN'] }}</td>
											</tr>
									    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="invoice-sign text-center">
                                    @if($previewData['Signature'])
                                        <img class="img-fluid d-inline-block" src="{{ asset('uploads/logos/' . $previewData['Signature']) }}" style="width: 160px;"  alt="sign" />
                                    @else
                                        <p>No signature provided.</p>
                                    @endif
                                    <span class="d-block m-0">{{ $previewData['SignName'] }}</span>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="invoice-left">
                                        <h6 style="font-size: 20px" class="mb-1">Terms and Conditions:</h6>
                                        <ol>
                                            <li class=""><strong>Payment Terms:</strong>  Payment is due within 30 days
                                            from the invoice date.
                                            </li>
                                            <li class="mt-2"><strong class="tm_bold tm_primary_color tm_m0">Accepted Payment Methods:</strong>
                                                <ul style="list-style: none;">
                                                    <li><strong class="tm_bold tm_primary_color tm_m0">Option1:</strong>Online Transfer</li>
                                                    <li><strong class="tm_bold tm_primary_color tm_m0">Option2:</strong>Cheque on the name of Uniotech, Jurisdiction Subject To Ahmedabad, Gujarat, India.</li>
                                                </ul>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                <table class="total-table">
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td>$2000.00</td>
                                    </tr>
                                    <tr>
                                        <th>Tax:</th>
                                        <td>$250.00</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$2250.00</td>
                                    </tr>
                                </table>
                            </div> -->
                        </div>
                        <p class="invoice-note mt-3"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z" fill="#2D7CFE"/></svg>      <b>NOTE: </b>{{ $previewData['Note'] }}</p>
                        <div class="body-shape1"><img src="{{ asset('/assets/img/uniotech/Vector 3.png') }}" alt="line"></div>
                        <div class="body-shapenew1"><img src="{{ asset('/assets/img/uniotech/ut2.png') }}" alt="line"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @endsection