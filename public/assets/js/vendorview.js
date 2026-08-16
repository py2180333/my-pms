$(document).ready(function () {

    // pr add 10-10-25
    function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const company = urlParams.get('company_id'); // Retrieve company_id from the URL
        // Set the initial value of the company filter dropdown
        if (company) $('#company-filter-vendor').val(company);
    }
    // /pr add 10-10-25

    function fetchVendors() {
        // pr add || 10-10-25
        const company = $('#company-filter-vendor').val() || ($('#company-filter-vendor').val('all').val()); // Get selected company

        $.ajax({
            url: '/admin/vendors/filter',
            method: "GET",
            data: { company_id: company },
            success: function (response) {
                $('#allVendors').text(response.count);
                $('#active').text(response.active);
                $('#inactive').text(response.deactive);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (vendor, index) {

                    let statusBadge = vendor.status === 'inactive' ? 
                        '<lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>' : 
                        '<label class="badge badge-gradient-success">Active</lable>';
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <img 
                                    src="${vendor.profile_picture 
                                            ? '/uploads/vendors/' + vendor.profile_picture 
                                            : '/assets/img/user_profile.png'}"
                                    class="avatar"
                                    alt="vendor Photo"
                                />
                            <td>
                                <a href="#" class="text-decoration-none">${vendor.first_name} ${vendor.last_name}</a>
                            </td>
                            <td>
                                <div class="user-email">
                                    <a href="mailto:${ vendor.email }">${ vendor.email }</a>
                                </div>
                            </td>
                            <td>${ vendor.phone_number }</td>
                            <td>
                                ${statusBadge}
                            </td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-vendor edit-action" data-id="${ vendor.id }" data-bs-toggle="modal" data-bs-target="#edit-form-vendors">
                                    <i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                </a>                                                    
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-vendor view-action" data-id="${ vendor.id }" data-bs-toggle="modal" data-bs-target="#vendor-details-modal">
                                    <i class="fa-solid fa-eye view text-success" data-bs-placement="top" title="View"></i>
                                </a>
                                <form action="/admin/users/vendors/${vendor.id}/trash" method="POST" onsubmit="return confirm('Are you sure you want to move this vendor to trash?');">
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

                if ($.fn.DataTable.isDataTable('.vendorsearch')) {
                    $('.vendorsearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#vendor-data').html(rows);

                //3. this is work when search is use.
                $('.vendorsearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                if (company && company !== 'all') {
                    const newUrl = `${window.location.origin}/admin/users/vendors/index?company_id=${company}`;
                    history.pushState({ path: newUrl }, '', newUrl);
                } else {
                    // Reset to the base URL when no company filter is selected
                    const newUrl = `${window.location.origin}/admin/users/vendors/index`;
                    history.pushState({ path: newUrl }, '', newUrl);
                }
                // /pr add 10-10-25
            },
            error: function (error) {
                console.error("Error fetching vendors:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#company-filter-vendor').change(function () {
        fetchVendors();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        setDataFromUrl();
        fetchVendors();
    });

    setDataFromUrl();
    // Initial fetch
    fetchVendors();
});
