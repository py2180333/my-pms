<div class="invoice-container-wrap" id="tem-1">
    <div class="invoice-container">
        <main>
            <div class="tqt-invoice invoice_style21">
                <div class="download-inner tems-1" id="tems-1">
                    <div class="overlay-img"></div>
                    <header class=" header-layout13">
                        <div class="row align-items-center justify-content-between mb-4">
                            <div class="col-auto">
                                <div class="header-logo"><img class="signature"
                                            alt="Invar"></div>
                            </div>
                            <div class="col-auto">
                                <h1 class="big-title">Invoice</h1>
                            </div>
                        </div>
                        <hr class="style3">
                        <div class="row justify-content-between">
                            <div class="col-auto"><span><b>Invoice No. : </b><span class="invoice_number"></span></span></div>
                            <div class="col-auto"><span><b>PO No. : </b><span class="invoice_p_no"></span></div>
                            <div class="col-auto"><span><b>Date : </b><span class="invoice_date"></span></span></div>
                        </div>
                        <hr class="style3">
                    </header>
                    <div class="row justify-content-between my-4">
                        <div class="col-6">
                            <div class="invoice-info">
                                <strong class="customer-text-one">Invoice From</strong>
                                
                                <table>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none; display: inline-grid;">
                                            <strong class="invoice-name m-0">Name :</strong>
                                        </td>
                                        <td style="padding: 0px 0 !important; border: none; color:#000;"><p class="invoice-name company_name">company name loading...</p></td>
                                    </tr>
                                    <tr>

                                        <td style="padding: 0px 0 !important;width: 80px; border: none; color:#000;"><strong class="me-2">Phone No. : </strong></td>
                                        <td style="padding: 0px 0 !important; border: none; color:#000;"> <p class="invoice-number"><span class="company_phone_number">Phone number loading...</span></p></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none; color:#000;"><strong class="me-2">E-mail : </strong></td>
                                        <td style="padding: 0px 0 !important;border: none; color:#000;"><p class="invoice-email"><span class="company_email">Email Loading...</span></p></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none; color:#000;"><strong class="me-2">GST No. : </strong></td>
                                        <td style="padding: 0px 0 !important;border: none; color:#000;"><p class="invoice-gst"><span class="company_tax">TAX Loading...</span></p></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none; color:#000;"><strong class="me-2">PAN No. : </strong></td>
                                        <td style="padding: 0px 0 !important;border: none; color:#000;"><p class="invoice-pan"><span class="company_pan">PAN Loading...</span></p></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid; color:#000;"><strong class="me-2" >Address :</strong></td>
                                        <td style="padding: 0px 0 !important;border: none; color:#000;"><p class="invoice-details invoice-details-two "><span class="company_address">Address Loading...</span></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="invoice-info">
                                <strong class="customer-text-one">Invoice To</strong>
                                <table>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none; display: inline-grid;">
                                        <strong class="invoice-name m-0">Name :</strong>
                                        </td>
                                        <td style="padding: 0px 0; border: none;"> <p class="invoice-name m-0"><span class="customer_company_name m-0"></span></p></td>
                                    </tr>
                                    <!-- <tr>
                                        <td style="padding: 0px 0 !important;width: 65px; border: none;">
                                        <strong class="me-2">Phone.No:</strong>
                                        </td>
                                        <td style="padding: 0px 0; border: none;"> <p class="invoice-number"><span class="customer_c_pho"></span></p></td>
                                    </tr> -->
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 80px; border: none; color:#000;">
                                        <strong class="me-2">GST No. :</strong>
                                        </td>
                                        <td style="padding: 0px 0; border: none;"><p class="invoice-gst"><span class="customer_c_tax"></span></p></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 0 !important;width: 80px; border: none; display: inline-grid; color:#000;">
                                        <strong class="me-2">Address :</strong>
                                        </td>
                                        <td style="padding: 0px 0; border: none; color:#000;"> <p class="invoice-details  invoice-details-two mt-1 " style="width:200px;"><span class="customer_c_add"></span></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <table class="invoice-table table-style9">
                        <thead>
                            <tr>
                                <th style=" font-weight: 700; color: #fff;">Sr.No.</th>
                                <th style=" font-weight: 700; color: #fff;">Description</th>
                                <th style=" font-weight: 700; color: #fff;">Rate</th>
                                <th style=" font-weight: 700; color: #fff;">Qty</th>
                                <th style=" font-weight: 700; color: #fff;" class="currency">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="invoiceiteam">
                            {{-- get dynamic invoice iteams --}}
                        </tbody>
                        <table class="total-table  table-style9">
                            <tr>
                                <th>Sub-Total :</th>
                                <td class="alltotal">sub total Loding...</td>
                            </tr>
                            <tbody class="gst-work">
                                {{-- using ajax for tr tag --}}
                            </tbody>
                            <tr>
                                <th>Total :</th>
                                <td class="grandtotal">total Loding...</td>
                            </tr>
                            <tr>
                                <td style="background-color: #2250b0; color: #fff;"><b style=" color: #fff;">Amout In Words :</b></td>
                                <td style="background-color: #2250b0; color: #fff;"><b style=" color: #fff;" class="numberToWords">Loading...</b></td>
                            </tr>
                            
                        </table>
                    </table>
                    <div class="row justify-content-between">
                        <div class="col-8">
                            <div class="invoice-left">
                                <strong class="customer-text-one">Payment Details</strong>
                                <table>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; width: 42%; color:#000;">
                                        <strong>Bank A/c Holder Name :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="account_holder_name"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;">
                                        <strong>Bank Name :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="bank_name"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;">
                                        <strong>Account Number :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="bank_account_no"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;">
                                        <strong>IFSC Code :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="ifsc_code"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;">
                                        <strong>SWIFT Code :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="swift_code"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;">
                                        <strong>Branch :</strong>
                                        </td>
                                        <td style="padding: 0 0 0 5px; border: none; color:#000;"><span class="branch_name"></span></td>
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                    <div class="col-4">
                        <div class="invoice-sign text-end">
                            <img class="img-fluid d-inline-block sign" style="max-width: 150px;" alt="sign">
                            <span class="d-block signname"></span>
                        </div>
                        
                    </div>
                    <hr class="style3">
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <div class="invoice-left">
                                <h6>Terms and Conditions:</h6>
                                <ol>
                                    <li class="mt-2" style="color:#000;"><strong>Payment Terms:</strong> Payment is due within 30 days
                                        from the invoice date. 
                                    </li>
                                    <li class="mt-2" style="color:#000;"><strong>Accepted Payment Methods:</strong>
                                    <ul>
                                        <li style="color:#000;"><strong>Option1:</strong>Online Transfer</li>
                                        <li style="color:#000;"><strong>Option2:</strong>Cheque on the name of The Quantum Tech., Jurisdiction Subject To Ahmedabad, Gujarat, India.</li>
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
                        </svg> <b>NOTE: </b><span class="note"></span></p>
                </div>
                
            </div>
        </main>
    </div>
</div>