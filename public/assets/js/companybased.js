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
                    $('.customer-id').append('<option value="'+ customers.id +'">'+ customers.first_name +' '+ customers.last_name +'</option>');
                });
            },
            error: function() {
                $('.customer-id').html('<option value="" disabled selected>No customers found</option>');
            }
        });
    });

    $('.rd-company-project').change(function(){
        var companyId = $(this).val();
        $('.customer-id').html('<option value="" disabled selected>Loading...</option>');
        $.ajax({
            url: '/admin/getcustomersandvendors/',
            method: "GET",
            data: { company_id: companyId },
            success: function(response) {
                $('.customer-id').html('<option value="" disabled selected>Select a Customer</option>');
                $('.vendor-id').html('<option value="" disabled selected>Select a Vendor</option>');
                $('.project_manager_id').html('<option value="" disabled selected>Select a Project Manager</option>');

                // Loop through customers
                $.each(response.customers, function(index, customer) {
                     $('.customer-id').append('<option value="'+ customer.id +'">'+ customer.company_name +'</option>');
                });
        
                // Loop through vendors
                $.each(response.vendors, function(index, vendor) {
                    $('.vendor-id').append('<option value="'+ vendor.id +'">'+ vendor.company_name +'</option>');
                });

                // Loop through projectManagers
                $.each(response.projectManagers, function(index, projectManager) {
                    $('.project_manager_id').append('<option value="'+ projectManager.id +'">'+ projectManager.email +'</option>');
                });
            },
            error: function() {
                $('.customer-id').html('<option value="" disabled selected>No customers found</option>');
                $('.vendor-id').html('<option value="" disabled selected>No vendors found</option>');
                $('.project_manager_id').html('<option value="" disabled selected>No Project Managers found</option>');
            }
        });
        
    });
});