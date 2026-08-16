$(document).ready(function(){
    $('.rd-company').change(function(){
        var companyId = $(this).val();
        $('.customer-id').html('<option value="" disabled selected>Loading...</option>');

        $.ajax({
            url: '/admin/getcustomers/',
            method: "GET",
            data: { company_id: companyId },
            success: function(response) {
                $('.customer-id').html('<option value="" disabled selected>Select a Customer</option>');
                
                $.each(response, function(index, customers) {
                    $('.customer-id').append('<option value="'+ customers.id +'">'+ customers.first_name +' '+ customers.last_name +' ('+ customers.company_name +')</option>');
                });
            },
            error: function() {
                $('.customer-id').html('<option value="" disabled selected>No customers found</option>');
            }
        });
    });
});