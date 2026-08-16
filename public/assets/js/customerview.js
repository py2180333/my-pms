$(document).ready(function () {

    function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const company = urlParams.get('company_id'); // Retrieve company_id from the URL
        // Set the initial value of the company filter dropdown
        if (company) $('#company-filter').val(company);
    }

    function fetchCustomers() {
        const company = $('#company-filter').val() || ($('#company-filter').val('all').val()); // Get selected company
        
        $.ajax({
            url: '/admin/customers/filter',
            method: "GET",
            data: { company_id: company },
            success: function (response) {
                $('#allCustomers').text(response.count);//pr
                $('#active').text(response.active);//pr
                $('#inactive').text(response.deactive);//pr
                let rows = '';

                response.data.forEach(function (customer, index) {

                    let statusBadge = customer.status === 'deactive' ? 
                        '<label class="badge bg-danger">Inactive</label>' : 
                        '<label class="badge badge-gradient-success">Active</label>';
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${customer.company_name}</td>
                            <td>${customer.first_name} ${customer.last_name}</td>
                            <td>${customer.email}</td>
                            <td>${customer.phone_number}</td>
                            <td>${statusBadge}</td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-customer edit-action" 
                                    data-id="${customer.id}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#edit-form-customer">
                                    <i class="fa-solid fa-pen-to-square text-dark" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Edit"></i>
                                </a>                                               
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-customer view-action" 
                                    data-id="${customer.id}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#user-details-modal">
                                    <i class="fa-solid fa-eye text-success" 
                                        data-bs-placement="top" 
                                        title="View"></i>
                                </a>
                                <form action="/admin/users/customers/${customer.id}/trash" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to move this customer to trash?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                        <i class="fa-solid fa-trash" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.customersearch')) {
                    $('.customersearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#customer-data').html(rows);

                //3. this is work when search is use.
                $('.customersearch').DataTable({
                    "buttons": []
                });

                if (company && company !== 'all') {
                    const newUrl = `${window.location.origin}/admin/users/customers/index?company_id=${company}`;
                    history.pushState({ path: newUrl }, '', newUrl);
                } else {
                    // Reset to the base URL when no company filter is selected
                    const newUrl = `${window.location.origin}/admin/users/customers/index`;
                    history.pushState({ path: newUrl }, '', newUrl);
                }
            },
            error: function (error) {
                console.error("Error fetching customers:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#company-filter').change(function () {
        fetchCustomers();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        setDataFromUrl();
        fetchCustomers();
    });

    setDataFromUrl();
    // Initial fetch
    fetchCustomers();
});
