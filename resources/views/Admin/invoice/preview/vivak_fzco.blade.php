{{-- integrate by pranav --}}
@extends('Admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/assets/css/vivak_fzco.css')}}">
@endsection
@section('content')
<div class="tm_container">
    <div class="tm_invoice_wrap">
        <div class="tm_invoice tm_style1 tm_radius_0" id="tm_download_section">
            <div class="tm_invoice_in">
                <div
                    class="rs-reletive tm_flex tm_flex_column_sm tm_justify_between tm_align_center tm_align_start_sm tm_f14 tm_white_color tm_accent_bg tm_medium tm_padd_8_20 tm_mb20">
                    <p class="tm_m0"></p>
                    @if($previewData['companyLogo'])
                        <img class="rs-logo" src="{{ asset('uploads/logos/' . $previewData['companyLogo']) }}"  alt="companyLogo" />
                    @else
                        <img class="rs-logo" src="{{ asset('/assets/img/tqt/vivek-infotechs.jpg') }}" class="avatar" alt="Default Photo" />
                    @endif
                    <div>
                    </div>
                    <p class="tm_m0 tm_f18 tm_bold">Invoice</p>
                </div>
                <div
                class=" tm_flex tm_flex_column_sm tm_justify_between tm_align_center tm_align_start_sm tm_f14 tm_mb10">
                <div>
                <p class="tm_m0 tm_f18 tm_bold">Date</p>
                <p class="tm_m0 tm_bold">{{ $previewData['invoiceDate'] }}</p>
                </div>
                <div>
					<p class="tm_m0 tm_f15 tm_bold">PO No.</p>
					<p class="tm_m0 ">{{ $previewData['invoicePoN'] }}</p>
				</div>
                <div>
                    <p class="tm_m0 tm_f18 tm_bold">Invoice No</p>
                    <p class="tm_m0 tm_bold">{{ $previewData['invoiceID']}}</p>
                </div>
            </div>
                <div
                    class="tm_grid_row tm_col_3 tm_padd_10 tm_border tm_accent_border_20 tm_accent_bg_10 tm_mb10 tm_align_center">
                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                        <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Bill From</p>
                        <p style="margin: 0;">Name: {{ $previewData['companyName'] }}</p>
                        <p style="margin: 0;">Email: {{ $previewData['companyEmail'] }}</p>
                    </div>
                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                        <p style="margin: 0;">{{ $previewData['companyAddress'] }}</p>
                    </div>
                     <div>
                        <p style="margin: 0;">VAT No.:{{ $previewData['companyGst'] }}</p>
                       {{-- <p style="margin: 0;"> PAN.No: {{ $previewData['companyPan'] }}</p>--}}
                    </div> 
                </div>
                <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb10">
                    <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Bill To</p>
                    <div class="tm_grid_row tm_col_3">
                        <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                           <p style="margin: 0;">Name: {{ $previewData['customerCompany'] }}</p>
                        </div>
                        <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                            <p style="margin: 0;">{{ $previewData['customerAddress'] }}</p>
                            <!-- <p style="margin: 0;">9087484288</p> -->
                        </div>
                        <div>
                            <p style="margin: 0;">VAT No.:{{ $previewData['customerGst'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="tm_table tm_style1 tm_mb20">
                    <div class="tm_round_border tm_accent_border_20 tm_radius_0">
                        <div class="tm_table_responsive">
                            <table>
                                <thead>
                                    <tr class="tm_accent_bg">
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">SR.No.</th>
                                        <th class="tm_width_6 tm_semi_bold tm_white_color">Description</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color">Rate</th>
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Amount ({{ $previewData['Currency'] }})</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($previewData['invoiceItems'] as $item)
                                    <tr>
                                        <td class="tm_width_1 tm_accent_border_20">{{ $item['sr_no'] }}</td>
                                        <td class="tm_width_6 tm_accent_border_20">
                                            <b class="tm_primary_color tm_medium">{{ $item['description'] }}
                                        </td>
                                        <td class="tm_width_2 tm_accent_border_20">{{ $item['rate'] }}</td>
                                        <td class="tm_width_1 tm_accent_border_20">{{ $item['quantity'] }}</td>
                                        <td class="tm_width_2 tm_accent_border_20 tm_text_right">{{ $item['amount'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tm_invoice_footer tm_mb10">
                        <div class="tm_right_footer">
                            <table>
                                <tbody>
                                    <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                        <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_border_none tm_bold">Subtoal</td>
                                        <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_border_none tm_bold">{{ $previewData['allTotal'] }}</td>
                                    </tr>
                                    @if( $previewData['GST'] > 0)
                                        @if( $previewData['optionTax'] == 'gst')
                                            <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_bold">CGST ({{ $previewData['CGST'] }}%)</td>
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_bold">{{ $previewData['cgstAmount'] }}</td>
                                            </tr>
                                            <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_bold">SGST ({{ $previewData['CGST'] }}%)</td>
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_bold">{{ $previewData['cgstAmount'] }}</td>
                                            </tr>
                                        @elseif( $previewData['optionTax'] == 'igst')
                                            <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_bold">IGST ({{ $previewData['GST'] }}%)</td>
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_bold">{{ $previewData['gstAmount'] }}</td>
                                            </tr>
                                        @elseif( $previewData['optionTax'] == 'vat')
                                            <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_bold">VAT ({{ $previewData['GST'] }}%)</td>
                                                <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_bold">{{ $previewData['gstAmount'] }}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr class="tm_border_bottom tm_border_left tm_border_right tm_accent_border_20 ">
                                        <td class="tm_width_3 tm_bold tm_f16 tm_primary_color tm_accent_border_20"> Grand Total </td>
                                        <td class="tm_width_3 rs-width_1 tm_bold tm_f16 tm_primary_color tm_accent_border_20 tm_text_right">{{ $previewData['grandtotal'] }}</td>
                                    </tr>
                                    <tr class="tm_border_bottom tm_border_left tm_border_right tm_accent_border_20 tm_accent_bg">
                                        <td class="tm_width_3 rs-width_2 tm_bold tm_f16 tm_white_color tm_accent_border_20">Amount in Words: </td>
                                        <td class="tm_width_9 tm_bold tm_f16 tm_white_color tm_accent_border_20 tm_text_right">{{ $previewData['Currency'] }} {{ ucfirst($previewData['AmountInWords']) }}</td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tm_col_2 ">
                        <div class=" tm_flex tm_flex_column_sm tm_justify_between ">
                            <div class="bank-detiels fzco-rs-bank-detiels">
                                <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Payment Details</p>
                                <table>
									<tr>
										<td style="padding: 0 0 0 5px; border: none;  width: 42%;"><strong>Bank A/c Holder Name:</strong></td>
										<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyAcHoName'] }}</td>
									</tr>
									<tr>
										<td style="padding: 0 0 0 5px; border: none; "><strong>Bank Name:</strong></td>
										<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankN'] }}</td>
									</tr>
									<tr>
										<td style="padding: 0 0 0 5px; border: none; "><strong>IBAN Code:</strong></td>
										<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyIBAN'] }}</td>
									</tr>
									<tr>
										<td style="padding: 0 0 0 5px; border: none; "><strong>BIC Code:</strong></td>
										<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyIFSC'] }}</td>
									</tr>
									<tr>
										<td style="padding: 0 0 0 5px; border: none; display: inline-grid;"><strong>Business Address:</strong></td>
										<td style="padding: 0 0 0 5px; border: none; ">{{ $previewData['companyBankBN'] }}</td>
									</tr>
								</table>
                              
                            </div>
                            <div class="fzco-rs-bank-detiels-logo">
                                @if($previewData['Signature'])
                                    <img class="" src="{{ asset('uploads/logos/' . $previewData['Signature']) }}" alt="sign">
                                @else
                                    <p>No signature provided.</p>
                                @endif
                                <p class="tm_flex tm_flex_column_sm tm_justify_center">{{ $previewData['SignName'] }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <p class="tm_bold tm_primary_color tm_m0">Terms and conditions</p>
                <ol>
                    <li class="mt-2 "><strong class="tm_bold tm_primary_color tm_m0">Payment Terms:</strong> Payment is due within 30 days from the invoice date.</li>
                    <li class="mt-2"><strong class="tm_bold tm_primary_color tm_m0">Accepted Payment Methods:</strong>
                        <ul style="list-style: none;">
                            <li><strong class="tm_bold tm_primary_color tm_m0">Option1:</strong>Online Transfer</li>
                            <li><strong class="tm_bold tm_primary_color tm_m0">Option2:</strong>Cheque on the name of Vivekinfotechs Fzco., UAE</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

