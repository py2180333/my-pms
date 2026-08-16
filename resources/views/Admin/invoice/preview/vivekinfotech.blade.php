
@extends('Admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/assets/css/preview2.css')}}">
@endsection
@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper download_section" id="print">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="tm_container">
                    <div class="tm_invoice_wrap">
                        <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
                            <div class="tm_invoice_in">
                                <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
                                    <div class="tm_invoice_left">
                                        <div class="tm_logo">
                                            @if($previewData['companyLogo'])
                                            <img src="{{ asset('uploads/logos/' . $previewData['companyLogo']) }}"  alt="companyLogo" />
                                            @else
                                                <img src="{{ asset('/assets/img/tqt/vivek-infotechs.jpg') }}" class="avatar" alt="Default Photo" />
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="tm_invoice_right tm_text_right tm_mobile_hide">
                                        <div class="tm_f50 tm_text_uppercase tm_white_color">Invoice</div>
                                    </div>
                                    <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
                                </div>
                                <div class="tm_invoice_info ">
                                    <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Invoice No. :
                                        </b>{{ $previewData['invoiceID']}}</div>
                                    <div class="tm_invoice_info_list tm_white_color">
                                        <p class="tm_invoice_number tm_m0">PO No. : <b>{{ $previewData['invoicePoN'] }}</b></p>
                                        <p class="tm_invoice_date tm_m0">Date : <b>{{ $previewData['invoiceDate'] }}</b></p>
                                    </div>
                                    <div class="tm_invoice_seperator tm_accent_bg"></div>
                                </div>
                                <div class="tm_invoice_head tm_mb10">
                                    <div class="tm_invoice_left vivek-pvt-rs col-6 ">
                                        <p class="tm_mb2"><b class="tm_primary_color">Invoice From</b></p>
                                        <!-- rs add table and inline css  -->
                                         <table>
                                            <tr>
                                                <td style="padding: 0px 0 !important;  border: none; display: inline-grid;"><strong class="invoice-name m-0">Name :</strong></td>
                                                <td style="padding: 0px 0 !important;  border: none;"><h6 class="invoice-name company_name m-0">{{ $previewData['companyName'] }}</h6></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important; width: 20%; border: none;"><strong class="me-2">Phone No. :</strong></td>
                                                <td style="padding: 0px 0 !important;  border: none;"><p class="invoice-number m-0"><span class="company_phone_number">{{ $previewData['companyNumber'] }}</span></p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important;  border: none;"><strong class="me-2">E-mail :</strong></td>
                                                <td style="padding: 0px 0 !important;  border: none;"><p class="invoice-email m-0"><span class="company_email">{{ $previewData['companyEmail'] }}</span></p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important;  border: none;"><strong class="me-2">GST No. :</strong></td>
                                                <td style="padding: 0px 0 !important;  border: none;"><p class="invoice-gst m-0"><span class="company_tax">{{ $previewData['companyGst'] }}</span></p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important;  border: none;"><strong class="me-2">PAN No. :</strong></td>
                                                <td style="padding: 0px 0 !important;  border: none;"><p class="invoice-pan m-0"><span class="company_pan">{{ $previewData['companyPan'] }}</span></p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important; width: 100%; border: none; display: inline-grid;"><strong class="me-2">Address :</strong></td>
                                                <td style="padding: 0px 0 !important; width: 100%; border: none;"><p class="invoice-address m-0"><span class="company_address">{{ $previewData['companyAddress'] }}</span></p></td>
                                            </tr>
                                        </table>
                                         <!-- rs add table and inline css end  -->
                                        <!-- <h6 class="invoice-name">{{ $previewData['companyName'] }}</h6>
                                        <p class="invoice-number"><strong class="me-2">Phone.No:</strong>{{ $previewData['companyNumber'] }}</p>
                                        <p class="invoice-email"><strong class="me-2">email:</strong>{{ $previewData['companyEmail'] }}</p>
                                        <p class="invoice-gst"><strong class="me-2">GST.No:</strong>{{ $previewData['companyGst'] }}</p>
                                        <p class="invoice-pan"><strong class="me-2">PAN.No:</strong>{{ $previewData['companyPan'] }}</p>
                                        <p class="invoice-details invoice-details-two mt-1 "><strong class="me-2">Address:</strong>
                                            {{ $previewData['companyAddress'] }}
                                        </p> -->
                                    </div>
                                    <div class="tm_invoice_right vivek-pvt-rs-2 col-6">
                                        <p class="tm_mb2"><b class="tm_primary_color">Invoice To</b></p>
                                    <!-- rs- add table and inline css -->
                                         <table>
                                            <tr>
                                                <td style="padding: 0px 0 !important; width: 20%; border: none;"><strong class="me-2">Name :</strong></td>
                                                <td style="padding: 0px 0 !important; width: 65px; border: none;"><p class="invoice-name m-0"><span class="customer_name">{{ $previewData['customerCompany'] }}</span></p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important;  border: none;"><strong class="me-2">GST No. :</strong></td>
                                                <td style="padding: 0px 0 !important; border: none;"><p class="invoice-gst m-0">{{ $previewData['customerGst'] }}</p></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 0 !important; border: none; display: inline-grid;"><strong class="me-2">Address :</strong></td>
                                                <td style="padding: 0px 0 !important; border: none;"><p class="invoice-details  invoice-details-two m-0 " style="width:200px;">{{ $previewData['customerAddress'] }}</span></p></td>
                                            </tr>
                                        </table>
                                     <!-- rs add table and inline css end -->
                                        <!-- <p class="invoice-name"><strong class="me-2">Name:</strong>{{ $previewData['customerCompany'] }}</p>
                                        {{-- <p class="invoice-number"><strong class="me-2">Phone.No:</strong>9087484288</p> --}} -->
                                        <!-- <p class="invoice-gst"><strong class="me-2">GST.No:</strong>{{ $previewData['customerGst'] }}</p> -->
                                        <!-- <p class="invoice-details  invoice-details-two mt-1 " style="width:200px;">
                                            <strong class="me-2">Address:</strong>{{ $previewData['customerAddress'] }} -->
                                    </div>
                                </div>
                                <div class="tm_table tm_style1">
                                    <div class="">
                                        <div class="tm_table_responsive">
                                            <table>
                                                <thead>
                                                    <tr class="tm_accent_bg">
                                                        <th class="tm_width_3 tm_semi_bold tm_white_color">Item</th>
                                                        <th class="tm_width_4 tm_semi_bold tm_white_color">Description</th>
                                                        <th class="tm_width_2 tm_semi_bold tm_white_color">Rate</th>
                                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                                                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total ({{ $previewData['Currency'] }})</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($previewData['invoiceItems'] as $item)
                                                    <tr>
                                                        <td class="tm_width_3">{{ $item['sr_no'] }}</td>
                                                        <td class="tm_width_4">{{ $item['description'] }}</td>
                                                        <td class="tm_width_2">{{ $item['rate'] }}</td>
                                                        <td class="tm_width_1">{{ $item['quantity'] }}</td>
                                                        <td class="tm_width_2 tm_text_right">{{ $item['amount'] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
                                        
                                        <div class="tm_right_footer " style="width: 100%;">
                                            <table class="tm_mb15">
                                                <tbody>
                                                    <tr class="tm_gray_bg ">
                                                        <td class="tm_width_3 tm_primary_color tm_bold">Subtotal :</td>
                                                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">{{ $previewData['allTotal'] }}</td>
                                                    </tr>
                                                    <tr class="tm_gray_bg">
                                                        @if( $previewData['GST'] > 0)
                                                        @if( $previewData['optionTax'] == 'gst')
                                                        <td class="tm_width_3 tm_primary_color"> CGST <span
                                                                class="tm_ternary_color text-dark">: {{ $previewData['CGST'] }}%</span></td>
                                                        <td class="tm_width_3 tm_primary_color tm_text_right">{{ $previewData['cgstAmount'] }}</td>
                                                        <tr class="tm_gray_bg"><td class="tm_width_3 tm_primary_color">SGST <span
                                                                class="tm_ternary_color text-dark">: {{ $previewData['CGST'] }}%</span></td>
                                                        <td class="tm_width_3 tm_primary_color tm_text_right">{{ $previewData['cgstAmount'] }}</td></tr>
                                                        @elseif( $previewData['optionTax'] == 'igst') <td class="tm_width_3 tm_primary_color"> IGST <span
                                                                class="tm_ternary_color text-dark">: {{ $previewData['GST'] }}%</span></td>
                                                        <td class="tm_width_3 tm_primary_color tm_text_right">{{ $previewData['gstAmount'] }}</td>
                                                        @elseif( $previewData['optionTax'] == 'vat') <td class="tm_width_3 tm_primary_color"> VAT <span
                                                                class="tm_ternary_color text-dark">: {{ $previewData['GST'] }}%</span></td>
                                                        <td class="tm_width_3 tm_primary_color tm_text_right">{{ $previewData['gstAmount'] }}</td>
                                                        @endif
                                                        @endif
                                                    </tr>
                                                    <tr class="tm_accent_bg">
                                                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand
                                                            Total :</td>
                                                        <td
                                                            class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">
                                                            {{ $previewData['grandtotal'] }}</td>
                                                    </tr>
                                                    <tr class="tm_gray_bg">
                                                        <td style="width: 40%;"><b>Amout In Words :</b></td>
                                                        <td style="width: 60%; text-align: end;"><b>{{ $previewData['Currency'] }} {{ ucfirst($previewData['AmountInWords']) }}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                        <div class="container p-0">
                                          <div class="row">
                                            <div class="col-8"><div class="tm_left_footer">
                                            <strong class="customer-text-one">Payment Details</strong>
                                         
                                            <table style="border:none;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; width: 38%;">
                                                            <strong>Bank A/c Holder Name :</strong>
                                                        </td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyAcHoName'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; "><strong>Bank Name :</strong></td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankN'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; "><strong>Account Number :</strong></td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankAcN'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; "><strong>IFSC Code :</strong></td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyIFSC'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; "><strong>Swift Code :</strong></td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companySwift'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0 0 0 5px; border: none; "><strong>Branch :</strong></td>
                                                        <td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankBN'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                           
                                        </div></div>
                                            <div class="col-4">
                                                <div class="tm_right_footer">
                                            <div class="tm_sign tm_text_center">
                                                @if($previewData['Signature'])
                                                    <img class="tm_mb15" src="{{ asset('uploads/logos/' . $previewData['Signature']) }}" style="max-height: 80px; width: auto;" alt="sign" />
                                                @else
                                                    <p>No signature provided.</p>
                                                @endif
                                                <p class="tm_m0 tm_primary_colo">{{ $previewData['SignName'] }}</p>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        
                                   
                                </div>
                                {{-- <div class="tm_note tm_font_style_normal">
                                    <hr class="tm_mb15">
                                    <h6>Terms and Conditions:</h6>
                                    <ol>
                                        <li class="mt-2"><strong>Payment Terms:</strong> Payment is due within 30 days
                                            from the invoice date.
                                        </li>
                                        <li class="mt-2"><strong>Accepted Payment Methods:
                                            <ul>
                                                <li><strong>Option1:</strong>Online Transfer</li>
                                                <li><strong>Option2:</strong>Cheque on the name of VivekInfotechs., Jurisdiction Subject To Ahmedabad, Gujarat, India.</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div> --}}
                                <div class="tm_note tm_font_style_normal">
                                    <h6 style="margin: 0;">Terms and Conditions:</h6>
                                    <ol style="margin: 10px 0;">
                                        <li class="mt-2"><strong>Payment Terms:</strong> Payment is due within 30 days from the invoice date. Late payments will incur a 2% late fee after 30 days.
                                        </li>
                                        <li class="mt-2"><strong>Accepted Payment Methods:</strong>
                                            <ul>
                                                <li><strong>Option1:</strong>Online Transfer</li>
                                                <li><strong>Option2:</strong>Cheque on the Name of Vivek Infotechs Private Limited., Jurisdiction Subject To Ahmedabad, Gujarat, India.</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>
                                <p class="invoice-note  text-center mt-3"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z" fill="#2D7CFE"></path>
                                </svg> <b>NOTE: </b>{{ $previewData['Note'] }}</p>
                                <!-- .tm_note -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
@endsection
