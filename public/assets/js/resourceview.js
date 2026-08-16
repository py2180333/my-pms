$(document).ready(function () {

    // pr add 10-10-25
    function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const company = urlParams.get('company_id'); // Retrieve company_id from the URL
        const designation = urlParams.get('role'); // Retrieve role from the URL
        // Set the initial value of the company filter dropdown
        if (company) $('#company-filter-resouces').val(company);
        if (designation) $('#status-filter-resouces').val(designation);
    }
    // /pr add 10-10-25

    function fetchResources() {
        // pr add || 10-10-25
        const company = $('#company-filter-resouces').val() || ($('#company-filter-resouces').val('all').val()); // Get selected company
        const designation = $('#status-filter-resouces').val() || ($('#status-filter-resouces').val('all').val()); // Get selected designation
        
        $.ajax({
            url: '/admin/Resources/filter',
            method: "GET",
            data: { 
                company_id: company,
                role: designation,
             },
            success: function (response) {
                $('#allResources').text(response.count);
                $('#active').text(response.active);
                $('#inactive').text(response.deactive);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (resource, index) {

                    let statusBadge = resource.status === 'inactive' ? 
                        '<lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>' : 
                        '<label class="badge badge-gradient-success">Active</lable>';
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${resource.username}</td>
                            <td>
                                <img 
                                    src="${resource.profile_picture
                                        ? '/uploads/Resources/' + resource.profile_picture 
                                        : '/assets/img/user_profile.png'}"
                                    class="avatar" 
                                    alt="resource Photo" 
                                />
                            </td>
                            <td>${resource.first_name} ${resource.last_name}</td>
                            <td>
                                <div class="user-email">
                                    <a href="mailto:${ resource.email }">${ resource.email }</a>
                                </div>
                            </td>
                            <td>
                                <a href="tel:${ resource.phone_number }">${ resource.phone_number }</a>
                            </td>
                            <td>
                                ${resource.role}
                            </td>
                            <td>
                                ${statusBadge}
                            </td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-resource edit-action"  data-bs-toggle="modal" data-id="${ resource.id }" data-bs-target="#edit-form-resource">
                                    <i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                </a>
                                <button class="btn btn-link ms-2 p-2 fs-6 my_icons view-action view-Resource text-success" data-id="${ resource.id }" data-bs-toggle="modal" data-bs-target="#resource-details-modal">
                                    <i class="fa-solid fa-eye" data-bs-placement="top" title="View"></i>
                                </button>
                                <form action="/admin/users/Resources/${resource.id}/trash" method="POST" onsubmit="return confirm('Are you sure you want to move this vendor to trash?');">
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

                if ($.fn.DataTable.isDataTable('.resourcesearch')) {
                    $('.resourcesearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#resource-data').html(rows);

                //3. this is work when search is use.
                $('.resourcesearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (company && company !== 'all') query.set('company_id', company);
                if (designation && designation !== 'all') query.set('role', designation);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/admin/users/Resources/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25

            },
            error: function (error) {
                console.error("Error fetching resouces:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#company-filter-resouces, #status-filter-resouces').change(function () {
        fetchResources();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        setDataFromUrl();
        fetchResources();
    });
    
    setDataFromUrl();
    // Initial fetch
    fetchResources();
});

