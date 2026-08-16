
$(document).ready(function() {

    // Variables declarations

    var $wrapper = $('.main-wrapper');
    var $pageWrapper = $('.page-wrapper');
    var $slimScrolls = $('.slimscroll');
    // Sidebar

   //loader script
   $('.contentPost').removeClass('none');
       $('.contentPost');
       setTimeout(function () {
           $('.contentPost').addClass('none');
       }, 2000);
   
      
    var Sidemenu = function() {
        this.$menuItem = $('#sidebar-menu a');
    };

    function init() {
        var $this = Sidemenu;
        $('#sidebar-menu a').on('click', function(e) {
            if ($(this).parent().hasClass('submenu')) {
                e.preventDefault();
            }
            if (!$(this).hasClass('subdrop')) {
                $('.sub-menus', $(this).parents('.sub-menus:first')).slideUp(350);
                $('a', $(this).parents('.sub-menus:first')).removeClass('subdrop');
                $(this).next('.sub-menus').slideDown(350);
                $(this).addClass('subdrop');
            } else if ($(this).hasClass('subdrop')) {
                $(this).removeClass('subdrop');
                $(this).next('.sub-menus').slideUp(350);
            }
        });
        $('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
    }

    // Sidebar Initiate
    init();

    // Mobile menu sidebar overlay

    $('body').append('<div class="sidebar-overlay"></div>');
    $(document).on('click', '#mobile_btn', function() {
        $wrapper.toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
        $('html').addClass('menu-opened');
        $('#task_window').removeClass('opened');
        return false;
    });

    $(".sidebar-overlay").on("click", function() {
        $('html').removeClass('menu-opened');
        $(this).removeClass('opened');
        $wrapper.removeClass('slide-nav');
        $('.sidebar-overlay').removeClass('opened');
        $('#task_window').removeClass('opened');
    });

    // Chat sidebar overlay

    $(document).on('click', '#task_chat', function() {
        $('.sidebar-overlay').toggleClass('opened');
        $('#task_window').addClass('opened');
        return false;
    });

    // Select 2
    // if ($('[data-feather]').length > 0) {
    // feather.replace();
    // }
    // if ($('.select').length > 0) {
    //     $('.select').select2({
    //         minimumResultsForSearch: -1,
    //         width: '100%'
    //     });
    // }

    // Modal Popup hide show

    if ($('.modal').length > 0) {
        var modalUniqueClass = ".modal";
        $('.modal').on('show.bs.modal', function(e) {
            var $element = $(this);
            var $uniques = $(modalUniqueClass + ':visible').not($(this));
            if ($uniques.length) {
                $uniques.modal('hide');
                $uniques.one('hidden.bs.modal', function(e) {
                    $element.modal('show');
                });
                return false;
            }
        });
    }

    // Floating Label

    if ($('.floating').length > 0) {
        $('.floating').on('focus blur', function(e) {
            $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    }

    // Sidebar Slimscroll

    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: '7px',
            color: '#ccc',
            wheelStep: 10,
            touchScrollStep: 100
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $('.sidebar .slimScrollDiv').height(wHeight);
        $(window).resize(function() {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $('.sidebar .slimScrollDiv').height(rHeight);
        });
    }

    // Page Content Height

    var pHeight = $(window).height();
    $pageWrapper.css('min-height', pHeight);
    $(window).resize(function() {
        var prHeight = $(window).height();
        $pageWrapper.css('min-height', prHeight);
    });
      // Page Content Height Resize
	$(window).resize(function () {
		if ($('.page-wrapper').length > 0) {
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});
    // Date Time Picker

    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down",
                next: 'fa fa-angle-right',
                previous: 'fa fa-angle-left'
            }
        });
    }

    // Logo Hide Btn

    $(document).on("click",".logo-hide-btn",function () {
        $(this).parent().hide();
    });
    
    // Datatable

    // if ($('.datatable').length > 0) {
    //     $('.datatable').DataTable({
    //         "bFilter": false,
    //     });
    // }
    // if ($('.datatables').length > 0) {
    //     $('.datatables').DataTable({
    //         "bFilter": true,
    //     });
    // }
    

    // Tooltip

    if ($('[data-bs-toggle="tooltip"]').length > 0) {
        $('[data-bs-toggle="tooltip"]').tooltip();
    }

    // Email Inbox

    if ($('.clickable-row').length > 0) {
        $('.clickable-row').on('click', function() {
            window.location = $(this).data("href");
        });
    }


    if ($('.clickable-row').length > 0) {
        $('.clickable-row').on('click', function() {
            window.location = $(this).data("href");
        });
    }
    // Check all email

    $(document).on('click', '#check_all', function() {
        $('.checkmail').click();
        return false;
    });
    if ($('.checkmail').length > 0) {
        $('.checkmail').each(function() {
            $(this).on('click', function() {
                if ($(this).closest('tr').hasClass('checked')) {
                    $(this).closest('tr').removeClass('checked');
                } else {
                    $(this).closest('tr').addClass('checked');
                }
            });
        });
    }

    // Mail important

    $(document).on('click', '.mail-important', function() {
        $(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
    });

    // Summernote

    if ($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
    }

    // editor
	if ($('#editor').length > 0) {
		ClassicEditor
		.create( document.querySelector( '#editor' ), {
			toolbar: {
                items: [
                    'heading', '|',
                    'fontfamily', 'fontsize', '|',
                    'alignment', '|',
                    'fontColor', 'fontBackgroundColor', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                    'link', '|',
                    'outdent', 'indent', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'code', 'codeBlock', '|',
                    'insertTable', '|',
                    'uploadImage', 'blockQuote', '|',
                    'undo', 'redo'
                ],
                shouldNotGroupWhenFull: true
            }
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	}

    // Task Complete

    $(document).on('click', '#task_complete', function() {
        $(this).toggleClass('task-completed');
        return false;
    });

    // Multiselect

    if ($('#customleave_select').length > 0) {
        $('#customleave_select').multiselect();
    }
    if ($('#edit_customleave_select').length > 0) {
        $('#edit_customleave_select').multiselect();
    }

    // Leave Settings button show

    $(document).on('click', '.leave-edit-btn', function() {
        $(this).removeClass('leave-edit-btn').addClass('btn btn-white leave-cancel-btn').text('Cancel');
        $(this).closest("div.leave-right").append('<button class="btn btn-primary leave-save-btn" type="submit">Save</button>');
        $(this).parent().parent().find("input").prop('disabled', false);
        return false;
    });
    $(document).on('click', '.leave-cancel-btn', function() {
        $(this).removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
        $(this).closest("div.leave-right").find(".leave-save-btn").remove();
        $(this).parent().parent().find("input").prop('disabled', true);
        return false;
    });

    $(document).on('change', '.leave-box .onoffswitch-checkbox', function() {
        var id = $(this).attr('id').split('_')[1];
        if ($(this).prop("checked") == true) {
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', false);
            $("#leave_" + id + " .leave-action .btn").prop('disabled', false);
        } else {
            $("#leave_" + id + " .leave-action .btn").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
            $("#leave_" + id + " .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', true);
        }
    });

    $('.leave-box .onoffswitch-checkbox').each(function() {
        var id = $(this).attr('id').split('_')[1];
        if ($(this).prop("checked") == true) {
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', false);
            $("#leave_" + id + " .leave-action .btn").prop('disabled', false);
        } else {
            $("#leave_" + id + " .leave-action .btn").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
            $("#leave_" + id + " .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', true);
        }
    });

    // Placeholder Hide

    if ($('.otp-input, .zipcode-input input, .noborder-input input').length > 0) {
        $('.otp-input, .zipcode-input input, .noborder-input input').focus(function() {
            $(this).data('placeholder', $(this).attr('placeholder'))
                .attr('placeholder', '');
        }).blur(function() {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });
    }

    // OTP Input

    if ($('.otp-input').length > 0) {
        $(".otp-input").keyup(function(e) {
            if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
                $(e.target).next('.otp-input').focus();
            } else if (e.which == 8) {
                $(e.target).prev('.otp-input').focus();
            }
        });
    }
    $(".links-info-discount").on('click','.service-trash-one', function () {
		$(this).closest('.links-cont-discount').remove();
		return false;
    });
   

    $(document).on("click",".add-links",function () {
		var experiencecontent = '<div class="links-cont">' +
			'<div class="service-amount">' +
				'<a href="#" class="service-trash"><i class="fe fe-minus-circle me-1"></i>Service Charge</a> <span>4</span' +
			'</div>' +
		'</div>';
		
        $(".links-info-one").append(experiencecontent);
        return false;
    });

     $(".links-info-discount").on('click','.service-trash-one', function () {
		$(this).closest('.links-cont-discount').remove();
		return false;
    });

    // Invoices Table Add More customize code soheb
	
    $(document).ready(function () {
        // Initially hide the remove button if only one row exists
        $(".remove-btn").hide();
    
        // Event handler for removing a row
        $(".add-table-items").on('click', '.remove-btn', function () {
            var row = $(this).closest('.add-row');
            row.remove();
    
            // Show or hide the remove button based on the number of rows
            if ($(".add-row").length > 1) {
                $(".remove-btn").show();
            } else {
                $(".remove-btn").hide();
            }
    
            // Recalculate totals after removing a row
            calculateTotal();
    
            return false;
        });
    
        // Event handler for adding a new row
        $(document).on("click", ".add-btns", function () {
            var rowCount = $(".add-row").length;
            var newRow = `<tr class="add-row">
                <td><input type="text" name="invoiceItems[${rowCount}][sr_no]" class="form-control"></td>
                <td><input type="text" name="invoiceItems[${rowCount}][description]" class="form-control"></td>
                <td><input type="text" name="invoiceItems[${rowCount}][rate]" oninput="calculateSubtotal(this)" name="rate" class="form-control rate"></td>
                <td><input type="number" name="invoiceItems[${rowCount}][quantity]" oninput="calculateSubtotal(this)" name="qty" value="1" min="1" class="form-control qty"></td>
                <td><input type="text" name="invoiceItems[${rowCount}][amount]" class="form-control subtotal"></td>
                <td class="add-remove text-end">
                    <a href="javascript:void(0);" class="add-btns me-2"><i class="fas fa-plus-circle"></i></a>
                    <a href="#" class="copy-btn me-2"><i class="fas fa-copy"></i></a>
                    <a href="javascript:void(0);" class="remove-btn" style="display: none;"><i class="fa fa-trash-alt"></i></a>
                </td>
            </tr>`;
    
            // Append the new row to the table
            $(".add-table-items").append(newRow);
    
            // Show the remove button if more than one row exists
            $(".remove-btn").show();
    
            // Recalculate totals after adding a new row
            calculateTotal();
    
            return false;
        });
    });
    $(document).on("click", ".add-links-one", function () {
        // Check if the GST content has already been added
        if (!$(".gst-added").length) {
            // Create the GST content
            var experiencecontent = '<div class="links-cont-discount gst-added">' + // Added 'gst-added' class to mark it
                '<div class="service-amount" style="position: relative;">' +
                    '<a href="#" class="service-trash-one"><i class="fa fa-minus-circle me-1"></i>TAX</a> <input class="form-control" style="width: 75px;position:absolute;right: -7px;" name="gst" id="tax" oninput="calculateTotal()" type="number" value="18"><span style="position: absolute;z-index: 1;right: 22px;font-size: 17px;">%</span>' +
                '</div>' +
                '<input class="form-check-input ms-2" type="radio" id="html" name="option_tax" value="gst" checked>GST' +
                '<input class="form-check-input ms-2" type="radio" id="html" name="option_tax" value="igst">IGST' +
                '<input class="form-check-input ms-2" type="radio" id="html" name="option_tax" value="vat">VAT' +
            '</div>';
            
            // Append the GST content only if it's not already present
            $(".links-info-discount").append(experiencecontent);
        }
        calculateTotal();
        return false;
    });
    $(".links-info-discount").on('click','.service-trash-one', function () {
        $(this).closest('.links-cont-discount').remove();
        calculateTotal();
        return false;
    });
    // Small Sidebar

    $(document).on('click', '#toggle_btn', function() {
        if ($('body').hasClass('mini-sidebar')) {
            $('body').removeClass('mini-sidebar');
            $('.subdrop + ul').slideDown();
        } else {
            $('body').addClass('mini-sidebar');
            $('.subdrop + ul').slideUp();
        }
        return false;
    });
    $(document).on('mouseover', function(e) {
        e.stopPropagation();
        if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar').length;
            if (targ) {
                $('body').addClass('expand-menu');
                $('.subdrop + ul').slideDown();
            } else {
                $('body').removeClass('expand-menu');
                $('.subdrop + ul').slideUp();
            }
            return false;
        }
    });

    $(document).on('click', '.top-nav-search .responsive-search', function() {
        $('.top-nav-search').toggleClass('active');
    });

    $(document).on('click', '#file_sidebar_toggle', function() {
        $('.file-wrap').toggleClass('file-sidebar-toggle');
    });

    $(document).on('click', '.file-side-close', function() {
        $('.file-wrap').removeClass('file-sidebar-toggle');
    });

    if ($('.kanban-wrap').length > 0) {
        $(".kanban-wrap").sortable({
            connectWith: ".kanban-wrap",
            handle: ".kanban-box",
            placeholder: "drag-placeholder"
        });
    }

});

// Loader

$(window).on('load', function() {
    $('#loader').delay(100).fadeOut('slow');
    $('#loader-wrapper').delay(500).fadeOut('slow');
});



/*tabs*/
var accordion = (function() {

    var $accordion = $('.crms-tasks');
    var $accordion_header = $accordion.find('.js-accordion-header');
    var $accordion_item = $('.js-accordion-item');

    // default settings 
    var settings = {
        // animation speed
        speed: 400,

        // close all other accordion items if true
        oneOpen: false
    };

    return {
        // pass configurable object literal
        init: function($settings) {
            $accordion_header.on('click', function() {
                accordion.toggle($(this));
            });

            $.extend(settings, $settings);

            // ensure only one accordion is active if oneOpen is true
            if (settings.oneOpen && $('.crms-task-item.active').length > 1) {
                $('.crms-task-item.active:not(:first)').removeClass('active');
            }

            // reveal the active accordion bodies
            $('.crms-task-item.active').find('> .js-accordion-body').show();
        },
        toggle: function($this) {

            if (settings.oneOpen && $this[0] != $this.closest('.crms-tasks').find('> .crms-task-item.active > .js-accordion-header')[0]) {
                $this.closest('.crms-tasks')
                    .find('> .crms-task-item')
                    .removeClass('active')
                    .find('.js-accordion-body')
                    .slideUp()
            }

            // show/hide the clicked accordion item
            $this.closest('.crms-task-item').toggleClass('active');
            $this.next().stop().slideToggle(settings.speed);
        }
    }
})();

$(document).ready(function() {
    accordion.init({
        speed: 300,
        oneOpen: true
    });
});



/*kanban view*/
$(function() {

    draggableInit();

    $('.panel-heading').on('click', function() {
        var $panelBody = $(this).parent().children('.panel-body');
        $panelBody.slideToggle();
    });
});

$(document).on("click",".add-links",function () {
    var experiencecontent = '<div class="links-info"><div class="row form-row links-cont">' +
            '<div class="form-group form-placeholder d-flex">' +
                '<button class="btn social-icon"><i class="feather-github"></i></button>' +
                '<input type="text" class="form-control" placeholder="Social Link">' +
                '<a href="#" class="btn trash">' +
                '<i class="feather-trash-2"></i>' +
                '</a>'+
            '</div>' +
        '</div>' +
    '</div>';
    
    $(".settings-form").append(experiencecontent);
    return false;
});
$(".settings-form").on('click','.trash', function () {
    $(this).closest('.links-cont').remove();
    return false;
});

$(document).on("click",".add-links1",function () {
    var experiencecontent = '<div class="links-cont">' +
        '<div class="service-amount">' +
            '<a href="#" class="service-trash1"><i class="fa fa-minus-circle me-1"></i>Service Charge</a> <span>$ 4</span' +
        '</div>' +
    '</div>';
    
    $(".links-info-one").append(experiencecontent);
    return false;
});
$(".links-info-one").on('click','.service-trash1', function () {
    $(this).closest('.links-cont').remove();
    return false;
});


 


// Invoices Table Add More
	
// $(".add-table-items").on('click','.remove-btn', function () {
//     $(this).closest('.add-row').remove();
//     return false;
// });

// $(document).on("click",".add-btn",function () {
//     var experiencecontent = '<tr class="add-row">' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td>' +
//             '<input type="text" class="form-control">' +
//         '</td>' +
//         '<td class="add-remove text-end">' +
//             '<a href="javascript:void(0);" class="add-btn me-2"><i class="fas fa-plus-circle"></i></a> ' +
//             '<a href="#" class="copy-btn me-2"><i class="fe fe-copy"></i></a>' +
//             '<a href="javascript:void(0);" class="remove-btn"><i class="fe fe-trash-2"></i></a>' +
//         '</td>' +
//     '</tr>';
    
//     $(".add-table-items").append(experiencecontent);
//     return false;
// });
// Checkbox Select
	
$('.app-listing .selectBox').on("click", function() {
    $(this).parent().find('#checkBoxes').fadeToggle();
    $(this).parent().parent().siblings().find('#checkBoxes').fadeOut();
});

$('.invoices-main-form .selectBox').on("click", function() {
    $(this).parent().find('#checkBoxes-one').fadeToggle();
    $(this).parent().parent().siblings().find('#checkBoxes-one').fadeOut();
});

//Checkbox Select

if($('.SortBy').length > 0) {
    var show = true;
    var checkbox1 = document.getElementById("checkBox");
    $('.selectBoxes').on("click", function() {
        
        if (show) {
            checkbox1.style.display = "block";
            show = false;
        } else {
            checkbox1.style.display = "none";
            show = true;
        }
    });		
}

// Invoices Checkbox Show

$(function() {
    $("input[name='invoice']").click(function() {
        if ($("#chkYes").is(":checked")) {
            $("#show-invoices").show();
        } else {
            $("#show-invoices").hide();
        }
    });
});

    // page theme color  
    
    if($('.themecls').length > 0) {
        const toggleSwitch = document.querySelector('.theme-changes span');
        const currentTheme = localStorage.getItem('theme');
        var app = document.getElementsByClassName("themecls")[0];
        if (currentTheme) {
            app.href = "assets/css/"+currentTheme+".css";
        }
        function toggleTheme(e) {
            app.href = "assets/css/"+e+".css";
            localStorage.setItem('theme', e);
        }
    
    }
    $(document).ready(function() {
        //your own JS code here
        document.getElementsByClassName("main-wrapper")[0].style.visibility = "visible";
    });

function draggableInit() {
    var sourceId;

    $('[draggable=true]').bind('dragstart', function(event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body').bind('dragover', function(event) {
        event.preventDefault();
    });

    $('.panel-body').bind('drop', function(event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle'); //before post


            // Post data 
            setTimeout(function() {
                var element = document.getElementById(elementId);
                children.prepend(element);
                $('#processing-modal').modal('toggle'); // after post
            }, 1000);

        }

        event.preventDefault();
    });

     // Popover
	if($('.popover-list').length > 0) {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl)
		})
	}
    // Counter 
	
	if($('.counter').length > 0) {
        $('.counter').counterUp({
             delay: 20,
             time: 2000
        });
     }
     
     if($('#timer-countdown').length > 0) {
         $( '#timer-countdown' ).countdown( {
             from: 180, // 3 minutes (3*60)
             to: 0, // stop at zero
             movingUnit: 1000, // 1000 for 1 second increment/decrements
             timerEnd: undefined,
             outputPattern: '$day Day $hour : $minute : $second',
             autostart: true
         });
     }
     
     if($('#timer-countup').length > 0) {
         $( '#timer-countup' ).countdown( {
             from: 0,
             to: 180 
         });
     }
     
     if($('#timer-countinbetween').length > 0) {
         $( '#timer-countinbetween' ).countdown( {
             from: 30,
             to: 20 
         });
     }
     
     if($('#timer-countercallback').length > 0) {
         $( '#timer-countercallback' ).countdown( {
             from: 10,
             to: 0,
             timerEnd: function() {
                 this.css( { 'text-decoration':'line-through' } ).animate( { 'opacity':.5 }, 500 );
             } 
         });
     }
     
     if($('#timer-outputpattern').length > 0) {
         $( '#timer-outputpattern' ).countdown( {
             outputPattern: '$day Days $hour Hour $minute Min $second Sec..',
             from: 60 * 60 * 24 * 3
         });
     }
    
}

 // search and pagegination
    
 $(document).ready(function() {
    const rowsPerPage = 10; // Number of rows to display per page
    let currentPage = 1;
    const $tableBody = $('.mydata-table tbody');
    let $rows = $tableBody.find('tr');
    let totalPages = Math.ceil($rows.length / rowsPerPage);

    // Function to render the table based on the current page
    function renderTable() {
        $rows.hide();
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        $rows.slice(start, end).show();
    }

    // Function to render pagination controls
function renderPagination() {
    $('.mypagination').empty();

    // Add left arrow button (go to previous page)
    $('.mypagination').append(
        `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" aria-label="Previous" data-page="${currentPage - 1}">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>`
    );

    // Add page numbers
    for (let i = 1; i <= totalPages; i++) {
        $('.mypagination').append(
            `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
             </li>`
        );
    }

    // Add right arrow button (go to next page)
    $('.mypagination').append(
        `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" aria-label="Next" data-page="${currentPage + 1}">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>`
    );
}

// Function to update the table and pagination
function updateTable() {
    renderTable();       // Assuming you have a function to render your table
    renderPagination();  // Render pagination controls
}

// Event listener for pagination click
$('.mypagination').on('click', 'a', function(event) {
    event.preventDefault();
    
    let newPage = $(this).data('page');

    // If the newPage is within the valid range, update the current page
    if (newPage > 0 && newPage <= totalPages) {
        currentPage = newPage;
        updateTable(); // Update table and pagination
    }
});


    // Event listener for search input
    $('.my-search-input').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase().trim();
        $rows.each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(searchTerm));
        });

        // Update pagination based on search results
        $rows = $tableBody.find('tr:visible');
        totalPages = Math.ceil($rows.length / rowsPerPage);
        currentPage = 1; // Reset to the first page
        updateTable();
    });

    // Initial table render
    updateTable();
});

 // password hide and show
 $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
  });
//   select2
        // $(".single").select2({
        //     placeholder: "",
        //     allowClear: true
        // });
// input tag name

//skill start
var inputArea = $("#skillsInput"),
tagArea = $(".tags"),
tag, data, close, skills = [];

// Handle adding new skills dynamically when typing in the input field
$(inputArea).on("change", function() {
    data = $(this).val().trim(); // Get the entered value
    // Only add if there's a new skill entered
    if (data) {
        // Prevent adding duplicate skills // pr add if 23-9-25
        if (!skills.includes(data)) { 
            // Create the skill tag element
            tag = $("<span class='tag'>" + data + "</span>").appendTo(tagArea);
            close = $("<span class='fa fa-close'></span>").appendTo(tag);
            
            // Add skill to array
            skills.push(data);
            
            // Update hidden input with skills array as JSON
            $("#skills").val(JSON.stringify(skills));

            close.on("click", function() {
                var index = skills.indexOf($(this).parent().text());  // Use the actual skill text for removal
                if (index > -1) {
                    skills.splice(index, 1); // Remove the skill from the array
                    $("#skills").val(JSON.stringify(skills)); // Update JSON data
                }
                $(this).parent().remove();  // Remove the tag element
            });
        }
        $(this).val("");  // Clear the input field
    }
});

// Validation before form submission
$("#ManagerCreate").on("submit", function(e) {
    if (skills.length === 0) {
        e.preventDefault();
        $("#error-msg").text("Please add some skills!");
    }
});
$("#ResourceCreate").on("submit", function(e) {
    if (skills.length === 0) {
        e.preventDefault();
        $("#error-msg").text("Please add some skills!");
    }
});
//end skills 
// input tag name end
// document create new project
// $(document).ready(function() {
//     var createDt = new DataTransfer();  // DataTransfer for the create form
//     var updateDtMap = {};  // DataTransfer map for update forms, keyed by project ID
//     var fetchedDocumentsMap = {};  // To store the existing documents for each project

//     // ----------- CREATE DOCUMENT HANDLING ----------- //
//     $("#attachment").on('change', function(e) {
//         handleFileChange(this, createDt, "#filesList > #files-names", "#file-count", true);
//     });

//     // ----------- UPDATE DOCUMENT HANDLING ----------- //
//     $("input[id^=updateattachment-]").on('change', function(e) {
//         // Select the current file input using the dynamic ID
//         var projectId = $(this).attr('id').split('-')[1];  // Extract the project ID

//         if (!updateDtMap[projectId]) {
//             updateDtMap[projectId] = new DataTransfer();  // Initialize DataTransfer for this project if not present
//         }

//         handleFileChange(this, updateDtMap[projectId], `#filesList-${projectId} > #files-names-update-${projectId}`, `#file-count-update-${projectId}`, false);
//     });

//     // Shared function to handle file selection for both create and update forms
//     function handleFileChange(input, dt, filesListSelector, fileCountSelector, isCreate) {
//         var filesList = $(filesListSelector);

//         // Add new files to DataTransfer object without overriding old ones
//         for (var i = 0; i < input.files.length; i++) {
//             dt.items.add(input.files[i]);
//         }

//         // Clear and repopulate the file list with the files from DataTransfer
//         filesList.empty();
//         for (let i = 0; i < dt.items.length; i++) {
//             let fileBloc = $('<span/>', { class: 'file-block' }),
//                 fileName = $('<span/>', { class: 'name', text: dt.items[i].getAsFile().name });

//             fileBloc.append('<span class="file-delete"><span>+</span></span>')
//                     .append(fileName);

//             filesList.append(fileBloc);
//         }

//         // Update the input's files to match DataTransfer using the utility function
//         input.files = getFileListFromDataTransfer(dt);
//         console.log(input.files);

//         // Update file count display
//         updateFileCount(dt.items.length, fileCountSelector);

//         // Bind delete functionality to the newly added files
//         bindDeleteFunctionality(dt, filesListSelector, input, fileCountSelector, isCreate);
//     }

//     // Bind delete functionality to file delete buttons
//     function bindDeleteFunctionality(dt, filesListSelector, input, fileCountSelector, isCreate) {
//         $(filesListSelector).find('span.file-delete').off('click').on('click', function() {
//             let name = $(this).next('span.name').text();

//             // Remove the file block visually
//             $(this).parent().remove();

//             // Remove the file from the DataTransfer object
//             for (let i = 0; i < dt.items.length; i++) {
//                 if (name === dt.items[i].getAsFile().name) {
//                     dt.items.remove(i);
//                     break;
//                 }
//             }

//             // Update the input files after removal
//             input.files = getFileListFromDataTransfer(dt);

//             // Update the file count display
//             updateFileCount(dt.items.length, fileCountSelector);
//         });
//     }

//     // Function to update the file count display
//     function updateFileCount(count, fileCountSelector) {
//         var filesCountText = count > 0 ? count + " files selected" : "No files selected";
//         $(fileCountSelector).text(filesCountText);
//     }

//     // ----------- FETCH EXISTING DOCUMENTS FOR UPDATE ----------- //
//     $('.projectUpdatedoc').on('click', function(e) {
//         var projectId = $(this).data('id');  // Extract project ID
//         clearPreviousUpdateData(projectId);  // Reset previous data for the specific project
//         fetchProjectDocuments(projectId);    // Fetch existing project documents
//     });

//     function fetchProjectDocuments(projectId) {
//         $.ajax({
//             url: '/admin/projects/' + projectId + '/documents',  // Your route to fetch documents
//             method: 'GET',
//             success: function(response) {
//                 fetchedDocumentsMap[projectId] = response.documents;  // Store fetched documents for the project
//                 displayExistingDocuments(fetchedDocumentsMap[projectId], updateDtMap[projectId], `#filesList-${projectId} > #files-names-update-${projectId}`, projectId);
//             },
//             error: function(err) {
//                 console.error('Error fetching documents:', err);
//             }
//         });
//     }

//     // Display the fetched documents in the update form
//     function displayExistingDocuments(documents, dt, filesListSelector, projectId) {
//         var filesList = $(filesListSelector);
//         filesList.empty();  // Clear any existing files

//         if (documents.length > 0) {
//             documents.forEach(function(document) {
//                 var fileName = decodeURIComponent(document.split('/').pop());  // Get file name

//                 let fileBloc = $('<span/>', { class: 'file-block' }),
//                     fileNameSpan = $('<span/>', { class: 'name', text: fileName });

//                 fileBloc.append('<span class="file-delete"><span>+</span></span>')
//                         .append(fileNameSpan);

//                 filesList.append(fileBloc);

//                 // Simulate adding fetched files to DataTransfer
//                 let file = new File([fileName], fileName);
//                 dt.items.add(file);  // Add the document to DataTransfer object
//             });

//             // Update the input to reflect fetched documents
//             document.getElementById(`updateattachment-${projectId}`).files = getFileListFromDataTransfer(dt);

//             // Bind delete functionality to the existing files
//             bindDeleteFunctionality(dt, filesListSelector, document.getElementById(`updateattachment-${projectId}`), `#file-count-update-${projectId}`, false);

//             // Update file count for the update form
//             updateFileCount(dt.items.length, `#file-count-update-${projectId}`);
//         } else {
//             filesList.append('<p>No documents found.</p>');
//         }
//     }

//     // Clear the previous data before opening a new update form
//     function clearPreviousUpdateData(projectId) {
//         updateDtMap[projectId] = new DataTransfer();  // Clear DataTransfer for the project
//         $(`#files-names-update-${projectId}`).empty();  // Clear file display area
//         $(`#updateattachment-${projectId}`).val('');    // Clear the file input field
//         $(`#file-count-update-${projectId}`).text('No files selected');  // Reset file count
//     }

//     // Utility function to create a FileList from DataTransfer
//     function getFileListFromDataTransfer(dataTransfer) {
//         const filesArray = Array.from(dataTransfer.items).map(item => item.getAsFile());
//         return createFileList(filesArray);
//     }

//     // Create a custom FileList
//     function createFileList(files) {
//         const dataTransfer = new DataTransfer();
//         files.forEach(file => dataTransfer.items.add(file));
//         return dataTransfer.files;
//     }
// });
$(document).ready(function() {
    var createDt = new DataTransfer();  // DataTransfer for the create form
    var updateDtMap = {};  // DataTransfer map for update forms, keyed by project ID
    var fetchedDocumentsMap = {};  // To store the existing documents for each project

    // ----------- CREATE DOCUMENT HANDLING ----------- //
    $("#attachment").on('change', function(e) {
        handleFileChange(this, createDt, "#filesList > #files-names", "#file-count", true);
    });

    // ----------- UPDATE DOCUMENT HANDLING ----------- //
    $("input[id^=updateattachment-]").on('change', function(e) {
        // Select the current file input using the dynamic ID
        var projectId = $(this).attr('id').split('-')[1];  // Extract the project ID

        if (!updateDtMap[projectId]) {
            updateDtMap[projectId] = new DataTransfer();  // Initialize DataTransfer for this project if not present
        }

        handleFileChange(this, updateDtMap[projectId], `#filesList-${projectId} > #files-names-update-${projectId}`, `#file-count-update-${projectId}`, false);
    });

    // Shared function to handle file selection for both create and update forms
    function handleFileChange(input, dt, filesListSelector, fileCountSelector, isCreate) {
        var filesList = $(filesListSelector);

        // Add new files to DataTransfer object without overriding old ones
        for (var i = 0; i < input.files.length; i++) {
            dt.items.add(input.files[i]);
        }

        // Clear and repopulate the file list with the files from DataTransfer
        filesList.empty();
        for (let i = 0; i < dt.items.length; i++) {
            let fileBloc = $('<span/>', { class: 'file-block' }),
                fileName = $('<span/>', { class: 'name', text: dt.items[i].getAsFile().name });

            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                    .append(fileName);

            filesList.append(fileBloc);
        }

        // Update the input's files to match DataTransfer using the utility function
        input.files = getFileListFromDataTransfer(dt);
        console.log(input.files);

        // Update file count display
        updateFileCount(dt.items.length, fileCountSelector);

        // Bind delete functionality to the newly added files
        bindDeleteFunctionality(dt, filesListSelector, input, fileCountSelector, isCreate);
    }

    // Bind delete functionality to file delete buttons
    function bindDeleteFunctionality(dt, filesListSelector, input, fileCountSelector, isCreate) {
        $(filesListSelector).find('span.file-delete').off('click').on('click', function() {
            let name = $(this).next('span.name').text();

            // Remove the file block visually
            $(this).parent().remove();

            // Remove the file from the DataTransfer object
            for (let i = 0; i < dt.items.length; i++) {
                if (name === dt.items[i].getAsFile().name) {
                    dt.items.remove(i);
                    break;
                }
            }

            // Update the input files after removal
            input.files = getFileListFromDataTransfer(dt);

            // Update the file count display
            updateFileCount(dt.items.length, fileCountSelector);
        });
    }

    // Function to update the file count display
    function updateFileCount(count, fileCountSelector) {
        var filesCountText = count > 0 ? count + " files selected" : "No files selected";
        $(fileCountSelector).text(filesCountText);
    }

    // ----------- FETCH EXISTING DOCUMENTS FOR UPDATE ----------- //
    // $(document).on('click', -pr change 17-7-25
    $(document).on('click', '.projectUpdatedoc', function() {
        var projectId = $(this).data('id');  // Extract project ID
        clearPreviousUpdateData(projectId);  // Reset previous data for the specific project
        fetchProjectDocuments(projectId, 'admin');    // Fetch existing project documents
    });

    // this is for resource as project manager new -pr 22-7-25
    $(document).on('click', '.projectUpdatedocPM', function() {
        var projectId = $(this).data('id');  // Extract project ID
        clearPreviousUpdateData(projectId);  // Reset previous data for the specific project
        fetchProjectDocuments(projectId, 'resource');    // Fetch existing project documents
    });

    function fetchProjectDocuments(projectId, role) {
        $.ajax({
            url: '/'+ role +'/projects/' + projectId + '/documents',  // Your route to fetch documents
            method: 'GET',
            success: function(response) {
                fetchedDocumentsMap[projectId] = response.documents;  // Store fetched documents for the project
                displayExistingDocuments(fetchedDocumentsMap[projectId], updateDtMap[projectId], `#filesList-${projectId} > #files-names-update-${projectId}`, projectId);
            },
            error: function(err) {
                console.error('Error fetching documents:', err);
            }
        });
    }

    // Display the fetched documents in the update form
    function displayExistingDocuments(documents, dt, filesListSelector, projectId) {
        var filesList = $(filesListSelector);
        filesList.empty();  // Clear any existing files

        if (documents.length > 0) {
            documents.forEach(function(document) {
                var fileName = decodeURIComponent(document.split('/').pop());  // Get file name

                let fileBloc = $('<span/>', { class: 'file-block' }),
                    fileNameSpan = $('<span/>', { class: 'name', text: fileName });

                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                        .append(fileNameSpan);

                filesList.append(fileBloc);

                // Simulate adding fetched files to DataTransfer
                let file = new File([fileName], fileName);
                dt.items.add(file);  // Add the document to DataTransfer object
            });

            // Update the input to reflect fetched documents
            document.getElementById(`updateattachment-${projectId}`).files = getFileListFromDataTransfer(dt);

            // Bind delete functionality to the existing files
            bindDeleteFunctionality(dt, filesListSelector, document.getElementById(`updateattachment-${projectId}`), `#file-count-update-${projectId}`, false);

            // Update file count for the update form
            updateFileCount(dt.items.length, `#file-count-update-${projectId}`);
        } else {
            filesList.append('<p>No documents found.</p>');
        }
    }

    // Clear the previous data before opening a new update form
    function clearPreviousUpdateData(projectId) {
        updateDtMap[projectId] = new DataTransfer();  // Clear DataTransfer for the project
        $(`#files-names-update-${projectId}`).empty();  // Clear file display area
        $(`#updateattachment-${projectId}`).val('');    // Clear the file input field
        $(`#file-count-update-${projectId}`).text('No files selected');  // Reset file count
    }

    // Utility function to create a FileList from DataTransfer
    function getFileListFromDataTransfer(dataTransfer) {
        const filesArray = Array.from(dataTransfer.items).map(item => item.getAsFile());
        return createFileList(filesArray);
    }

    // Create a custom FileList
    function createFileList(files) {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        return dataTransfer.files;
    }
});




// project enter detels end
// add search input
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('.addexamplesearch')) {
        $('.addexamplesearch').DataTable().destroy();  // Destroy the existing table
    }
    $('.addexamplesearch').DataTable({
        "buttons": []
    });
});

// add search end 
//milestone fetch
    let projectSelect = document.getElementById('projectselectmil');
    let projectSelectPM = document.getElementById('projectselectmilPM'); // this is for resource as project manager new -pr 22-7-25
    if (projectSelect) {
        projectSelect.addEventListener('change', function () {
            let projectId = this.value;
            milestoneTable(projectId, 'admin');
        });
    } else if (projectSelectPM) {
        projectSelectPM.addEventListener('change', function () {
            let projectId = this.value;
            milestoneTable(projectId, 'resource');
        });
    }
// this is dynamic function for fetch new -pr 22-7-25
function milestoneTable(projectId, role) {
    if (projectId) {
        fetch(`/${role}/projects/${projectId}/milestones`) // Updated URL with 'admin' prefix
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('milestone-table');
                let tbody = document.querySelector('#milestone-table tbody');
                let milestoneDate = document.getElementById('milestoneDateCreate'); // pr new 9-9-25
                let forecastingDate = document.getElementById('forecastingDateCreate'); // pr new 9-9-25
                let rows = '';
                data.milestones.forEach(function (milestone) {
                    rows += `
                        <tr>
                            <td class="text-center">${milestone.id}</td>
                            <td class="text-center">${milestone.milestone_name}</td>
                            <td class="text-center">${milestone.milestone_date}</td>
                            <td class="text-center">${milestone.forecasting_date || 'N/A'}</td>
                            <td class="text-center">${milestone.status}</td>
                            <td class="text-center">${milestone.description}</td>
                        </tr>
                    `;
                });
                
                // 1. Destroy DataTable if already initialized
                if ($.fn.DataTable.isDataTable(table)) {
                    $(table).DataTable().destroy();
                }

                // 2. Set table body content
                tbody.innerHTML = rows;

                // 3. Initialize DataTable
                $(table).DataTable({
                    buttons: []
                });

                document.getElementById('milestone-section').style.display = 'block';
                // pr new 9-9-25
                milestoneDate.min = data.project.start_date;
                milestoneDate.max = data.project.end_date;
                forecastingDate.min = data.project.start_date;
                forecastingDate.max = data.project.end_date;

                milestoneDate.disabled = false;
                forecastingDate.disabled = false;
                // /pr
            })
            .catch(error => console.error('Error fetching milestones:', error));
    }
}

//end milestone fetch
// task create
// forem fild auto open
//  $(document).ready(function() {
//         var milestones = {
//         'quantum-tech': [
//             { value: 'qt-milestone1', text: 'Quantum Tech Milestone 1' },
//             { value: 'qt-milestone2', text: 'Quantum Tech Milestone 2' }
//         ],
//         'dental': [
//             { value: 'dental-milestone1', text: 'Dental Milestone 1' },
//             { value: 'dental-milestone2', text: 'Dental Milestone 2' }
//         ],
//         'vivek-info': [
//             { value: 'vivek-milestone1', text: 'Vivek Info Milestone 1' },
//             { value: 'vivek-milestone2', text: 'Vivek Info Milestone 2' }
//         ]
//     };

//     $('#projectSelect').change(function() {
//         var selectedProject = $(this).val();

//         // Clear the milestone dropdown
//         $('#milestonesDropdown').empty().append('<option value="">Select milestone</option>');

//         if (selectedProject && milestones[selectedProject]) {
//             // Populate milestones based on the selected project
//             milestones[selectedProject].forEach(function(milestone) {
//                 $('#milestonesDropdown').append(
//                     $('<option></option>').val(milestone.value).text(milestone.text)
//                 );
//             });

//             // Enable the Milestones dropdown
//             $('#milestonesDropdown').prop('disabled', false);
//         } else {
//             // Disable the Milestones dropdown if no project is selected
//             $('#milestonesDropdown').prop('disabled', true);
//         }
//     });
// });
// task creat end



// assigne resource 
$(document).ready(function() {
    // Task data based on the selected project
    var tasks = {
        'quantum-tech': [
            { value: 'task1', text: 'Quantum Tech Task 1' },
            { value: 'task2', text: 'Quantum Tech Task 2' }
        ],
        'dental': [
            { value: 'task1', text: 'Dental Task 1' },
            { value: 'task2', text: 'Dental Task 2' }
        ],
        'vivek-info': [
            { value: 'task1', text: 'Vivek Info Task 1' },
            { value: 'task2', text: 'Vivek Info Task 2' }
        ]
    };

    // Event listener for project selection
    $('#projectSelectresource').change(function() {
        var selectedProject = $(this).val();

        // Clear the task dropdown
        $('#taskSelect').empty().append('<option value="" disabled selected>Select Task</option>');

        if (selectedProject && tasks[selectedProject]) {
            // Populate tasks based on the selected project
            tasks[selectedProject].forEach(function(task) {
                $('#taskSelect').append(
                    $('<option></option>').val(task.value).text(task.text)
                );
            });

            // Enable the task dropdown
            $('#taskSelect').prop('disabled', false);
        } else {
            // Disable the task dropdown if no project is selected
            $('#taskSelect').prop('disabled', true);
        }
    });
});


// resours create form

           // number
        $(document).ready(function() {
            function getIp(callback) {
                $.ajax({
                    url: 'https://ipinfo.io?token=66e2f39b20a2bd',
                    dataType: 'json',
                    success: function(resp) {
                        callback(resp.country);
                    },
                    error: function() {
                        callback('in');  // Default to India if IP lookup fails
                    }
                });
            }
        
            getIp(function(countryCode) {
                $(".phone").each(function() {
                    var phoneInputField = this;  // Get the DOM element for each class
                    var iti = window.intlTelInput(phoneInputField, {
                        initialCountry: countryCode, // Set initial country based on IP lookup
                        separateDialCode: true,      // Show dial code separately
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    });
        
                    if (iti) {
                        console.log("intlTelInput initialized for:", phoneInputField);
                    } else {
                        console.error("intlTelInput failed to initialize.");
                    }
        
                    // On form submission, append the country dial code to the phone number
                    $(this).closest('form').on('submit', function(e) {
                        var fullPhoneNumber = iti.getNumber();  // Get the full phone number with country code
                        console.log("Full phone number:", fullPhoneNumber);  // Log the full phone number to check if it is being fetched correctly
                        $(phoneInputField).val(fullPhoneNumber);  // Set the full phone number (with country code) in the input field
                    });
                });
            });
        });
        
        
        // invoice sign image uplode
        $(document).ready(function(){
            $('input[type="file"]').on('change', function() {
                // Check if any files are selected
                if(this.files.length > 0) {
                    // Hide the span
                    $(this).siblings('span').hide();
        
                    // Clear any previous images in the preview div
                    $('#image-preview').empty();
        
                    // Loop through each selected file
                    for(let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
        
                        // Only process image files
                        if(file.type.startsWith('image/')) {
                            const reader = new FileReader();
        
                            // Set up the onload event to display the image once it's read
                            reader.onload = function(e) {
                                // Append the image to the preview div
                                $('#image-preview').append('<img src="' + e.target.result + '" alt="Image Preview" width="100" style="margin: 10px;">');
                            }
        
                            // Read the image file as a data URL
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });
        });
        // invoice sing image end

   // user image uplode
function displaySelectedImage(event, imageId) {
    const file = event.target.files[0]; // Get the selected file
    const imageElement = document.getElementById(imageId);

    // Validate the file type
    if (file && file.type.match('image.*')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imageElement.src = e.target.result; // Update the image source
        }
        reader.readAsDataURL(file); // Read the file as a Data URL
    } else {
        // Reset to default image if no valid file is selected
        imageElement.src = '/assets/img/user_profile.png';
    }
}  
setTimeout(function() {
    // Hide the success message after 5 seconds
    document.getElementById('success-alert')?.remove();
    document.getElementById('error-alert')?.remove();
}, 5000); // 5000ms = 5 seconds

//return vendor data in update form
$(document).on('click', '.edit-vendor', function () {
    var vendorId = $(this).data('id');
    
    $.ajax({
        url: '/admin/users/vendors/index/' + vendorId + '/edit', // Fetch customer data
        method: 'GET',
        success: function (response) {
            // Fill the form fields with existing customer data
            $('#edit-form-vendors input[name="first_name"]').val(response.first_name);
            $('#edit-form-vendors input[name="last_name"]').val(response.last_name);
            $('#edit-form-vendors input[name="email"]').val(response.email);
            $('#edit-form-vendors input[name="national_id"]').val(response.national_id);
            $('#edit-form-vendors textarea[name="address"]').val(response.address);
            $('#edit-form-vendors input[name="company_name"]').val(response.company_name);
            $('#edit-form-vendors input[name="bank_account_no"]').val(response.bank_account_no);
            $('#edit-form-vendors input[name="account_holder_name"]').val(response.account_holder_name);
            $('#edit-form-vendors input[name="branch_name"]').val(response.branch_name);
            $('#edit-form-vendors input[name="bank_name"]').val(response.bank_name);
            $('#edit-form-vendors input[name="pan_number"]').val(response.pan_number);
            $('#edit-form-vendors input[name="Tax_number"]').val(response.Tax_number);
            $('#edit-form-vendors select[name="status"]').val(response.status);
            $('#edit-form-vendors select[name="code_type"]').val(response.code_type);
            $('#edit-form-vendors input[name="ifsc_code"]').val(response.ifsc_code);
            $('#edit-form-vendors input[name="swift_code"]').val(response.swift_code);
            $('#edit-form-vendors input[name="website"]').val(response.website);
            if (response.profile_picture && response.profile_picture !== 'null' && response.profile_picture !== '') {
                $('#selectedAvatar').attr('src', '/uploads/vendors/' + response.profile_picture);
            } else {
                $('#selectedAvatar').attr('src', '/assets/img/user_profile.png');
            }
            // Update form action to reflect vendor ID
             $('#edit-form-vendors form').attr('action', '/admin/users/vendors/index/' + vendorId);

            // Now initialize intlTelInput after vendor data is populated
            initializePhoneVendorNumberInput(response.phone_number); // Call function to initialize phone number input

            // pr 22-9-25
            codeTypeChange(response.code_type);
        },
        error: function () {
            alert('Failed to fetch customer data');
        }
    });
});
function initializePhoneVendorNumberInput(phoneNumber) {
    getIp(function(countryCode) {
        $(".Vphone").each(function() {
            var phoneInputField = this;  // Get the DOM element for the phone input

            // Check if intlTelInput is already initialized
            if (typeof phoneInputField.intlTelInputInstance !== "undefined") {
                // Destroy the previous instance if it exists
                phoneInputField.intlTelInputInstance.destroy();
            }

            // Initialize intlTelInput
            var iti = window.intlTelInput(phoneInputField, {
                initialCountry: countryCode, // Set initial country based on IP lookup
                separateDialCode: true,      // Show dial code separately
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            // Store the instance on the DOM element for later use
            phoneInputField.intlTelInputInstance = iti;

            // Set the phone number received from the server (with country code)
            if (phoneNumber) {
                iti.setNumber(phoneNumber); // Set full phone number in intlTelInput
            } else {
                // If no phone number is provided, default to India
                iti.setNumber('+91'); // Set default number with India's country code
            }

            // On form submission, append the full phone number with country code
            $(this).closest('form').on('submit', function(e) {
                var fullPhoneNumber = iti.getNumber();  // Get the full phone number with country code
                console.log("Full phone number:", fullPhoneNumber);  // Log for debugging
                $(phoneInputField).val(fullPhoneNumber);  // Set the full phone number in the input field
            });
        });
    });
}
/*Project manager crud start */
    // project manager single view show 
    $(document).on('click', '.view-PM', function() {
        var PMId = $(this).data('id');
        
        // Make an AJAX request to fetch customer data
        $.ajax({
            url: '/admin/users/ProjectManager/index/' + PMId, // Adjust the URL to your route
            type: 'GET',
            success: function(data) {
                // Populate modal with the customer data
                if (data.profile_picture) {
                    $('#PM-details-modal .vendor-avatar').attr('src', '/uploads/ProjectManager/' + data.profile_picture);
                } else {
                    $('#PM-details-modal .vendor-avatar').attr('src', '/assets/img/user_profile.png');  // Default photo
                }
                $('#PM-details-modal .modal-title').text(data.first_name + ' ' + data.last_name);
                $('#PM-details-modal .PM-id').text(data.id);
                $('#PM-details-modal .PM-email').text(data.email);
                $('#PM-details-modal .PM-nationalID').text(data.national_id);
                $('#PM-details-modal .PM-phone').text(data.phone_number);
                $('#PM-details-modal .PM-address').text(data.address);
                $('#PM-details-modal .pan-no').text(data.pan_number);
                $('#PM-details-modal .birth-date').text(data.birth_date);
                $('#PM-details-modal .PT').text(data.payment_type);
                $('#PM-details-modal .rate-cost').text(data.rate);
                $('#PM-details-modal .username').text(data.username);
                let skillsArray;

                // If the data is a string and looks like JSON, try parsing it
                if (typeof data.skills === 'string') {
                    try {
                        // First attempt to parse the string as JSON
                        skillsArray = JSON.parse(data.skills);

                        // If parsing does not return an array, manually process the string
                        if (!Array.isArray(skillsArray)) {
                            // Replace any unnecessary characters and split the string by commas
                            skillsArray = data.skills
                                .replace(/[\[\]\"]/g, '')  // Remove brackets and quotes
                                .split(',');               // Split the string into an array
                        }

                        // Remove any backslashes if present
                        skillsArray = skillsArray.map(function(skill) {
                            return skill.trim().replace(/\\/g, '');  // Trim and remove backslashes
                        });

                        console.log("Parsed skills:", skillsArray);  // Log the parsed result
                    } catch (error) {
                        console.error("Error parsing skills:", error);
                        return;  // Stop further execution in case of error
                    }
                }

                // If skillsArray is valid and an array, join the elements
                if (Array.isArray(skillsArray)) {
                    $('#PM-details-modal .skill').text(skillsArray.join(', '));
                } else {
                    $('#PM-details-modal .skill').text('Invalid format for skills.');
                }
                //$('#PM-details-modal .skill').text(data.skills);
                $('#PM-details-modal .status').text(data.status);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " " + error);
                // Optionally show an error message in the modal
            }
        });
    });
     
    //end project manager single view show

    //update project Manager
    $(document).ready(function () {
        var inputArea = $("#UpdateskillsInput"),
            tagArea = $(".tags.clear"),  // Change this to select the correct tag container
            skills = []; // Array to store the skills
    
        // Function to populate skills when editing the form
        function populateSkills(responseSkills) {
            tagArea.empty(); // Clear any existing tags
            skills = []; // Clear the skills array
    
            // Check if responseSkills is a string and attempt to parse it
            if (typeof responseSkills === "string") {
                try {
                    // Try to parse the string as JSON
                    var skillsArray = JSON.parse(responseSkills);
    
                    // If parsing doesn't return an array, manually split the string
                    if (!Array.isArray(skillsArray)) {
                        skillsArray = responseSkills
                            .replace(/[\[\]\"]/g, '') // Remove brackets and quotes
                            .split(','); // Split the string into an array
                    }
                } catch (error) {
                    console.error("Error parsing skills:", error);
                    return; // Stop if there is a parsing error
                }
            }
    
            // Clean up the skills array: trim and remove any backslashes
            skillsArray = skillsArray.map(function (skill) {
                return skill.trim().replace(/\\/g, '');
            });
    
            // Check if the array is valid, then add each skill as a tag
            if (Array.isArray(skillsArray)) {
                skillsArray.forEach(addSkillTag);
            } else {
                console.error("Invalid format for skills.");
            }
        }
    
        // Function to add a new skill tag dynamically
        function addSkillTag(skill) {
            if (!skills.includes(skill)) {
                // Create the skill tag element
                var tag = $("<span class='tag'>" + skill + "</span>").appendTo(tagArea);
                var close = $("<span class='fa fa-close'></span>").appendTo(tag);
    
                // Add the skill to the array
                skills.push(skill);
    
                // Update the hidden input with the skills as a JSON string
                $("#Updateskills").val(JSON.stringify(skills));
    
                // Event to remove the skill when clicking the close button
                close.on("click", function () {
                    var index = skills.indexOf(skill);
                    if (index > -1) {
                        skills.splice(index, 1); // Remove from the array
                        $("#Updateskills").val(JSON.stringify(skills)); // Update the hidden input
                    }
                    tag.remove(); // Remove the tag element
                });
            }
        }
    
        // Add new skills when the input field changes
        inputArea.on("change", function () {
            var data = $(this).val().trim(); // Get the entered value
    
            // Only add if the field is not empty
            if (data) {
                addSkillTag(data); // Add the new skill
                $(this).val(""); // Clear the input field
            }
        });
    
        // Fetch the skills when the edit form is shown
        $('#edit-form-PM').on('show.bs.modal', function (e) {
            // Clear any existing data when showing the modal
            $("#error-msg").text(""); 
            inputArea.val(""); // Clear input field
    
            var managerId = $(e.relatedTarget).data('id'); // Get the manager ID
    
            // Fetch project manager data
            $.ajax({
                url: '/admin/users/ProjectManager/index/' + managerId + '/edit', 
                method: 'GET',
                success: function (response) {
                    // Fill the form fields with the existing project manager data
                    $('#edit-form-PM input[name="first_name"]').val(response.first_name);
                    $('#edit-form-PM input[name="last_name"]').val(response.last_name);
                    $('#edit-form-PM input[name="email"]').val(response.email);
                    $('#edit-form-PM input[name="national_id"]').val(response.national_id);
                    $('#edit-form-PM textarea[name="address"]').val(response.address);
                    $('#edit-form-PM input[name="birth_date"]').val(response.birth_date);
                    $('#edit-form-PM select[name="payment_type"]').val(response.payment_type);
                    $('#edit-form-PM input[name="rate"]').val(response.rate);
                    $('#edit-form-PM input[name="pan_number"]').val(response.pan_number);
                    $('#edit-form-PM select[name="status"]').val(response.status);
                    initializePhonePMNumberInput(response.phone_number);
    
                    // Handle profile picture
                    if (response.profile_picture && response.profile_picture !== 'null' && response.profile_picture !== '') {
                        $('#selectedAvatar').attr('src', '/uploads/ProjectManager/' + response.profile_picture);
                    } else {
                        $('#selectedAvatar').attr('src', '/assets/img/user_profile.png');
                    }
    
                    // Update form action to reflect project manager ID
                    $('#edit-form-PM form').attr('action', '/admin/users/ProjectManager/index/' + managerId);
    
                    // Initialize skills
                    var responseSkills = response.skills; // Get the skills from the server
                    populateSkills(responseSkills); // Populate skills
                },
                error: function () {
                    alert('Failed to fetch project manager data');
                }
            });
        });
    
        // Validation before form submission
        $("#Updatesubmit-btn").on("click", function (e) {
            e.preventDefault(); // Prevent default button behavior
    
            if (skills.length === 0) {
                $("#error-msg").text("Please add some skills!");
            } else {
                $("#ManagerUpdate").submit(); // Submit the form
            }
        });
    });    
    
    function initializePhonePMNumberInput(phoneNumber) {
        getIp(function(countryCode) {
            $(".PMphone").each(function() {
                var phoneInputField = this;  // Get the DOM element for the phone input
    
                // Check if intlTelInput is already initialized
                if (typeof phoneInputField.intlTelInputInstance !== "undefined") {
                    // Destroy the previous instance if it exists
                    phoneInputField.intlTelInputInstance.destroy();
                }
    
                // Initialize intlTelInput
                var iti = window.intlTelInput(phoneInputField, {
                    initialCountry: countryCode, // Set initial country based on IP lookup
                    separateDialCode: true,      // Show dial code separately
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                });
    
                // Store the instance on the DOM element for later use
                phoneInputField.intlTelInputInstance = iti;
    
                // Set the phone number received from the server (with country code)
                if (phoneNumber) {
                    iti.setNumber(phoneNumber); // Set full phone number in intlTelInput
                } else {
                    // If no phone number is provided, default to India
                    iti.setNumber('+91'); // Set default number with India's country code
                }
    
                // On form submission, append the full phone number with country code
                $(this).closest('form').on('submit', function(e) {
                    var fullPhoneNumber = iti.getNumber();  // Get the full phone number with country code
                    console.log("Full phone number:", fullPhoneNumber);  // Log for debugging
                    $(phoneInputField).val(fullPhoneNumber);  // Set the full phone number in the input field
                });
            });
        });
    }
    //end update project manager

/*Project manager crud end */

    /*Resource crud start */
    //show single resource data 
    $(document).on('click', '.view-Resource', function() {
        var ResourceId = $(this).data('id');
        
        // Make an AJAX request to fetch resource data
        $.ajax({
            url: '/admin/users/Resources/index/' + ResourceId, // Adjust the URL to your route
            type: 'GET',
            success: function(data) {
                // Populate modal with the resource data
                if (data.profile_picture) {
                    $('#resource-details-modal .vendor-avatar').attr('src', '/uploads/Resources/' + data.profile_picture);
                } else {
                    $('#resource-details-modal .vendor-avatar').attr('src', '/assets/img/user_profile.png');  // Default photo
                }
                $('#resource-details-modal .modal-title').text(data.first_name + ' ' + data.last_name);
                $('#resource-details-modal .PM-id').text(data.id);
                $('#resource-details-modal .PM-email').text(data.email);
                $('#resource-details-modal .PM-nationalID').text(data.national_id);
                $('#resource-details-modal .PM-phone').text(data.phone_number);
                $('#resource-details-modal .PM-address').text(data.address);
                $('#resource-details-modal .pan-no').text(data.pan_number);
                $('#resource-details-modal .birth-date').text(data.birth_date);
                $('#resource-details-modal .PT').text(data.payment_type);
                $('#resource-details-modal .rate-cost').text(data.rate);
                $('#resource-details-modal .username').text(data.username);
                $('#resource-details-modal .created-by').text(data.created_by);
                $('#resource-details-modal .Designation').text(data.designation);
                $('#resource-details-modal .created-at').text(data.created_at);
                let skillsArray;

                // If the data is a string and looks like JSON, try parsing it
                if (typeof data.skills === 'string') {
                    try {
                        // First attempt to parse the string as JSON
                        skillsArray = JSON.parse(data.skills);

                        // If parsing does not return an array, manually process the string
                        if (!Array.isArray(skillsArray)) {
                            // Replace any unnecessary characters and split the string by commas
                            skillsArray = data.skills
                                .replace(/[\[\]\"]/g, '')  // Remove brackets and quotes
                                .split(',');               // Split the string into an array
                        }

                        // Remove any backslashes if present
                        skillsArray = skillsArray.map(function(skill) {
                            return skill.trim().replace(/\\/g, '');  // Trim and remove backslashes
                        });

                    } catch (error) {
                        console.error("Error parsing skills:", error);
                        return;  // Stop further execution in case of error
                    }
                }

            
                // If skillsArray is valid and an array, join the elements
                if (Array.isArray(skillsArray)) {
                    $('#resource-details-modal .skill').text(skillsArray.join(', '));
                } else {
                    $('#resource-details-modal .skill').text('Invalid format for skills.');
                }
                //$('#PM-details-modal .skill').text(data.skills);
                $('#resource-details-modal .status').text(data.status);
                $('#resource-details-modal .role').text(data.role);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " " + error);
                // Optionally show an error message in the modal
            }
        });
    });
    //end single resource data
    //update single resource data
    $(document).ready(function () {
        // Initialize variables
        var inputArea = $("#Resourceskills"),
            // tagArea = $("#Rs-error-msg"), // in this all span is print in error span
            tagArea = $(".tags"), // change pr 23-9-25
            skills = []; // Array to store the skills
    
        // Function to populate skills when editing the form
        function populateSkills(responseSkills) {
            // Clear any existing tags first
            // tagArea.empty(); // this is remove span tag ehich is use to show error 'Please add some skills!'
            // pr change 23-9-25
            $('#Rs-error-msg').empty();
            $(".tag").remove();
            // /pr
            skills = []; // Clear the skills array
    
            // Check if responseSkills is a string and attempt to parse it
            if (typeof responseSkills === "string") {
                try {
                    // Parse the string as JSON
                    skillsArray = JSON.parse(responseSkills);
    
                    // If parsing does not return an array, manually process the string
                    if (!Array.isArray(skillsArray)) {
                        skillsArray = responseSkills
                            .replace(/[\[\]\"]/g, '') // Remove brackets and quotes
                            .split(','); // Split the string into an array
                    }
                } catch (error) {
                    console.error("Error parsing skills:", error);
                    return; // Stop further execution in case of error
                }
            }
    
            // Clean up the skills array: trim and remove backslashes
            skillsArray = skillsArray.map(function (skill) {
                return skill.trim().replace(/\\/g, '');
            });
    
            // Debugging: Check whether skillsArray is a valid array after parsing
            // console.log("Parsed skills:", skillsArray);
            // console.log("Is skillsArray an array?:", Array.isArray(skillsArray));
    
            // If skillsArray is valid and an array, add each skill as a tag
            if (Array.isArray(skillsArray)) {
                skillsArray.forEach(addSkillTag);
            } else {
                console.error("Invalid format for skills.");
            }
        }
    
        // Function to add a new skill tag dynamically
        function addSkillTag(skill) {
            // Prevent adding duplicate skills
            if (!skills.includes(skill)) {
                // Create the skill tag element
                var tag = $("<span class='tag'>" + skill + "</span>").appendTo(tagArea);
                var close = $("<span class='fa fa-close'></span>").appendTo(tag);
    
                // Push the skill into the skills array
                skills.push(skill);
    
                // Update the hidden input with the current skills as JSON
                $("#ResourceUpdateskills").val(JSON.stringify(skills));
    
                // Add click event for removing the skill
                close.on("click", function () {
                    var index = skills.indexOf(skill); // Use the actual skill text for removal
                    if (index > -1) {
                        skills.splice(index, 1); // Remove the skill from the array
                        $("#ResourceUpdateskills").val(JSON.stringify(skills)); // Update the hidden input
                    }
                    tag.remove(); // Remove the tag element
                });
            }
        }
    
        // Handle adding new skills dynamically when typing in the input field
        inputArea.on("change", function () {
            var data = $(this).val().trim(); // Get the entered value
    
            // Only add if there's a new skill entered
            if (data) {
                addSkillTag(data); // Add the new skill as a tag
                $(this).val(""); // Clear the input field
            }
        });
    
        // Fetch the skills when the edit form is shown (example for Bootstrap modal)
        $('#edit-form-resource').on('show.bs.modal', function (e) {
            // Clear any existing data before showing the modal
            $("#error-msg").text(""); // Clear any previous error messages
            inputArea.val(""); // Clear input field
    
            // Fetch the resource ID and fetch existing data
            var resourceId = $(e.relatedTarget).data('id'); // Get the resource ID
    
            // Perform an AJAX request to fetch project manager data
            $.ajax({
                url: '/admin/users/Resources/index/' + resourceId + '/edit', // Fetch project manager data
                method: 'GET',
                success: function (response) {
                    // Fill the form fields with existing project manager data
                    
                    // pr new 4-9-25
                    // uncheck all check box
                    $('#edit-form-resource input[name="company_ids[]"]').prop('checked', false);
                    
                    // check specific check box
                    response.companies.forEach((company) => {
                        $('#edit-form-resource input[name="company_ids[]"][value="'+ company +'"]').prop('checked', true);
                    });
                    // /pr new 4-9-25

                    $('#edit-form-resource input[name="first_name"]').val(response.first_name);
                    $('#edit-form-resource input[name="last_name"]').val(response.last_name);
                    $('#edit-form-resource input[name="email"]').val(response.email);
                    $('#edit-form-resource input[name="national_id"]').val(response.national_id);
                    $('#edit-form-resource textarea[name="address"]').val(response.address);
                    $('#edit-form-resource input[name="birth_date"]').val(response.birth_date);
                    $('#edit-form-resource select[name="payment_type"]').val(response.payment_type);
                    $('#edit-form-resource input[name="rate"]').val(response.rate);
                    $('#edit-form-resource input[name="pan_number"]').val(response.pan_number);
                    $('#edit-form-resource input[name="designation"]').val(response.designation);
                    $('#edit-form-resource select[name="status"]').val(response.status);
                    $('#edit-form-resource select[name="role"]').val(response.role);
                    initializePhonePMNumberInput(response.phone_number);
    
                    // Handle profile picture
                    if (response.profile_picture && response.profile_picture !== 'null' && response.profile_picture !== '') {
                        $('#selectedAvatar').attr('src', '/uploads/Resources/' + response.profile_picture);
                    } else {
                        $('#selectedAvatar').attr('src', '/assets/img/user_profile.png');
                    }

    
                    // Update form action to reflect project manager ID
                    $('#edit-form-resource form').attr('action', '/admin/users/Resources/index/' + resourceId);
    
                    // Initialize skills
                    var responseSkills = response.skills; // Get the skills from the server
                    populateSkills(responseSkills); // Populate skills
                },
                error: function () {
                    alert('Failed to fetch project manager data');
                }
            });
        });
    
        // Validation before form submission
        $("#UpdateResource-submit-btn").on("click", function (e) {
            e.preventDefault(); // Prevent default button behavior
            
            // Perform validation before submission
            if (skills.length === 0) {
                // $("#error-msg").text("Please add some skills!"); // rd
                // show the error in update from if skill is not enter or blank
                $("#Rs-error-msg").text("Please add some skills!"); // pr change 23-9-25
            } else {
                $("#ResourceUpdate").submit(); // Submit the form
            }
        });
    });
    //end update single resource data
    /*Resource crud end */

/* vendor crud opration end */

/*   customers crud opration code   */
    //customer view single data ajax
    $(document).on('click', '.view-customer', function() {
        var customerId = $(this).data('id');
        
        // Make an AJAX request to fetch customer data
        $.ajax({
            url: '/admin/users/customers/index/' + customerId, // Adjust the URL to your route
            type: 'GET',
            success: function(data) {
                // Populate modal with the customer data
                if (data.profile_picture) {
                    $('#user-details-modal .customer-avatar').attr('src', '/uploads/customers/' + data.profile_picture);
                } else {
                    $('#user-details-modal .customer-avatar').attr('src', '/assets/img/user_profile.png');  // Default photo
                }
                $('#user-details-modal .modal-title').text(data.first_name + ' ' + data.last_name);
                $('#user-details-modal .customer-id').text(data.id);
                $('#user-details-modal .customer-email').text(data.email);
                $('#user-details-modal .customer-nationalID').text(data.national_id);
                $('#user-details-modal .customer-phone').text(data.phone_number);
                $('#user-details-modal .customer-address').text(data.address);
                $('#user-details-modal .company-email').text(data.company_email);
                $('#user-details-modal .company-phone').text(data.company_phone_number);
                $('#user-details-modal .company-name').text(data.company_name);
                $('#user-details-modal .pan-no').text(data.pan_number);
                $('#user-details-modal .tax-no').text(data.tax_number);
            }
        });
    });
    //end customer view single data ajax

    //return customer data in update form
    $(document).ready(function () {
        $(document).on('click', '.edit-customer', function () {
            var customerId = $(this).data('id');
            
            $.ajax({
                url: '/admin/users/customers/index/' + customerId + '/edit', // Fetch customer data
                method: 'GET',
                success: function (response) {
                    //console.log(response); 
                    // Fill the form fields with existing customer data
                    $('#edit-form-customer input[name="first_name"]').val(response.first_name);
                    $('#edit-form-customer input[name="last_name"]').val(response.last_name);
                    $('#edit-form-customer textarea[name="description"]').val(response.description);
                    $('#edit-form-customer input[name="email"]').val(response.email);
                    $('#edit-form-customer input[name="national_id"]').val(response.national_id);
                    $('#edit-form-customer textarea[name="address"]').val(response.address);
                    $('#edit-form-customer input[name="company_name"]').val(response.company_name);
                    $('#edit-form-customer input[name="company_email"]').val(response.company_email);
                    $('#edit-form-customer input[name="pan_number"]').val(response.pan_number);
                    $('#edit-form-customer input[name="Taxt_number"]').val(response.tax_number);
                    $('#edit-form-customer select[name="status"]').val(response.status);
                    //$('#edit-form-customer input[name="company_phone_number"]').val(response.company_phone_number);
                    if (response.profile_picture && response.profile_picture !== 'null' && response.profile_picture !== '') {
                        $('#selectedAvatar').attr('src', '/uploads/customers/' + response.profile_picture);
                    } else {
                        $('#selectedAvatar').attr('src', '/assets/img/user_profile.png');
                    }
                    //$('#SelectedAvatar').attr('src', '/uploads/customers/' + response.profile_picture);
                    // Update form action to reflect customer ID
                    $('#edit-form-customer form').attr('action', '/admin/users/customers/index/' + customerId);
        
                    // Now initialize intlTelInput after customer data is populated
                    initializePhoneCompanyNumberInput(response.company_phone_number);
                    initializePhoneNumberInput(response.phone_number); // Call function to initialize phone number input
                },
                error: function () {
                    alert('Failed to fetch customer data');
                }
            });
        });
    });
    // Function to initialize intlTelInput with customer phone data
    function initializePhoneNumberInput(phoneNumber) {
        getIp(function(countryCode) {
            $(".Uphone").each(function() {
                var phoneInputField = this;  // Get the DOM element for the phone input

                // Check if intlTelInput is already initialized
                if (typeof phoneInputField.intlTelInputInstance !== "undefined") {
                    // Destroy the previous instance if it exists
                    phoneInputField.intlTelInputInstance.destroy();
                }

                // Initialize intlTelInput
                var iti = window.intlTelInput(phoneInputField, {
                    initialCountry: countryCode, // Set initial country based on IP lookup
                    separateDialCode: true,      // Show dial code separately
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                });

                // Store the instance on the DOM element for later use
                phoneInputField.intlTelInputInstance = iti;

                // Set the phone number received from the server (with country code)
                if (phoneNumber) {
                    iti.setNumber(phoneNumber); // Set full phone number in intlTelInput
                } else {
                    // If no phone number is provided, default to India
                    iti.setNumber('+91'); // Set default number with India's country code
                }

                // On form submission, append the full phone number with country code
                $(this).closest('form').on('submit', function(e) {
                    var fullPhoneNumber = iti.getNumber();  // Get the full phone number with country code
                    console.log("Full phone number:", fullPhoneNumber);  // Log for debugging
                    $(phoneInputField).val(fullPhoneNumber);  // Set the full phone number in the input field
                });
            });
        });
    }

    function initializePhoneCompanyNumberInput(phoneNumber) {
        getIp(function(countryCode) {
            $(".Cphone").each(function() {
                var phoneInputField = this;  // Get the DOM element for the phone input

                // Check if intlTelInput is already initialized
                if (typeof phoneInputField.intlTelInputInstance !== "undefined") {
                    // Destroy the previous instance if it exists
                    phoneInputField.intlTelInputInstance.destroy();
                }

                // Initialize intlTelInput
                var iti = window.intlTelInput(phoneInputField, {
                    initialCountry: countryCode, // Set initial country based on IP lookup
                    separateDialCode: true,      // Show dial code separately
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                });

                // Store the instance on the DOM element for later use
                phoneInputField.intlTelInputInstance = iti;

                // Set the phone number received from the server (with country code)
                if (phoneNumber) {
                    iti.setNumber(phoneNumber); // Set full phone number in intlTelInput
                } else {
                    // If no phone number is provided, default to India
                    iti.setNumber('+91'); // Set default number with India's country code
                }

                // On form submission, append the full phone number with country code
                $(this).closest('form').on('submit', function(e) {
                    var fullPhoneNumber = iti.getNumber();  // Get the full phone number with country code
                    console.log("Full phone number:", fullPhoneNumber);  // Log for debugging
                    $(phoneInputField).val(fullPhoneNumber);  // Set the full phone number in the input field
                });
            });
        });
    }
    
    //IP lookup function (same as before)
    function getIp(callback) {
        $.ajax({
            url: 'https://ipinfo.io?token=66e2f39b20a2bd',
            dataType: 'json',
            success: function(resp) {
                callback(resp.country);
            },
            error: function() {
                callback('in');  // Default to India if IP lookup fails
            }
        });
    }
    
/* customer crud opration end */

/*vendor crud opration start */

/* vendor create form swift and ifsce code */
// ifsc code 
$(document).ready(function() {
    // Show both input fields on page load since "Both" is the default option
    $('#ifscInputField').show();
    $('#swiftInputField').show();
    
    // When the user selects an option from the dropdown
    $('#codeType').on('change', function() {
        var selectedType = $(this).val();
        // pr 22-9-25
        codeTypeChange(selectedType);
    });

    // When the user selects an option from the dropdown - in vendor profile - add pr 22-9-25
    $('#view-vendor-profile').on('click', function() {
        var selectedTypeInVenProfile = $('#codeType').val();
        // pr 22-9-25
        codeTypeChange(selectedTypeInVenProfile);
    });
});
// end IFSC and swift code 

// pr 22-9-25
function codeTypeChange(selectedType) {
    if (selectedType === 'IFSC') {
        // Show only the IFSC input field
        $('#ifscInputField').show();
        $('#swiftInputField').hide();
        $('#ifscInput').attr('placeholder', 'Enter IFSC Code');
    } else if (selectedType === 'Swift') {
        // Show only the Swift input field
        $('#swiftInputField').show();
        $('#ifscInputField').hide();
        $('#swiftInput').attr('placeholder', 'Enter Swift Code');
    } else if (selectedType === 'both') {
        // Show both IFSC and Swift input fields
        $('#ifscInputField').show();
        $('#swiftInputField').show();
        $('#ifscInput').attr('placeholder', 'Enter IFSC Code');
        $('#swiftInput').attr('placeholder', 'Enter Swift Code');
    } else {
        // Hide both fields if no valid selection is made
        $('#ifscInputField').hide();
        $('#swiftInputField').hide();
    }
}


$(document).on('click', '.view-vendor', function() {
    var vendorId = $(this).data('id');
    
    // Make an AJAX request to fetch customer data
    $.ajax({
        url: '/admin/users/vendors/index/' + vendorId, // Adjust the URL to your route
        type: 'GET',
        success: function(data) {
            // Populate modal with the customer data
            if (data.profile_picture) {
                $('#vendor-details-modal .vendor-avatar').attr('src', '/uploads/vendors/' + data.profile_picture);
            } else {
                $('#vendor-details-modal .vendor-avatar').attr('src', '/assets/img/user_profile.png');  // Default photo
            }
            $('#vendor-details-modal .modal-title').text(data.first_name + ' ' + data.last_name);
            $('#vendor-details-modal .vendor-id').text(data.id);
            $('#vendor-details-modal .vendor-email').text(data.email);
            $('#vendor-details-modal .vendor-nationalID').text(data.national_id);
            $('#vendor-details-modal .vendor-phone').text(data.phone_number);
            $('#vendor-details-modal .vendor-address').text(data.address);
            $('#vendor-details-modal .pan-no').text(data.pan_number);
            $('#vendor-details-modal .tax_number').text(data.Tax_number);
            $('#vendor-details-modal .company-name').text(data.company_name);
            $('#vendor-details-modal .website').text(data.website);
            $('#vendor-details-modal .bankname').text(data.bank_name);
            $('#vendor-details-modal .bank-account-no').text(data.bank_account_no);
            $('#vendor-details-modal .bank-branch').text(data.branch_name);
            $('#vendor-details-modal .holder-name').text(data.account_holder_name);
            $('#vendor-details-modal .code-type').text(data.code_type);
            $('#vendor-details-modal .ifsc-code').text(data.ifsc_code);
            $('#vendor-details-modal .swift-code').text(data.swift_code);
            $('#vendor-details-modal .status').text(data.status);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " " + error);
            // Optionally show an error message in the modal
        }
    });
});
//end customer view single data ajax

//currency code and country
document.addEventListener('DOMContentLoaded', function () {
    // Initialize the first dropdown
    const dropdown = document.getElementById('currency-dropdown');
    if (dropdown) {
        CurrencyHelper.populateCurrencyDropdown('currency-dropdown');

        CurrencyHelper.handleCurrencyChange('currency-dropdown', function (selectedDetails) {
            console.log(`Selected Currency from currency-dropdown: ${selectedDetails.country} (${selectedDetails.code}) ${selectedDetails.symbol}`);
        });
    }

    // Initialize the second dropdown
    // Iterate through all dropdowns with the pattern "currency-dropdown-<id>"
    document.querySelectorAll('[id^="currency-dropdown-"]').forEach(function (dropdown) {
        const storedCurrency = dropdown.getAttribute('data-stored-currency'); // Get the stored currency
        const dropdownId = dropdown.id;

        // Populate the dropdown
        CurrencyHelper.populateCurrencyDropdown(dropdownId);

        // Wait for the dropdown to populate before selecting the stored currency
        setTimeout(() => {
            if (storedCurrency) {
                const options = dropdown.options;
                for (let i = 0; i < options.length; i++) {
                    if (options[i].value === storedCurrency) {
                        dropdown.selectedIndex = i;
                        break;
                    }
                }
            }
        }, 100); // Adjust timeout if necessary based on your populate logic
    });
});
//end currency code and country
//invoice preview js
    // document.getElementById('previewButton').addEventListener('click', function () {
    //     const form = document.getElementById('invoiceForm');
    //     const url = this.getAttribute('data-url');

    //     // Collect form data
    //     const formData = new FormData(form);

    //     // Send AJAX request
    //     fetch(url, {
    //         method: 'POST',
    //         body: formData,
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //         }
    //     })
    //     .then(response => response.text())
    //     .then(html => {
    //         // Open a new window for the preview
    //         const previewWindow = window.open('', '_blank');
    //         previewWindow.document.open();
    //         previewWindow.document.write(html);
    //         previewWindow.document.close();
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         alert('Something went wrong! Please try again.');
    //     });
    // });
    // Check if the previewButton exists on the page
    const previewButton = document.getElementById('previewButton');
    if (previewButton) {
        previewButton.addEventListener('click', function () {
            const form = document.getElementById('invoiceForm');
            const url = this.getAttribute('data-url');

            if (!form) {
                console.error('Invoice form not found!');
                return;
            }

            // Collect form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.text())
            .then(html => {
                // Open a new window for the preview
                const previewWindow = window.open('', '_blank');
                previewWindow.document.open();
                previewWindow.document.write(html);
                previewWindow.document.close();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong! Please try again.');
            });
        });
    }

//end invoice preview js

// multi select commpaney
    const dataCheck = document.querySelector(".selectBox");
    if(dataCheck){
        document.addEventListener("DOMContentLoaded", function () {
          const selectBox = document.querySelector(".selectBox");
          const checkBoxes = document.getElementById("checkBoxes");
      
          selectBox.addEventListener("click", function (e) {
            e.stopPropagation();
            checkBoxes.style.display = checkBoxes.style.display === "block" ? "none" : "block";
          });
        });
    }
//   multi select companey end

// start date forcasting date

// document.addEventListener('DOMContentLoaded', function () {
//     const startDateInput = document.getElementById('start_date');
//     const endDateInput = document.getElementById('end_date');

//     startDateInput.addEventListener('change', function () {
//         const startDateValue = this.value;
//         if (startDateValue) {
//             // Set minimum date of Forecasting Date
//             endDateInput.min = startDateValue;
//         } else {
//             // Clear min if start date is cleared
//             endDateInput.min = '';
//         }
//     });
// });
// start date forcasting date end