<div class="tm_container" id="tem-4">
    <div class="tm_invoice_wrap">
        <div class="tm_invoice tm_style1 tm_radius_0 tems-4" id="tm_download_section">
            <div class="tm_invoice_in">
                <div class="rs-reletive tm_flex tm_flex_column_sm tm_justify_between tm_align_center tm_align_start_sm tm_f14 tm_white_color tm_accent_bg tm_medium tm_padd_8_20 tm_mb20">
                    <p class="tm_m0"></p>
                    <img class="signature rs-logo" alt="Logo">
                    <div>
                    </div>
                    <p class="tm_m0 tm_f18 tm_bold">Invoice</p>
                </div>
                <div class=" tm_flex tm_flex_column_sm tm_justify_between tm_align_center tm_align_start_sm tm_f14 tm_mb10 p-2">
                    <div>
                        <p class="tm_m0 tm_f15 tm_bold">Date</p>
                        <p class="tm_m0 "><span class="invoice_date"></span></p>
                    </div>
                    <div>
                        <p class="tm_m0 tm_f15 tm_bold">PO No.</p>
                        <p class="tm_m0 "><span class="invoice_p_no"></span></p>
                    </div>
                    <div>
                        <p class="tm_m0 tm_f15 tm_bold">Invoice No.</p>
                        <p class="tm_m0 "><span class="invoice_number"></span></p>
                    </div>
                </div>
                <div class="tm_grid_row tm_col_3 tm_padd_10 tm_border tm_accent_border_20 tm_accent_bg_10 tm_mb10 tm_align_center">
                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                        <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Bill From</p>
                        <p style="margin: 0;">Name: <span class="company_name">company name loading...</span></p>
                        <p style="margin: 0;">Email: <span class="company_email">Email Loading...</span></p>
                    </div>
                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                        <p style="margin: 0;"><span class="company_address">Address Loading...</span></p>
                    </div>
                    <div>
                        <p style="margin: 0;">VAT No.:<span class="company_tax">TAX Loading...</span></p>
                        {{-- <p style="margin: 0;"> PAN.No:<span class="company_pan">PAN Loading...</span></p> --}}
                    </div>
                </div>
                <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb10">
                    <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Bill To</p>
                    <div class="tm_grid_row tm_col_3">
                        <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                            <p style="margin: 0;">Name: <span class="customer_company_name"></span></p>
                        </div>
                        <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                            <p style="margin: 0;"><span class="customer_c_add"></span></p>
                            <!-- <p style="margin: 0;"><span class="customer_c_pho"></p> -->
                        </div>
                        <div>
                            <p style="margin: 0;">VAT No.:<span class="customer_c_tax"></span></p>
                        </div>
                    </div>
                </div>
                <div class="tm_table tm_style1 tm_mb20">
                    <div class="tm_round_border tm_accent_border_20 tm_radius_0">
                        <div class="tm_table_responsive">
                            <table>
                                <thead>
                                    <tr class="tm_accent_bg">
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Sr.No.</th>
                                        <th class="tm_width_6 tm_semi_bold tm_white_color">Description</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color">Rate</th>
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right currency">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="invoiceiteam vit_fzco">
                                    {{-- get dynamic invoice iteams --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tm_invoice_footer tm_mb10">
                        <div class="tm_right_footer">
                            <table>
                                <tbody>
                                    <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                        <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_border_none tm_bold">Sub-Total</td>
                                        <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_border_none tm_bold alltotal">Subtotal Loading...</td>
                                    </tr>
                                    <tbody class="gst-work vit_fzco">
                                        {{-- using ajax for tr tag --}}
                                    </tbody>
                                    <tr class="tm_border_bottom tm_border_left tm_border_right tm_accent_border_20 ">
                                        <td class="tm_width_3 tm_bold tm_f16 tm_primary_color tm_accent_border_20"> Grand Total </td>
                                        <td class="tm_width_3 rs-width_1 tm_bold tm_f16 tm_primary_color tm_accent_border_20 tm_text_right grandtotal">total Loding...</td>
                                    </tr>
                                    <tr class="tm_border_bottom tm_border_left tm_border_right tm_accent_border_20 tm_accent_bg">
                                        <td class="tm_width_3 rs-width_2 tm_bold tm_f16 tm_white_color tm_accent_border_20"> Amount in Words: </td>
                                        <td class="tm_width_9 tm_bold tm_f16 tm_white_color tm_accent_border_20 tm_text_right"><span class="numberToWords">Loading...</span></td>
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
                                    <td style="padding: 0 0 0 5px; border: none; width: 42%;"><strong>Bank A/c Holder Name:</strong></td>
                                    <td style="padding: 0 0 0 5px; border: none; "><span class="account_holder_name"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 5px; border: none; "><strong>Bank Name:</strong></td>
                                    <td style="padding: 0 0 0 5px; border: none; "><span class="bank_name"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 5px; border: none; "><strong>IBAN Code:</strong></td>
                                    <td style="padding: 0 0 0 5px; border: none; "><span class="iban_code"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 5px; border: none; "><strong>BIC Code:</strong></td>
                                    <td style="padding: 0 0 0 5px; border: none; "><span class="ifsc_code"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 0 5px; border: none; display: inline-grid;"><strong>Business Address:</strong></td>
                                    <td style="padding: 0 0 0 5px; border: none; "><span class="branch_name"></span></td>
                                </tr>
                            </table>
                            </div>
                            <div class="fzco-rs-bank-detiels-logo">
                                <img class="tm_mb15 sign rs_sign" alt="Sign">
                                <p class="tm_flex tm_flex_column_sm  signname"></p>
                            </div>
                        </div>

                    </div>
                </div>
                <p class="tm_bold tm_primary_color tm_m0">Terms and conditions</p>
                <ol>
                    <li class="mt-2 "><strong class="tm_bold tm_primary_color tm_m0">Payment Terms:</strong> Payment is
                        due within 30 days from the invoice date.
                    </li>
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