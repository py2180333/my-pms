$(document).ready(function () {

    function fetchLeaves() {
        const resource = $('#resource-filter-leave').val(); // Get selected resource
        const status = $('#status-filter-leave').val(); // Get selected status
        const type = $('#type-filter-leave').val(); // Get selected type
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/admin/leaves/filter',
            method: "GET",
            data: { 
                resource_id: resource,
                status: status,
                type: type,
                startDate: startDate,
                endDate: endDate
             },
            success: function (response) {
                $('#totalLeaves').text(response.totalLeaves);
                $('#paidLeaves').text(response.paidLeaves);
                $('#unpaidLeaves').text(response.unpaidLeaves);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.leaves.forEach(function (leave) {
                    
                    rows += `
                        <tr>
                            <td>${leave.resource.first_name}</td>
                            <td> ${leave.reason_for_leave}</td>
                            <td> ${leave.total_days}</td>
                            <td>${leave.paid_days}</td>
                            <td>${leave.unpaid_days}</td>
                            <td>${leave.status}</td>
                            <td class="d-flex">
                                <button class=" btn btn-sm view-calendar ms-2 p-2 fs-6 my_icons view-action" data-leave-id="${leave.id}"><i class="fa-solid fa-eye view text-success" data-bs-placement="top" title="View"></i></button>
                                <button class="btn btn-sm edit-leave ms-2 p-2 fs-6 my_icons edit-action" data-id="${leave.id}" data-status="${leave.status}"><i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
                                <form method="POST" action="/admin/leaves/destroy/${leave.id}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this leave?')">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-danger ms-2 p-2 fs-6 my_icons text-danger delete-action" type="submit"><i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.leavesearch')) {
                    $('.leavesearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#leave-data').html(rows);

                //3. this is work when search is use.
                $('.leavesearch').DataTable({
                    "buttons": []
                });
            },
            error: function (error) {
                console.error("Error fetching leave:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#resource-filter-leave, #status-filter-leave, #type-filter-leave').change(function () {
        fetchLeaves();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        fetchLeaves();
    });

    // Initial fetch
    fetchLeaves();
});