/* new -pr 4-8-25 */
$(document).ready(function () {

    // pr add 10-10-25
    function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status'); // Retrieve status from the URL
        const startDate = urlParams.get('startDate'); // Retrieve startDate from the URL
        const endDate = urlParams.get('endDate'); // Retrieve endDate from the URL
        // Set the initial value of the company filter dropdown
        if (status) $('#status-filter').val(status);
        if (startDate) $('#start-date').val(startDate);
        if (endDate) $('#end-date').val(endDate);
    }
    // /pr add 10-10-25

    function fetchInvoices() {
        // pr add || 10-10-25
        const status = $('#status-filter').val() || $('#status-filter').val('all').val(); // Get selected status
        const startDate = $('#start-date').val(); // Get selected start date -pr
        const endDate = $('#end-date').val(); // Get selected end date -pr
        $.ajax({
            //url: "{{ route('customer.invoice.filter') }}",
            url: '/customer/invoice/filter',
            method: "GET",
            data: { 
                 status: status,
                 startDate: startDate, // pr
                 endDate: endDate // pr
                },
            success: function (response) {
                $('#allInvoice').text(response.count);
                $('#paidInvoice').text(response.paid);
                $('#overdueInvoice').text(response.overdue);
                $('#pendingInvoice').text(response.pending);
                let rows = '';

                response.data.forEach(function (invoice) {
                    rows += `
                        <tr>
                            <td><a href="#">${invoice.invoice_number}</a></td>
                            
                            <td>${invoice.invoice_date}</td>
                            <td>${invoice.customer ? invoice.customer.company_name : '-'}</td>
                            <td class="text-primary">${invoice.grandtotal} ${invoice.currency}</td>
                            <td>${invoice.invoice_due_date}</td>
                            <td><span class="badge ${invoice.status}">${invoice.status}</span></td>
                            <td class="text-center d-flex">
                                <a href="#" data-bs-toggle="modal" data-id="${invoice.id}" 
                                    class="invoice-view my_icons ms-2 p-2 fs-6 view-action" 
                                    data-bs-target="#invoice-view-user" class=" p-2 fs-6 my_icons">
                                    <i data-bs-placement="top" title="View" 
                                        class="fa-solid fa-eye view text-success"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });
                if ($.fn.DataTable.isDataTable('.invoicesearch')) {
                    $('.invoicesearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#invoice-data').html(rows);

                //3. this is work when search is use.
                $('.invoicesearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (status && status !== 'all') query.set('status', status);
                if (startDate) query.set('startDate', startDate);
                if (endDate) query.set('endDate', endDate);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/customer/invoice/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25
                
            },
            error: function (error) {
                console.error("Error fetching invoices:", error);
            },
        });
    }

    // Trigger fetch on filter change
    $('#company-filter, #status-filter, #invoice-type-filter').change(function () {
        fetchInvoices();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        fetchInvoices();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        setDataFromUrl();
        // Initial fetch
        fetchInvoices();
    });

    setDataFromUrl();
    // Initial fetch
    fetchInvoices();
});
$(document).on('click','.invoice-view',function(){
    var InvoiceId = $(this).data('id');
    $.fn.formatIndianNumber = function(num) {
        // Ensure the input is a valid number
        num = parseFloat(num) || 0; // Convert to number or default to 0
        // Split the number into integer and decimal parts
        let parts = num.toFixed(2).split(".");
        // Format the integer part with Indian numbering system
        let integerPart = parts[0];
        let lastThreeDigits = integerPart.slice(-3);
        let otherDigits = integerPart.slice(0, -3);
    
        // Add commas to the other digits in groups of two
        if (otherDigits !== "") {
            otherDigits = otherDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ",");
        }
    
        // Combine formatted parts
        let formattedIntegerPart = otherDigits + (otherDigits ? "," : "") + lastThreeDigits;
        return formattedIntegerPart + "." + parts[1];
    };
    $.ajax({
        url: '/customer/invoiceview/' + InvoiceId,
        type: 'GET',
        success: function(data){
            var template_type = data.invoice.template;
            var invoice_num = data.invoice.invoice_number;
            // var dynamictag = '#tem-'+template_type;
            $('#tem-1, #tem-2, #tem-3, #tem-4').hide();
            $('#tem-' + template_type).show();

            $(".print_btnrs").on("click", function() {
                var printContent = document.getElementsByClassName("tems-" + template_type)[0].innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                print();
                document.body.innerHTML = originalContent;
                location.reload();
            });
            $(".download_btnrs").on("click", function () {
                var element = document.getElementsByClassName("tems-" + template_type)[0];
                var invoiceNum = invoice_num || "invoice"; // Fallback name
            
                var opt = {
                    margin:       0.5,
                    filename:     invoiceNum + '.pdf',
                    image:        { type: 'pdf', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                };
            
                html2pdf().set(opt).from(element).save();
            });
            
            if(data.company.logo){
                $('#invoice-view-user .signature').attr('src','/uploads/logos/' + data.company.logo);
            }
            //using invoice table data
            $('#invoice-view-user .invoice_number').text(data.invoice.invoice_number) ?? '';
            $('#invoice-view-user .invoice_p_no').text(data.invoice.invoice_p_no ?? '-') ?? '';
            $('#invoice-view-user .invoice_date').text(data.invoice.invoice_date) ?? '';
            $('#invoice-view-user .invoice_due_date').text(data.invoice.invoice_due_date) ?? '';
            if(data.invoice.note){
                $('#invoice-view-user .note').text(data.invoice.note ?? '-') ?? '-';
            }
            $('#invoice-view-user .alltotal').text($.fn.formatIndianNumber(data.invoice.alltotal)) ?? '';
            $('#invoice-view-user .gst').text(data.invoice.gst) ?? '';
            $('#invoice-view-user .grandtotal').text($.fn.formatIndianNumber(data.invoice.grandtotal)) ?? '';
            $('#invoice-view-user .currency').text(data.invoice.currency) ?? '';
            $('#invoice-view-user .option_tax').text(data.invoice.option_tax) ?? '';
            //using customer table data
            $('#invoice-view-user .customer_company_name').text(data.customer.company_name) ?? '';
            $('#invoice-view-user .customer_c_pho').text(data.customer.company_phone_number) ?? '';
            $('#invoice-view-user .customer_c_tax').text(data.customer.tax_number) ?? '';
            $('#invoice-view-user .customer_c_add').text(data.customer.address) ?? '';
            //using company table data
            $('#invoice-view-user .company_name').text(data.company.company_name) ?? '';
            $('#invoice-view-user .company_phone_number').text(data.company.phone_number) ?? '';
            $('#invoice-view-user .company_email').text(data.company.email) ?? '';
            $('#invoice-view-user .company_tax').text(data.company.gst_number) ?? '';
            $('#invoice-view-user .company_pan').text(data.company.pan_number) ?? '';
            $('#invoice-view-user .company_address').text(data.company.address) ?? '';
            $('#invoice-view-user .bank_account_no').text(data.company.bank_account_no) ?? '';
            $('#invoice-view-user .account_holder_name').text(data.company.account_holder_name) ?? '';
            $('#invoice-view-user .branch_name').text(data.company.branch_name) ?? '';
            $('#invoice-view-user .bank_name').text(data.company.bank_name) ?? '';
            $('#invoice-view-user .ifsc_code').text(data.company.ifsc_code) ?? '';
            $('#invoice-view-user .swift_code').text(data.company.swift_code) ?? '';
            $('#invoice-view-user .iban_code').text(data.company.iban_code) ?? '';
            $('#invoice-view-user .sign').attr('src','/uploads/logos/' + data.company.sign);
            $('#invoice-view-user .signname').text(data.company.signname) ?? '';
            var currency = data.invoice.currency;
            $('#invoice-view-user .numberToWords').text(currency+' '+ data.numberToWords+' Only') ?? '';
            $('#invoice-view-user .currency').text('Amount (' +currency +')') ?? '';
            let rows = '';
                data.invoiceitems.forEach(i =>
                    rows += `
                        <tr>
                            <td>${i.sr_no}</td>
                            <td>${i.description}</td>
                            <td>${$.fn.formatIndianNumber(i.rate)}</td>
                            <td>${i.quantity}</td>
                            <td>${$.fn.formatIndianNumber(i.amount)}</td>
                        </tr>
                    `
                );
            $('#invoice-view-user .invoiceiteam').html(rows);

            var gst = data.invoice.gst;
            $('#invoice-view-user .gst-work').html('');
            if(gst != null){
                if(data.invoice.option_tax == 'gst'){
                    var cgst = gst/2;
                    var totalamount = data.invoice.alltotal;
                    var gstamout = (totalamount * gst) / 100;
                   
                    let gstdata = `
                    <tr>
                        <td><b>CGST:</b>${cgst}%</td>
                        <td>${$.fn.formatIndianNumber(gstamout/2)}</td>
                    </tr>
                    <tr>
                        <td><b>SGST:</b>${cgst}%</td>
                        <td>${$.fn.formatIndianNumber(gstamout/2)}</td>
                    </tr>
                    `
                    $('#invoice-view-user .gst-work').html(gstdata); 
                    
                }
                if(data.invoice.option_tax == 'igst'){
                    var totalamount = data.invoice.alltotal;
                    var gstamout = (totalamount * gst) / 100;
                    console.log('total amount :'+ totalamount +'parcentage amount'+ gstamout);
                    let gstdata = `
                    <tr>
                        <td><b>IGST:</b>${gst}%</td>
                        <td>${$.fn.formatIndianNumber(gstamout)}</td>
                    </tr>
                    `
                    $('#invoice-view-user .gst-work').html(gstdata); 
                    
                }
                if(data.invoice.option_tax == 'vat'){
                    var totalamount = data.invoice.alltotal;
                    var gstamout = (totalamount * gst) / 100;
                    //console.log('total amount :'+ totalamount +'parcentage amount'+ gstamout);
                    let gstdata = `
                    <tr>
                        <td><b>VAT:</b>${gst}%</td>
                        <td>${$.fn.formatIndianNumber(gstamout)}</td>
                    </tr>
                    `
                    $('#invoice-view-user .gst-work').html(gstdata); 
                    
                }
            }
        },
        error: function(error){
            console.error("ajax error: " + error);
        }
    });
});
