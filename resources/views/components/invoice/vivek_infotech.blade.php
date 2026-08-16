<div class="tm_invoice_wrap tems-2" id="tem-2">
    <div class="tm_invoice tm_style1 tm_type1" id="tems-2">
        <div class="tm_invoice_in">
            <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
                <div class="tm_invoice_left">
                    <div class="tm_logo"><img class="signature" alt="Logo"></div>
                </div>
                <div class="tm_invoice_right tm_text_right tm_mobile_hide">
                    <div class="tm_f50 tm_text_uppercase tm_white_color">Invoice</div>
                </div>
                <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
            </div>
            <div class="tm_invoice_info ">
                <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Invoice Number:
                    </b><span class="invoice_number"></span></div>
                <div class="tm_invoice_info_list tm_white_color">
                    <p class="tm_invoice_number tm_m0">PO NO. : <b><span class="invoice_p_no"></sapm></b></p>
                    <p class="tm_invoice_date tm_m0">Date : <b><span class="invoice_date"></span></b></p>
                </div>
                <div class="tm_invoice_seperator tm_accent_bg"></div>
            </div>
            <div class="tm_invoice_head tm_mb10" style="height:auto;">
                <div class="tm_invoice_left vivek-pvt-rs col-6">
                    <p class="tm_mb2"><b class="tm_primary_color">Invoice Form:</b></p>
                    <!-- rs add table and inline css -->
                        <table>
                        <tr>
                            <td style="padding: 0px 0 !important;width: 65px; border: none; display: inline-grid;">
                            <strong class="invoice-name m-0">Name :</strong>
                            </td>
                            <td style="padding: 0px 0 !important; border: none; width: 100%;"><h6 class="invoice-name company_name m-0">Vivek Infotechs FZCO</h6></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 !important; border: none; width:23%"><strong class="me-2">Phone No. :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-number"><span class="company_phone_number">Phone number loading...</span></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 !important; border: none;"><strong class="me-2">Email :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-email m-0"><span class="company_email">Email Loading...</span></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 !important; border: none;"><strong class="me-2">GST No. :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-gst m-0"><span class="company_tax">TAX Loading...</span></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 !important; border: none; display: inline-grid;"><strong class="me-2">Address :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-address"><span class="company_address">Address Loading...</span></p></td>
                        </tr>
                    </table>
                        <!-- rs add table and inline css end -->
                </div>
                <div class="vivek-pvt-rs-2 col-6">
                    <p class="tm_mb2"><b class="tm_primary_color">Invoice To</b></p>
                    <!-- rs add table and inline css  -->
                        <table>
                        <tr>
                            <td style="padding: 0px 0 !important;width: 65px; border: none; display: inline-grid;"><strong class="me-2">Name :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-name m-0"><span class="customer_company_name"></span></p></td>
                        </tr>
                        
                        <tr>
                            <td style="padding: 0px 0 !important; border: none; width: 23%;"><strong class="me-2">GST No. :</strong></td>
                            <td style="padding: 0px 0 !important; border: none;"><p class="invoice-gst m-0"><span class="customer_c_tax">TAX Loading...</span></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 !important; border: none; display: inline-grid;">
                                <strong class="me-2">Address :</strong>
                            </td>
                            <td style="padding: 0px 0 !important; border: none;">
                                <p class="invoice-address m-0"><span class="customer_c_add"></span></p>
                            </td>
                        </tr>
                    </table>
                        <!-- ṛs add tasble and inline css end -->
                    
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
                                    <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right digvijay currency">Total</th>
                                </tr>
                            </thead>
                            <tbody class="invoiceiteam">
                                {{-- get dynamic invoice iteams --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class=" tm_invoice_footer tm_border_top tm_mb20 tm_m0_md">
                    <!-- <div class="tm_left_footer" style="width: 40%;"></div> -->
                    <div class="tm_right_footer " style="width: 100%;">
                        <table class="">
                            <tbody>
                                <tr class="tm_gray_bg ">
                                    <td class="tm_width_3 tm_primary_color tm_bold">Sub-Total</td>
                                    <td class="tm_width_3 tm_primary_color tm_bold tm_text_right alltotal">Subtotal Loading...</td>
                                </tr>
                                <tbody class="gst-work">
                                    {{-- using ajax for tr tag --}}
                                </tbody>
                                <tr class="tm_accent_bg">
                                    <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand
                                        Total </td>
                                    <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right grandtotal">
                                        total Loding...</td>
                                </tr>
                                <tr class="tm_gray_bg">
                                    <td style="width: 40%;"><b>Amout In Words:</b></td>
                                    <td style="width: 60%; text-align: end;"><b class="numberToWords">Loading...</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tm_invoice_footer tm_type1" style="align-items: center;">
                    <div class="tm_left_footer" style="width: 50%;padding: 10px 0;">
                        <strong class="customer-text-one">Payment Details</strong>
                        <!-- rs add table and inline css -->
                            <table>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none; width: 40%;"><strong>Bank A/c Holder Name:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="account_holder_name"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none;"><strong>Bank Name:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="bank_name"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none;"><strong>Account Number:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="bank_account_no"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none;"><strong>IFSC Code:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="ifsc_code"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none;"><strong>Swift Code:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="swift_code"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 !important; border: none;"><strong>Branch:</strong></td>
                                <td style="padding: 0px 0 !important; border: none;"><span class="branch_name"></span></td>
                            </tr>
                        </table>
                        
                            <!-- rs add table and inline css end -->
                    </div>
                    <div class="tm_right_footer" style="width: 50%;">
                        <div class="tm_sign tm_text_right">
                            <img style="max-height: 80px; width: auto;" class="sign"  alt="Sign">
                            <!-- <p class="tm_m0 tm_primary_colo">Nidhi Laheri</p> -->
                            <p class="tm_m0 tm_f16 tm_primary_color signname"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tm_note tm_font_style_normal mt-0">
                
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
            <p class="invoice-note  text-center mt-0"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z" fill="#2D7CFE"></path>
            </svg> <b>NOTE: </b><span class="note"></span></p>
            <!-- .tm_note -->
        </div>
    </div>
</div>