$(document).ready(function () {

    // pr add 10-10-25
    async function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const company = urlParams.get('company_id'); // Retrieve company_id from the URL
        // Initial fetch
        await fetchCustomer();
        const customer = urlParams.get('customer_id'); // Retrieve customer_id from the URL
        const statusData = urlParams.get('status'); // Retrieve status from the URL
        const startDate = urlParams.get('stDate'); // Retrieve stDate from the URL
        const endDate = urlParams.get('endDate'); // Retrieve endDate from the URL
        // Set the initial value of the company filter dropdown
        if (company) $('#company-filter-project').val(company);
        if (customer) $('#customer-filter-project').val(customer);
        if (statusData) $('#status-filter-project').val(statusData);
        if (startDate) $('#start-date').val(startDate);
        if (endDate) $('#end-date').val(endDate);
        return;
    }
    // /pr add 10-10-25

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    }


    function fetchProjects() {
        // pr add || 10-10-25
        const company = $('#company-filter-project').val() || $('#company-filter-project').val('all').val(); // Get selected company
        const customer = $('#customer-filter-project').val() || $('#customer-filter-project').val('all').val(); // Get selected customer
        const statusData = $('#status-filter-project').val() || $('#status-filter-project').val('all').val(); // Get selected status
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/admin/projects/filter',
            method: "GET",
            data: { 
                company_id: company,
                customer_id: customer,
                status: statusData,
                stDate: startDate,
                endDate: endDate,
             },
            success: function (response) {
                $('#allProjects').text(response.count);
                $('#value').text(response.totalValue);
                $('#progress').text(response.progress);
                $('#planning').text(response.planning);
                $('#completed').text(response.completed);
                $('#hold').text(response.hold);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (project, index) {
                    
                    rows += `
                        <tr>
                            <td class="checkBox">
                                ${index + 1}
                            </td>
                            <td class="text-center">${ project.uniquename }</td>
                            <td>${ project.project_name }</td>
                            <td class="text-center">
                                ${ project.customer?.first_name ?? 'No Customer' }
                                ${ project.customer?.last_name ?? '' }
                                <p class="m-0">${ project.customer?.email ?? '' }</p>
                            </td>
                            <td class="text-center">
                                ${ project.vendor?.first_name ?? 'No Vendor' }
                                ${ project.vendor?.last_name ?? '' }
                                <p class="m-0">${ project.vendor?.email ?? '' }</p>
                            </td>
                            <td class="text-center">
                                ${ project.manager?.first_name ?? 'No Manager' } 
                                ${ project.manager?.last_name ?? '' }
                                <p class="m-0">${ project.manager?.email ?? '' }</p>
                            </td>

                            <td class="text-center">
                                <label class="badge badge-gradient-${ project.status == 'completed' ? 'success' : 'warning' }">
                                    ${ project.status.charAt(0).toUpperCase() + project.status.slice(1).replace(/_/g, ' ') }
                                </label>
                            </td>
                            <td class="text-center">${ formatDate(project.start_date) }</td>
                            <td class="text-center">${ formatDate(project.end_date) }</td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons mailstone-action" data-bs-toggle="modal" data-bs-target="#mailstone-user-${ project.id }">
                                    <i class="fas fa-history"  data-bs-toggle="tooltip" data-bs-placement="top" title="Mailstone"></i>
                                </a>
                                <a href="#" class="ms-2 p-2 fs-6 my_icons projectUpdatedoc edit-action" data-bs-toggle="modal" data-bs-target="#update-project-${project.id}" data-id="${ project.id }">
                                    <i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                </a>
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-action" data-bs-toggle="modal" data-bs-target="#system-user-${ project.id }">
                                    <i class="fa-solid fa-eye view text-success" data-bs-placement="top" title="View"></i>
                                </a>
                                <form action="/admin/projects/index/${project.id}/trash" method="POST" onsubmit="return confirm('Are you sure you want to move this Project to trash?');">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                        <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.projectsearch')) {
                    $('.projectsearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#project-data').html(rows);

                //3. this is work when search is use.
                $('.projectsearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (company && company !== 'all') query.set('company_id', company);
                if (customer && customer !== 'all') query.set('customer_id', customer);
                if (statusData && statusData !== 'all') query.set('status', statusData);
                if (startDate) query.set('stDate', startDate);
                if (endDate) query.set('endDate', endDate);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/admin/projects/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25

            },
            error: function (error) {
                console.error("Error fetching resouces:", error);
            },
        });
    }

    function fetchCustomer() {
        const company = $('#company-filter-project').val(); // Get selected company

        return $.ajax({
            url: '/admin/getCusByCompany',
            method: "GET",
            data: { 
                company_id: company,
             },
            success: function (response) {
                let options = '<option value="all" selected>All Customer</option>'; // default option
                response.customers.forEach(function (customer) {
                    options += `<option value="${customer.id}">${customer.first_name} ${customer.last_name }</option>`;
                })
                $('#customer-filter-project').html(options);
            },
            error: function (error) {
                console.error("Error fetching customer dropdown:", error);
            },
        });
    }

    function loading(){
        let table = $('.projectsearch').DataTable();
        table.clear();
        table.row.add(['', '', '', '', '<div class="text-center">Loading...</div>', '', '', '', '', '']);
        table.draw();
    }

    // Trigger fetch on company filter change
    $('#customer-filter-project, #status-filter-project, #start-date, #end-date').change(function () {
        loading();
        fetchProjects();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        loading();
        fetchProjects();
    });

    $('#company-filter-project').change(async function () {
        loading();
        $('#customer-filter-project').html('<option select>Loading...</option>');
        await fetchCustomer();
        $('#customer-filter-project').val('all');
        fetchProjects();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        init();
    });

    async function init(){
        loading();
        await setDataFromUrl(); // <- fetchCustomer()
        // Initial fetch
        fetchProjects();
    }

    init();
});

// invoice view same in invoiceview.js
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
        url: '/admin/invoiceview/' + InvoiceId,
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