$(document).ready(function () {

    function fetchAttendances() {
        const resource = $('#resource-filter-attendance').val(); // Get selected resource
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/admin/attendance/filter',
            method: "GET",
            data: { 
                resource_id: resource,
                startDate: startDate,
                endDate: endDate,
             },
            success: function (response) {
                $('#workingDays').text(response.workingDays);
                $('#totalWorkigHours').text(response.totalWorkigHours);
                $('#totalBreakHours').text(response.totalBreakHours);
                let rows = '';

                response.attendances.forEach(function (attendance) {
                    
                    rows += `
                        <tr>
                            <td>${ attendance.resource.first_name } ${ attendance.resource.last_name }</td>
                            <td>${ attendance.date }</td>
                            <td>${ attendance.check_in }</td>
                            <td>${ attendance.check_out }</td>
                            <td>${ attendance.break_minutes}</td>
                            <td>${ attendance.working_hours}</td>
                            <td>
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" data-bs-target="#update-attendance-${attendance.id}" data-id="${attendance.id}"><i
                                    class="fa-solid fa-pen-to-square text-dark"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Edit"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.attendancesearch')) {
                    $('.attendancesearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#attendance-data').html(rows);

                //3. this is work when search is use.
                $('.attendancesearch').DataTable({
                    "order": [[1, "desc"],[2,"asc"]],
                    "columnDefs": [
                        { "orderable": false, "targets": '_all' }
                    ],
                    "buttons": []
                });
            },
            error: function (error) {
                console.error("Error fetching attendance:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#resource-filter-attendance').change(function () {
        fetchAttendances();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        fetchAttendances();
    });

    // Initial fetch
    fetchAttendances();
});
